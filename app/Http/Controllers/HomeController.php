<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('home.index-admin');
            }
        }

        return view('home.index')->with([
            'products' => $products
        ]);
    }

    public function pencarian(Request $request)
    {
        $validatedData = $request->validate([
            'kata_kunci' => 'required',
        ]);

        $kata_kunci = $validatedData['kata_kunci'];

        $products = Product::where('nama', 'LIKE', '%'.$kata_kunci.'%')
        ->orWhere('keterangan', 'LIKE', '%'.$kata_kunci.'%')->get();

        return view('home.index-search')->with([
            'keyword' => $kata_kunci,
            'products' => $products,
        ]);
    }
}
