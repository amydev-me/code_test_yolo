<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-16
 * Time: 22:24
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required',
            'full_name' => 'required|max:255'
        ]);

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'full_name' => $request->full_name
            ]);

            $token = RequestToken::credential($user->email, $request->password);

            return response()->json(['status' => 'success', 'message' => 'Success', 'data' => []], 201);

        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'message' => 'Internal Server Error', 'data' => []], 500);
        }
    }
}