<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KatalogPaket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class KatalogPaketController extends Controller
{
    public function index(Request $request): View
    {
        $query = KatalogPaket::with('admin');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('Nama_paket', 'like', "%{$search}%")
                  ->orWhere('Dekripsi_pkt', 'like', "%{$search}%");
            });
        }

        $paket = $query->orderByDesc('Paket_id')->paginate(10)->withQueryString();

        return view('admin.katalog.index', compact('paket'));
    }

    public function create(): View
    {
        return view('admin.katalog.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'Nama_paket' => ['required', 'string', 'max:100'],
            'Harga' => ['required', 'numeric', 'min:0'],
            'Kategori' => ['required', 'string', 'max:20'],
            'Dekripsi_pkt' => ['required', 'string'],
        ]);

        $validated['Admin_id'] = Auth::guard('admin')->id();

        KatalogPaket::create($validated);

        return redirect()->route('admin.katalog.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(KatalogPaket $paket): View
    {
        return view('admin.katalog.edit', compact('paket'));
    }

    public function update(Request $request, KatalogPaket $paket): RedirectResponse
    {
        $validated = $request->validate([
            'Nama_paket' => ['required', 'string', 'max:100'],
            'Harga' => ['required', 'numeric', 'min:0'],
            'Kategori' => ['required', 'string', 'max:20'],
            'Dekripsi_pkt' => ['required', 'string'],
        ]);

        $paket->update($validated);

        return redirect()->route('admin.katalog.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(KatalogPaket $paket): RedirectResponse
    {
        if ($paket->pesanan()->exists()) {
            return redirect()->route('admin.katalog.index')
                ->with('error', 'Paket tidak dapat dihapus karena masih digunakan dalam data pesanan.');
        }

        $paket->delete();

        return redirect()->route('admin.katalog.index')
            ->with('success', 'Paket berhasil dihapus.');
    }
}