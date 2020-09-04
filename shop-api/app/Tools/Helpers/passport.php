<?php

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Passport;

if (!function_exists('setTypeToAccessToken')) {
    /**
     * @param string      $type
     * @param string|NULL $accessToken
     *
     * @return string|null
     */
    function setTypeToAccessToken(string $type, string $accessToken = NULL)
    {
        /**
         * decode current access token
         *
         * @var object $decode
         */
        $decode = getDecodedAccessToken($accessToken);

        if (is_null($decode)) return NULL;

        /**
         * update type field in oauth_access_tokens table
         */
        DB::table('oauth_access_tokens')
            ->where('id', '=', $decode->jti)
            ->update([
                'type' => $type,
            ]);

        /**
         * add type to token
         */
        $decode->type = $type;

        /**
         * get private key from storage
         *
         * @var string $privateKey
         */
        $privateKey = file_get_contents(Passport::keyPath('oauth-private.key'));

        /**
         * create new access token by type value
         */
        $newAccessToken = JWT::encode($decode, $privateKey, 'RS256');


        /**
         * get old user access tokens
         *
         */
        $accessTokens = DB::table('oauth_access_tokens')
            ->where('user_id', '=', $decode->sub)
            ->where('id', '!=', $decode->jti)
            ->where('type', '=', $decode->type)
            ->get();

        /**
         * delete all user access and refresh tokens
         *
         * this action for login user in one device
         */
        if ($accessTokens->count()) {

            foreach ($accessTokens as $accessToken) {

                DB::table('oauth_refresh_tokens')
                    ->where('access_token_id', '=', $accessToken->id)
                    ->delete();

                DB::table('oauth_access_tokens')
                    ->where('id', '=', $accessToken->id)
                    ->delete();

            }

        }

        return $newAccessToken;

    }
}


if (!function_exists('getTypeFromAccessToken')) {
    /**
     * @param string|NULL $type
     * @param string|NULL $accessToken
     *
     * @return array|null
     */
    function getTypeFromAccessToken(string $type = NULL, string $accessToken = NULL)
    {
        /**
         * decode current access token
         *
         * @var object $decode
         */
        $decode = getDecodedAccessToken($accessToken);

        if (is_null($decode)) {

            return NULL;

        }

        if (isset($decode->type)) {

            if (!is_null($type)) {

                if ($decode->type == $type) {

                    return [
                        'status' => true,
                        'type'   => $decode->type,
                    ];

                } else {

                    return [
                        'status' => false,
                        'type'   => '',
                    ];

                }

            }

            return [
                'status' => true,
                'type'   => $decode->type,
            ];

        }

        return [
            'status' => false,
            'type'   => '',
        ];

    }
}


if (!function_exists('getDecodedAccessToken')) {
    /**
     * @param string|NULL $accessToken
     *
     * @return object|null
     */
    function getDecodedAccessToken(string $accessToken = NULL)
    {
        if (is_null($accessToken)) {

            /**
             * get access token
             *
             * @var string $accessToken
             */
            $accessToken = getAccessToken();

            if (is_null($accessToken)) {

                return NULL;

            }

        }

        /**
         * get public key from storage
         *
         * @var string $publicKey
         */
        $publicKey = file_get_contents(Passport::keyPath('oauth-public.key'));

        /**
         * decode current access token
         *
         * @var object $decode
         */
        $decode = JWT::decode($accessToken, $publicKey, array('RS256'));

        return $decode;
    }
}


if (!function_exists('getAccessToken')) {
    /**
     * @return bool|string|null
     */
    function getAccessToken()
    {
        if (Request::header('Authorization')) {

            return substr(Request::header('Authorization'), strpos(Request::header('Authorization'), ' ') + 1);

        }
        return NULL;
    }
}

