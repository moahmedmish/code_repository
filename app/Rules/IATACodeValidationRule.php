<?php

namespace App\Rules;

use App\Helpers\IATA_Code_list;
use Illuminate\Contracts\Validation\Rule;

class IATACodeValidationRule implements Rule
{
    /**
     * THIS IS CUSTOM RULE TO VALIDATE IATA FORMAT.
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return void
     */
    public function passes($attribute, $value)
    {
       return in_array($value, IATA_Code_list::list());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute filed Must be under IATA Code Standard.';
    }
}
