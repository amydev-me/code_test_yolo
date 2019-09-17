<?php
/**
 * Created by PhpStorm.
 * User: amy
 * Date: 2019-09-17
 * Time: 17:17
 */

namespace App\Rules;


use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ValidCurrentUserPassword implements Rule
{
    private $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $user = User::where('email', $this->request->email)->first();
        if ($user) {
            if (Hash::check($value, $user->password)) {
                return true;
            }
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
        return "The :attribute invalid";
    }
}