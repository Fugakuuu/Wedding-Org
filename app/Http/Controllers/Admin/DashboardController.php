<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pesanan::with(['paket', 'admin']);

        if ($request->filled('status')) {
            $query->where('Status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('Nama_pemesan', 'like', "%{$search}%")
                  ->orWhere('Email_pemesan', 'like', "%{$search}%");
            });
        }

        $pesanan = $query->with('paket')->orderByDesc('Pesanan_id')->paginate(15);

        $countRequest  = Pesanan::where('Status', 'request')->count();
        $countApproved = Pesanan::where('Status', 'approved')->count();

        return view('admin.dashboard', compact('pesanan', 'countRequest', 'countApproved'));
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
