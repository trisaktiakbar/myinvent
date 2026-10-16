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
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where('pembelian_lokal', false);
        if (Auth::user()->role === 'Permintaan Barang' || Auth::user()->role === 'Time Planner HO' || Auth::user()->role === 'Purchasing') {
            $permintaan_barang = $permintaan_barang->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL]
            ]);
        } else {
            $permintaan_barang = $permintaan_barang->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
            ]);
        }
        $permintaan_barang = $permintaan_barang->orderBy('created_at', 'desc')->get();
        return view('inventory.gudang-pusat.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
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
            ['slug', $req->slug],
        ])->firstOrFail();

        if (Auth::user()->role === "Gudang Pusat") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_pusat' => now()
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
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['slug', $req->slug]
        ])->firstOrFail();

        if (Auth::user()->role === "Gudang Pusat") {
            $permintaan_barang->update([
                'waktu_konfirmasi_gudang_pusat' => NULL,
                'no_pengiriman' => NULL,
                'pengiriman_langsung_gudang_site' => NULL,
            ]);
        }
        return redirect()->back();
    }

    public function deliver(Request $req)
    {
        $req->validate([
            'no_pengiriman' => ['required', 'string', 'max:255'],
            'lokasi_tujuan' => ['required', 'string']
        ]);

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['no_pengiriman', NULL],
            ['slug', $req->slug]
        ])->firstOrFail();

        if (Auth::user()->role === "Gudang Pusat") {
            if ($req->lokasi_tujuan === 'gudang-central') {
                $permintaan_barang->update([
                    'no_pengiriman' => $req->no_pengiriman
                ]);
            } elseif ($req->lokasi_tujuan === 'gudang-site') {
                $permintaan_barang->update([
                    'no_pengiriman' => $req->no_pengiriman,
                    'pengiriman_langsung_gudang_site' => true
                ]);
            }
        }
        return redirect()->back();
    }
}
