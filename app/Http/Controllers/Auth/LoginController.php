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
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
//        try{
            $this->validate($request, [
                'email' => ['required','email', new CheckEmail()],
                'password' => ['required', new ValidCurrentUserPassword($request)]
            ]);

            $token= RequestToken::credential($request->email, $request->password);

            return response()->json(['status'=>'success','message'=>'Success','data'=>$token],200);
//        }catch (\Exception $e){
//            return response()->json(['status' => 'failed', 'message' => 'Internal Server Error', 'data' => []], 500);
//        }
    }
}