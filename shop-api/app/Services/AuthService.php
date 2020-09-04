<?php

namespace App\Services;

use App\Exceptions\PassportTokensException;
use App\Exceptions\User\UserInvalidPasswordException;
use App\Exceptions\User\UserNotFoundException;
use App\Exceptions\User\UserStatusException;
use App\Models\AccessToken;
use App\Models\RefreshToken;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\IssueTokenTrait;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use IssueTokenTrait;

    const ROLE_ADMIN    = 'admin';
    const ROLE_CUSTOMER = 'customer';

    /** @var UserRepository $repository */
    protected $repository;

    /** @var UserRepository $user */
    protected $user;

    /** @var string $username */
    protected $username;

    /** @var string $username */
    protected $password;

    protected $mobile;

    /**
     * AuthService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $mobile
     *
     * @return UserRepository|mixed
     */
    public function createUser(string $mobile)
    {
        $data       = [
            'mobile'   => $mobile,
            'password' => Hash::make($mobile)
        ];
        $this->user = $this->repository->createNew($data);
        return $this->user;
    }

    /**
     * @return string|null
     * @throws UserInvalidPasswordException
     * @throws UserNotFoundException
     * @throws UserStatusException
     */
    public function login()
    {
        $this->getUser();

        $this->checkUserPassword();

        return $this->createToken(self::ROLE_ADMIN);
    }

    /**
     * @param string|null $role
     *
     * @return string|null
     */
    public function createToken(string $role = null)
    {
        $role = $role ?? self::ROLE_CUSTOMER;

        $token = $this->user->createToken($role);

        /** generate access token with type value */
        return setTypeToAccessToken($role, $token->accessToken);
    }

    /**
     * @return array
     * @throws PassportTokensException
     */
    public function handlePassportTokens()
    {
        /** Generate Access Code and refresh token */
        $tokensResult = $this->issueToken($this->user);

        if ($tokensResult == NULL) throw new PassportTokensException();

        /** generate access token with type value */
        $accessToken = setTypeToAccessToken(self::ROLE_ADMIN, $tokensResult['access_token']);

        return [
            'access_token'  => $accessToken,
            'refresh_token' => $tokensResult['refresh_token'],
        ];
    }

    /**
     * @throws \Exception
     */
    public function logout()
    {
        $this->destroyTokens();
    }

    /**
     * @throws \Exception
     */
    private function destroyTokens()
    {
        $encodeAccess = getDecodedAccessToken();
        /** @var AccessToken[] $accessTokens */
        $accessTokens = AccessToken::where('user_id', '=', $this->user->id)
            ->where('type', '=', $encodeAccess->type)
            ->get();
        /** delete all user access and refresh token */
        foreach ($accessTokens as $token) {
            /** delete refresh token */
            RefreshToken::TokenID($token->id)->delete();
            /** delete access token */
            $token->delete();
        }
    }

    /**
     * get user by username and throw exception
     *
     * @throws UserNotFoundException
     * @throws UserStatusException
     */
    public function getUser()
    {
        $this->user = $this->repository->findByUsername($this->username);
        $this->userValidate();
        return $this->user;
    }

    /**
     * get user by username and throw exception
     */
    public function getUserByMobile()
    {
        return $this->repository->findByMobile($this->mobile);
    }

    /**
     * @throws UserInvalidPasswordException
     */
    public function checkUserPassword()
    {
        if (!Hash::check($this->password, $this->user->password))
            throw new UserInvalidPasswordException();
    }

    /**
     * @throws UserNotFoundException
     * @throws UserStatusException
     */
    public function userValidate()
    {
        if (!$this->user) throw new UserNotFoundException();
        if (!$this->user->status) throw new UserStatusException();
    }

    /**
     * @param string $username
     * @param string $password
     */
    public function setInfo(string $username, string $password): void
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param User $user
     *
     * @return AuthService
     */
    public function setUser(User $user): AuthService
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     *
     * @return AuthService
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

}
