<?php

namespace App\Http\Controllers;

use App\Models\KatalogPaket;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $paket = KatalogPaket::orderBy('Harga')->get();

        return view('home', compact('paket'));
    }
}
