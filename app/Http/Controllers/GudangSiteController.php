<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangSiteController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Gudang Pusat') {
            $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', '<>', NULL)->where('waktu_konfirmasi_gudang_site', '<>', NULL)->orderBy('updated_at', 'desc')->get();
        } else {
            $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', '<>', NULL)->orderBy('updated_at', 'desc')->get();
        }
        return view('inventory.gudang-site.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
    {

        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', '<>', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        if (Auth::user()->role === "Gudang Site") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_site' => now()
            ]);
        }
        return redirect()->back();
    }
    public function abort(Request $req)
    {

        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', '<>', NULL)->where('waktu_konfirmasi_gudang_site', '<>', NULL)->where('slug', $req->slug)->firstOrFail();
        if (Auth::user()->role === "Gudang Site") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_site' => null
            ]);
        }
        return redirect()->back();
    }
}
