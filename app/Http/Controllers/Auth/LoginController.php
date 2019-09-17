<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-17
 * Time: 09:29
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Rules\CheckEmail;
use App\Rules\ValidCurrentUserPassword;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'email' => ['required','email', new CheckEmail()],
            'password' => ['required', new ValidCurrentUserPassword($request)]
        ]);

        $token = $this->PasswordGrantLogin($request->email, $request->password);

        return response()->json(['status'=>'success','message'=>'Success','data'=>$token],201);

    }


    protected function PasswordGrantLogin($email,$password){
        $client = new Client();
        $options  =[
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => 2,
                'client_secret' => env('CLIENT_KEY'),
                'username' => $email,
                'password' => $password,
                'scope' => ['*'],
            ]
        ];
        $response=$client->post(env('APP_URL_SOURCE').'/api/oauth/token',$options);

        return json_decode((string) $response->getBody(), true);
    }
}