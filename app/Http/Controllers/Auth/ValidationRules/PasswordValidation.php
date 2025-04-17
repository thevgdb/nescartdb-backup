<?php

namespace App\Http\Controllers\Auth\ValidationRules;

use App\ValidationRules\type;
use Illuminate\Contracts\Validation\Rule;

class PasswordValidation implements Rule
{
    /**
     * Regular expression that the password must pass.
     * https://stackoverflow.com/a/31549892
     *
     * @var string
     */
//    private string $regex = "/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/";
    private string $regex = "/^(?=[a-zA-Z\d]*).{1,128}$/";
//    private string $regex = "/^.*(?=.{1,128})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/";

    /**
     * Determine if the validation rule passes.
     *
     * @param type $attribute
     * @param type $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if(! preg_match($this->regex, $value)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Passwords can only contain letters, numbers, and special characters.';
    }
}
