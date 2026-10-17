<?php

namespace App\Http\Controllers;

use App\Models\KatalogPaket;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaketController extends Controller
{
    public function index(Request $request): View
    {
        $query = KatalogPaket::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('Nama_paket', 'like', "%{$search}%")
                  ->orWhere('Dekripsi_pkt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && $request->input('kategori') !== 'Semua') {
            $query->where('Kategori', $request->input('kategori'));
        }

        $query->orderBy('Harga');

        $paket = $query->get();

        return view('katalog', compact('paket'));
    }
}
