<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangSiteController extends Controller
{
    public function index()
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where(function ($query) {
            $query->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', '<>', NULL]
            ])->orWhere('pengiriman_langsung_gudang_site', true);
        });

        if (Auth::user()->role === 'Permintaan Barang' || Auth::user()->role === 'Gudang Pusat' || Auth::user()->role === 'Gudang Central') {
            $permintaan_barang = $permintaan_barang->where('waktu_konfirmasi_gudang_site', '<>', NULL);
        }

        $permintaan_barang = $permintaan_barang->where([
            ['no_pengiriman', '<>', NULL],
            ['pembelian_lokal', false],
        ])->orderBy('created_at', 'desc')->get();

        return view('inventory.gudang-site.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
            ['waktu_konfirmasi_purchasing', '<>', NULL],
            ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
            ['waktu_konfirmasi_gudang_central', '<>', NULL]
        ])->orWhere('pengiriman_langsung_gudang_site', true)->where([
            ['waktu_konfirmasi_gudang_site', NULL],
            ['no_pengiriman', '<>', NULL],
            ['pembelian_lokal', false],
            ['slug', $req->slug]
        ])->firstOrFail();

        if (Auth::user()->role === "Gudang Site") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_site' => now()
            ]);
        }
        return redirect()->back();
    }
    public function abort(Request $req)
    {

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
            ['waktu_konfirmasi_purchasing', '<>', NULL],
            ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
            ['waktu_konfirmasi_gudang_central', '<>', NULL]
        ])->orWhere('pengiriman_langsung_gudang_site', true)->where([
            ['waktu_konfirmasi_gudang_site', '<>', NULL],
            ['no_pengiriman', '<>', NULL],
            ['pembelian_lokal', false],
            ['slug', $req->slug]
        ])->firstOrFail();

        if (Auth::user()->role === "Gudang Site") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_site' => null
            ]);
        }

        return redirect()->back();
    }
}
