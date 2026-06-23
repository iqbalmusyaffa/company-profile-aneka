<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // Lockout 15 minutes (900 seconds) after 5 attempts
            RateLimiter::hit($this->throttleKey(), 900);

            // Progressive Ban Logic: Track IP total fails
            $ipKey = 'failed_login_ip_' . $this->ip();
            if (!\Illuminate\Support\Facades\Cache::has($ipKey)) {
                \Illuminate\Support\Facades\Cache::put($ipKey, 1, now()->addHours(24));
            } else {
                \Illuminate\Support\Facades\Cache::increment($ipKey);
            }
            $totalFails = \Illuminate\Support\Facades\Cache::get($ipKey);

            if ($totalFails >= 10) {
                \App\Models\BlockedIp::firstOrCreate(
                    ['ip_address' => $this->ip()],
                    ['reason' => 'Otomatis diblokir: Terdeteksi Brute-Force (10x Gagal Login)']
                );
                \Illuminate\Support\Facades\Cache::forget('blocked_ips');
            }

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        \Illuminate\Support\Facades\Cache::forget('failed_login_ip_' . $this->ip());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
