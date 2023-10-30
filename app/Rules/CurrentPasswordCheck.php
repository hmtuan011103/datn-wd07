<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Closure;

class CurrentPasswordCheck implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Hash::check($value, Auth::user()->password)) {
            $fail('Mật khẩu hiện tại không chính xác.');
        }
    }
}
