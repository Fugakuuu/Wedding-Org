<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\View\View;

class PesananController extends Controller
{
    public function show(Pesanan $pesanan): View
    {
        $pesanan->load(['paket', 'admin']);

        return view('pesanan-detail', compact('pesanan'));
    }

    public function trackForm(): View
    {
        return view('cek-pesanan');
    }

    public function track(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'pesanan_id' => 'required|exists:Pesanan,Pesanan_id'
        ], [
            'pesanan_id.exists' => 'ID Pesanan tidak ditemukan.'
        ]);

        return redirect()->route('pesanan.show', $request->pesanan_id);
    }
}
