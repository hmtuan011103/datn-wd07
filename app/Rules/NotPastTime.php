<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class NotPastTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $selectedDateTime = request()->input('start_date') . ' ' . $value;
        $currentDateTime = now();

        $threeHoursLater = $currentDateTime->copy()->addHours(3);

        if ($selectedDateTime <= $currentDateTime ) {
            $fail('Vui lòng chọn một thời gian trong tương lai.');
        }

        if($selectedDateTime <= $threeHoursLater) {
            $fail('Vui lòng chọn một thời gian sau 3 tiếng');

        }
    }
}
