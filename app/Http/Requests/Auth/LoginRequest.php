<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        try {
            $this->ensureIsNotRateLimited();
        } catch (\Exception $e) {
            // If rate limiting fails due to database issues, log and continue
            Log::error('Rate limiting check failed: ' . $e->getMessage());
            // Don't block authentication if rate limiting cache fails
        }

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            try {
                RateLimiter::hit($this->throttleKey());
            } catch (\Exception $e) {
                // If rate limiting fails, log but don't block
                Log::error('Rate limiter hit failed: ' . $e->getMessage());
            }

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        try {
            RateLimiter::clear($this->throttleKey());
        } catch (\Exception $e) {
            // If rate limiting clear fails, log but don't block
            Log::error('Rate limiter clear failed: ' . $e->getMessage());
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        try {
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions
            throw $e;
        } catch (\Exception $e) {
            // Log cache/database errors but allow login to proceed
            Log::error('Rate limiting check encountered an error: ' . $e->getMessage());
            // Don't block authentication if rate limiting fails
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
