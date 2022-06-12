<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class maxNewCategoryName implements Rule
{

    const MAX_CATEGORY_NAME = 20;
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
        foreach($value as $categoryName) {
            if(mb_strlen($categoryName) > self::MAX_CATEGORY_NAME) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return self::MAX_CATEGORY_NAME. '文字以内のカテゴリ名にしてください';
    }
}
