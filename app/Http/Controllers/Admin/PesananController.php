<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PesananController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pesanan::with(['paket', 'admin'])->orderByDesc('Pesanan_id');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('Nama_pemesan', 'like', "%{$search}%")
                  ->orWhere('Email_pemesan', 'like', "%{$search}%")
                  ->orWhere('Pesanan_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('Status', $request->input('status'));
        }

        $pesanan = $query->paginate(10)->withQueryString();

        $stats = [
            'total'    => Pesanan::count(),
            'request'  => Pesanan::where('Status', 'request')->count(),
            'approved' => Pesanan::where('Status', 'approved')->count(),
            'rejected' => Pesanan::where('Status', 'rejected')->count(),
        ];

        return view('admin.pesanan', compact('pesanan', 'stats'));
    }

    public function show(Pesanan $pesanan): View
    {
        $pesanan->load(['paket', 'admin']);

        return view('admin.pesanan-detail', compact('pesanan'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan): RedirectResponse
    {
        $validated = $request->validate([
            'Status' => ['required', 'in:request,approved,rejected'],
        ]);

        $pesanan->update($validated);

        return back()->with('success', "Status pesanan #{$pesanan->Pesanan_id} diperbarui.");
    }
}