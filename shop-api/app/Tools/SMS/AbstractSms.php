<?php

namespace App\Tools\SMS;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use SoapClient;

abstract class AbstractSms {

    /**
     * The Client Of Sms Panels
     *
     * @var mixed $client
     */
    private $client;

    /**
     * The Username Of Sms
     *
     * @var mixed $username
     */
    private $username;


    /**
     * The Password of Sms
     *
     * @var mixed $password
     */
    private $password;

    /**
     * The From of Sms
     *
     * @var mixed $from
     */
    protected $to;


    /**
     * The From of Sms
     *
     * @var mixed $from
     */
    private $from;

    /**
     * The Code of Sms
     *
     * @var int $code
     */
    protected $code = null;


    /**
     * AbstractSms constructor.
     *
     * @throws \SoapFault
     */
    public function __construct()
    {
        ini_set("soap.wsdl_cache_enabled", "0");

        $this->client = new SoapClient(
            Config::get('sms.wsdl')
        );

        $this->username = Config::get('sms.username');
        $this->password = Config::get('sms.password');
        $this->from     = Config::get('sms.from');
    }

    public function provide($message)
    {
        try {
            return $this->code
                ? $this->client->sendPatternSms(
                    $this->from, Arr::wrap($this->to),
                    $this->username, $this->password,
                    1383, [
                        "code" => $this->code,
                        "name" => "اپلیکیشن گراما",
                    ]
                )
                : $this->client->SendSMS(
                    $this->from, Arr::wrap($this->to),
                    $message,
                    $this->username, $this->password,
                    '', 'send'
                );

        } catch (\Exception $ex) {
            \Log::critical('Error: in SMS sending: ' . $ex->getMessage());

            return false;
        }
    }
}
