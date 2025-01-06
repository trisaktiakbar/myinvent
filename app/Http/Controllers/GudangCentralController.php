<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangCentralController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Admin' || Auth::user()->role === 'Gudang Pusat') {
            $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', '<>', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->orderBy('updated_at', 'desc')->get();
        } else {
            $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->orderBy('updated_at', 'desc')->get();
        }
        return view('inventory.gudang-central.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
    {

        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        if (Auth::user()->role === "Gudang Central") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_central' => now()
            ]);
        }
        return redirect()->back();
    }
    public function abort(Request $req)
    {

        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', '<>', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        if (Auth::user()->role === "Gudang Central") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_central' => null
            ]);
        }
        return redirect()->back();
    }
}
