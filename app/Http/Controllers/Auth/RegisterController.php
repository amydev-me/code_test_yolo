<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-16
 * Time: 22:24
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){

        $this->validate($request,[
            'email'=>'required',
            'password' => 'required',
            'full_name' => 'required'
        ]);

        return 'Success Validation';
    }
}