<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueEmailForUserTypeOne implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(User::where('email', $value)->where('user_type_id', 1)->exists()){
            $fail('Email đã tồn tại, vui lòng sử dụng email khác');
        }
    }
}
