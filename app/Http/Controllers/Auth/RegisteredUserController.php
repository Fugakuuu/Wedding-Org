<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,admin'],
        ]);

        $role = $request->input('role', 'user');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        if ($role === 'admin') {
            $username = Str::slug($request->name, '_') ?: 'admin_'.$user->id;
            if (Admin::where('username', $username)->exists()) {
                $username .= '_'.rand(100, 999);
            }

            $admin = Admin::create([
                'username' => $username,
                'password' => Hash::make($request->password),
                'Email_adm' => $request->email,
                'Dekripsi_adm' => 'Admin JeWePe Wedding Organizer',
                'Telepon_adm' => '-',
                'Alamat_adm' => '-',
            ]);

            Auth::login($user);
            Auth::guard('admin')->login($admin);

            return redirect()->route('admin.dashboard');
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}