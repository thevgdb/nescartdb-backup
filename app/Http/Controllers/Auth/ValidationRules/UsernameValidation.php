<?php

namespace App\Http\Controllers\Auth\ValidationRules;

use App\ValidationRules\type;
use Illuminate\Contracts\Validation\Rule;

class UsernameValidation implements Rule
{
    /**
     * The maximum number of characters a username is allowed to be.
     *
     * @var int
     */
    private int $username_maximum_length = 30;

    /**
     * The minimum number of characters a username is allowed to be.
     *
     * @var int
     */
    private int $username_minimum_length = 1;

    /**
     * The regular expression that a username must match with to be considered valid.
     *
     * @var string
     */
    //private string $regex = "/^[A-Za-z0-9]+$/"; // Basic alphanumeric matching.
    private string $regex = "/^(?!.*[._]{2})[a-zA-Z0-9_.]+$/"; // Alphanumeric, '.', and '_' characters ONLY, but don't allow consecutive '.' or '_'. https://stackoverflow.com/a/30316930

    /**
     * Usernames may not be any of the disallowed usernames list. The reason for each disallowed username is usually due to some technical reason with how VGDB works.
     *
     * @var array
     */
    private array $disallowed_usernames_list = [
        'new',
    ];

    /**
     * The error/failure message. The one here is default/generic. This should be updated with a more specific/concise failure reason as the validation executes based on what the reason for failure was.
     *
     * @var string
     */
    private string $message = "The username was invalid. Please check the username and try again. Contact staff if you need help/assistance.";

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
//        $username_is_valid = true;
//
//        // Ensure it's not more characters than the maximum allowed.
//        if(strlen($value) > $this->username_maximum_length) {
//            $username_is_valid = false;
//        }
//
//        // Ensure it's not less characters than the minimum allowed.
//        if(strlen($value) < $this->username_minimum_length) {
//            $username_is_valid = false;
//        }
//
//        // Ensure it matches with the required regular expression.
//        if(! preg_match($this->regex, $value)) {
//            $username_is_valid = false;
//        }
//
//        // Ensure AT MOST a single '.' and '_' character.
//        if(substr_count('.', $value) + substr_count('.', $value) > 1) {
//            $username_is_valid = false;
//        }
//
//        // If username fails now for any of the reasons above, fail the validation with the same message.
//        if(! $username_is_valid) {
//            $this->message = "Usernames can contain alphanumeric, '.', and '_' characters only, with at most a single '.' and '_', and must be between $this->username_minimum_length and $this->username_maximum_length characters long.";
//            return false;
//        }


        if(
            strlen($value) > $this->username_maximum_length // Ensure it's not more characters than the maximum allowed.
            || strlen($value) < $this->username_minimum_length // Ensure it's not less characters than the minimum allowed.
            || ! preg_match($this->regex, $value) // Ensure it matches with the required regular expression.
            || substr_count('.', $value) + substr_count('.', $value) > 1 // Ensure AT MOST a single '.' and '_' character are used.
        ) {
            $this->message = "Usernames can contain alphanumeric, '.', and '_' characters only, with at most a single '.' and '_', and must be between $this->username_minimum_length and $this->username_maximum_length characters long.";
            return false;
        }

        // If the username is one of the disallowed usernames, fail the validation with a specific message.
        if(in_array($value, $this->disallowed_usernames_list)) {
            $this->message = "Sorry, your username may not be that. Pick another.";
            return false;
        }

        // If all else fails, then the validation passes, and the username is valid.
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }
}
