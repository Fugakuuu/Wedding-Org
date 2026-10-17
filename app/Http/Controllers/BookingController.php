<?php

namespace App\Http\Controllers;

use App\Models\KatalogPaket;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function create(KatalogPaket $paket): View
    {
        return view('booking', compact('paket'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'Paket_id' => ['required', 'exists:Katalog_Paket,Paket_id'],
            'Nama_pemesan' => ['required', 'string', 'max:100'],
            'Email_pemesan' => ['required', 'email', 'max:100'],
            'No_WA' => ['required', 'string', 'max:20'],
            'Tanggal_acara' => ['required', 'date', 'after:today'],
            'Catatan' => ['nullable', 'string'],
        ]);

        $paket = KatalogPaket::findOrFail($validated['Paket_id']);

        $pesanan = Pesanan::create([
            'Paket_id' => $paket->Paket_id,
            'Nama_pemesan' => $validated['Nama_pemesan'],
            'Email_pemesan' => $validated['Email_pemesan'],
            'No_WA' => $validated['No_WA'],
            'Tanggal_acara' => $validated['Tanggal_acara'],
            'Catatan' => $validated['Catatan'],
            'Status' => 'request',
            'Admin_id' => $paket->Admin_id,
        ]);

        return redirect()->route('pesanan.show', $pesanan)
            ->with('success', 'Pesanan berhasil diajukan!');
    }
}