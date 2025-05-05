<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxKeywords implements ValidationRule
{
    protected $max;

    public function __construct($max = 5)
    {
        $this->max = $max;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!(is_array($value) && count($value) <= $this->max))
            $fail("keywords can not be more than {$this->max}");
    }
}
