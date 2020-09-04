<?php

namespace App\Traits;

use App\Exceptions\FailedInternalRequestException;
use App\Http\Controllers\v1\InternalRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

/**
 * Trait IssueTokenTrait
 *
 * @package App\Traits
 */
trait IssueTokenTrait
{
    /** @var int $client_id */
    private $client_id;

    /** @var string $client_secret */
    private $client_secret;

    /**
     * @param             $user
     * @param string|NULL $role
     *
     * @return \Illuminate\Http\Response|mixed|null
     */
    public function issueToken($user, string $role = NULL)
    {
        $this->getClient();

        /** @var InternalRequest $request */
        $request = new InternalRequest(app());

        $params = [
            'grant_type'    => 'password',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'username'      => $user->username,
            'password'      => $user->password,
            'scope'         => '*',
        ];

        $response = NULL;

        try {
            $response = $request->request('POST', '/oauth/token', $params);
        }
        catch (FailedInternalRequestException $e) {
            return $response;
        }

        return json_decode($response->getContent(), true);
    }

    public function refreshToken(string $refreshToken, string $role = NULL)
    {
        $this->getClient();

        /** @var InternalRequest $request */
        $request = new InternalRequest(app());

        $params = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'scope'         => '',
        ];

        $response = NULL;

        try {
            $response = $request->request('POST', '/oauth/token', $params);
        }
        catch (FailedInternalRequestException $e) {
            return $response;
        }

        return json_decode($response->getContent(), true);
    }

    public function socialToken(string $provider, string $accessToken, string $role = NULL)
    {
        $this->getClient();

        /** @var InternalRequest $request */
        $request = new InternalRequest(app());

        $params = [
            'grant_type'    => 'refresh_token',
            'client_id'     => $this->client_id,
            'client_secret' => $this->client_secret,
            'provider'      => $provider,
            'access_token'  => $accessToken,
        ];

        $response = NULL;

        try {
            $response = $request->request('POST', '/oauth/token', $params);
        }
        catch (FailedInternalRequestException $e) {
            return $response;
        }

        return json_decode($response->getContent(), true);
    }

    private function getClient()
    {
        $row                 = DB::table('oauth_clients')
            ->where('id', 2)
            ->first();
        $this->client_id     = $row->id;
        $this->client_secret = $row->secret;
    }
}
