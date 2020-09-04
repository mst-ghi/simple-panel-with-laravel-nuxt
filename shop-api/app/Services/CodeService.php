<?php

namespace App\Services;

use App\Exceptions\Code\CodeExpiresException;
use App\Exceptions\Code\CodeInvalidException;
use App\Exceptions\Code\CodeLimitException;
use App\Exceptions\Code\CodeUsedException;
use App\Models\Code;
use App\Repositories\CodeRepository;
use Carbon\Carbon;

class CodeService
{
    /** @var CodeRepository $repository */
    protected $repository;

    /** @var CodeRepository $code */
    protected $code;

    /**
     * CodeService constructor.
     *
     * @param  CodeRepository  $repository
     */
    public function __construct(CodeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int    $code
     * @param string $hash
     *
     * @return CodeRepository|null
     * @throws CodeExpiresException
     * @throws CodeInvalidException
     * @throws CodeUsedException
     */
    public function findByHashCode(int $code, string $hash)
    {
        $this->code = $this->repository->findByHashCode($code, $hash);
        $this->validateCode();
        return $this->code;
    }

    /**
     * @param int $user_id
     *
     * @return Code
     * @throws CodeLimitException
     */
    public function codeOperation(int $user_id)
    {
        /** @var CodeRepository $code */
        $this->code = $this->repository->findByUserId($user_id);

        return $this->code ? $this->codeUpdate() : $this->codeCreate($user_id);
    }

    /**
     *
     * @return Code
     * @throws CodeLimitException
     */
    protected function codeUpdate()
    {
//        if ($this->code->expired_at > Carbon::now()) throw new CodeLimitException();

        $this->code->update([
            'code'       => Code::generateVerifyCode(),
            'type'       => Code::TYPE_LOGIN,
            'hash'       => sha1(time() . Code::TYPE_LOGIN),
            'status'     => false,
            'expired_at' => Carbon::now()->addMinutes(config('auth.code.expire')),
        ]);

        return $this->code;
    }

    /**
     * @param int $user_id
     *
     * @return Code
     */
    protected function codeCreate(int $user_id)
    {
        $this->code = $this->repository->createNew([
            'user_id'    => $user_id,
            'code'       => Code::generateVerifyCode(),
            'type'       => Code::TYPE_REGISTER,
            'hash'       => sha1(time() . Code::TYPE_REGISTER),
            'status'     => false,
            'expired_at' => Carbon::now()->addMinutes(config('auth.code.expire')),
        ]);

        return $this->code;
    }

    /**
     * @throws CodeExpiresException
     * @throws CodeInvalidException
     * @throws CodeUsedException
     */
    public function validateCode()
    {
        if (!$this->code) throw new CodeInvalidException();
        if ($this->code->status == true) throw new CodeUsedException;
        if ($this->code->expired_at < Carbon::now()) throw new CodeExpiresException;
    }
}
