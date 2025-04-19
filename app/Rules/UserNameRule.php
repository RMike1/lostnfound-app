<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserNameRule implements ValidationRule
{
    private ?User $user;

    private array $reserved;

    public function __construct(?User $user = null)
    {
        $this->user = $user;
        $this->reserved = [
            'admin',
            'lost',
            'found',
            'root',
            'login',
            'logout',
            'register',
            'user',
            'users',
            'dashboard',
            'settings',
            'auth',
            'api',
            'support',
            'help',
            'www',
        ];
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = (string) $value;
        if (in_array(mb_strtolower($value), $this->reserved, true)) {
            $fail('The :attribute is reserved.');

            return;
        }
    }
}
