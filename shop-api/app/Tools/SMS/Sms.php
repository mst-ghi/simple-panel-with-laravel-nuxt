<?php


namespace App\Tools\SMS;


class Sms extends AbstractSms
{
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    public function send($message = null)
    {
        return $this->provide($message);
    }
}
