<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class uniqueEmailAddress implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $max = max(array_count_values($value));
        dd($max);
        return $max === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '重複しているアドレスがあります';
    }
}
