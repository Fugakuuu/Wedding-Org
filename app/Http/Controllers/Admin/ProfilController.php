<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function edit(): View
    {
        return view('admin.profil');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'Dekripsi_adm' => ['nullable', 'string'],
            'Telepon_adm' => ['nullable', 'string', 'max:20'],
            'Email_adm' => ['required', 'email', 'max:100'],
            'Alamat_adm' => ['nullable', 'string', 'max:255'],
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}