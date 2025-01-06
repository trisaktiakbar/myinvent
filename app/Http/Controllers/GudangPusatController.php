<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangPusatController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Admin') {
            $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->orderBy('updated_at', 'desc')->get();
        } else {
            $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->orderBy('updated_at', 'desc')->get();
        }
        return view('inventory.gudang-pusat.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
    {

        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        if (Auth::user()->role === "Gudang Pusat") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_pusat' => now()
            ]);
        }
        return redirect()->back();
    }
    public function abort(Request $req)
    {

        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', '<>', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        if (Auth::user()->role === "Gudang Pusat") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_pusat' => null
            ]);
        }
        return redirect()->back();
    }
}
