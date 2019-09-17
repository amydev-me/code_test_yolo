<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-17
 * Time: 23:16
 */

namespace App\Http\Controllers\Auth;


use GuzzleHttp\Client;

class RequestToken
{
    /**
     * @param $email
     * @param $password
     * @param string $scope
     * @return mixed
     */
    public static  function credential($email,$password, $scope='*'){
        $client = new Client();
        $options  =[
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_KEY'),
                'username' => $email,
                'password' => $password,
                'scope' => $scope,
            ]
        ];
        $response=$client->post(env('CLIENT_ENDPOINT'),$options);

        return json_decode((string) $response->getBody(), true);
    }
}