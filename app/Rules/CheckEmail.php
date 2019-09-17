<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-17
 * Time: 16:51
 */

namespace App\Rules;


use App\User;
use Illuminate\Contracts\Validation\Rule;

class CheckEmail implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
         $user =  User::where('email',$value)->first();
         if($user){
             return true;
         }

         return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return "The :attribute doesn't exists";
    }
}