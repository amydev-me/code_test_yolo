<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-17
 * Time: 15:17
 */

namespace App\Http\Controllers;


use App\User;

class UserController extends Controller
{
    public function index($id){

        try{
            $user = User::find($id);

            return response()->json(['status'=>'success','message'=>'Success','data'=>$user],200);

        }catch (\Exception $e){

            return response()->json(['status'=>'failed','message'=>'Internal Server Error','data'=>[]],500);

        }
    }
}