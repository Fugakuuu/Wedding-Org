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
            'email' => ['required', 'string'],
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

        $loginInput = $this->input('email');
        $password = $this->input('password');
        $remember = $this->boolean('remember');

        // 1. Cek tabel users
        $user = \App\Models\User::where('email', $loginInput)->orWhere('name', $loginInput)->first();
        if ($user && \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            Auth::login($user, $remember);

            if ($user->role === 'admin') {
                $admin = \App\Models\Admin::where('Email_adm', $user->email)->orWhere('username', $user->name)->first();
                if (! $admin) {
                    $admin = \App\Models\Admin::create([
                        'username' => \Illuminate\Support\Str::slug($user->name, '_') ?: 'admin_'.$user->id,
                        'password' => $user->password,
                        'Email_adm' => $user->email,
                        'Dekripsi_adm' => 'Admin JeWePe Wedding Organizer',
                        'Telepon_adm' => '-',
                        'Alamat_adm' => '-',
                    ]);
                }
                Auth::guard('admin')->login($admin, $remember);
            }

            RateLimiter::clear($this->throttleKey());
            return;
        }

        // 2. Cek tabel Admin
        $admin = \App\Models\Admin::where('username', $loginInput)->orWhere('Email_adm', $loginInput)->first();
        if ($admin && \Illuminate\Support\Facades\Hash::check($password, $admin->password)) {
            $user = \App\Models\User::firstOrCreate(
                ['email' => $admin->Email_adm ?: ($admin->username . '@jewpe.com')],
                [
                    'name' => $admin->username,
                    'password' => $admin->password,
                    'role' => 'admin',
                ]
            );
            $user->role = 'admin';
            $user->save();

            Auth::login($user, $remember);
            Auth::guard('admin')->login($admin, $remember);

            RateLimiter::clear($this->throttleKey());
            return;
        }

        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
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
