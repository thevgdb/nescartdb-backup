<?php

namespace App\Http\Controllers\Auth\ValidationRules;

use Illuminate\Contracts\Validation\Rule;

class EmailValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param type $attribute
     * @param type $value
     *
     * @return boolean
     */
    public function passes($attribute, $value): bool
    {
        // TODO

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'That is not a valid email.';
    }
}
