<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasingController extends Controller
{
    public function index()
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where('pembelian_lokal', false);

        if (Auth::user()->role === 'Permintaan Barang' || Auth::user()->role === 'Time Planner HO') {
            $permintaan_barang = $permintaan_barang->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing',  '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
            ]);
        } else {
            $permintaan_barang = $permintaan_barang->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
            ]);
        }
        $permintaan_barang = $permintaan_barang->orderBy('created_at', 'desc')->get();
        return view('inventory.purchasing.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
    {

        $req->validate([
            'no_po' => ['required', 'string', 'max:255'],
        ]);

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['no_po', NULL],
            ['slug', $req->slug],
        ])->firstOrFail();

        if (Auth::user()->role === "Purchasing") {
            $permintaan_barang->update([
                'no_po' => $req->no_po,
                'waktu_konfirmasi_purchasing' => now()
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
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['no_po', '<>', NULL],
            ['slug', $req->slug],
        ])->firstOrFail();

        if (Auth::user()->role === "Purchasing") {
            $permintaan_barang->update([
                'no_po' => NULL,
                'waktu_konfirmasi_purchasing' => NULL
            ]);
        }
        return redirect()->back();
    }
}
