<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PublishDateRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $publishDate = Carbon::parse($value)->startOfDay();
        $today = Carbon::now()->startOfDay();

        if ($publishDate->lt($today)) {
            $fail("The publish date must be today or a future date");
        }
    }
}
