<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimePlannerHOController extends Controller
{
    public function index()
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where('pembelian_lokal', false);
        if (Auth::user()->role === 'Permintaan Barang') {
            $permintaan_barang = $permintaan_barang->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL]
            ]);
        } else {
            $permintaan_barang = $permintaan_barang->where([
                ['waktu_konfirmasi_purchasing', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
            ]);
        }
        $permintaan_barang = $permintaan_barang->orderBy('created_at', 'desc')->get();
        return view('inventory.time-planner-ho.index', compact('permintaan_barang'));
    }

    public function confirm(Request $req)
    {

        $req->validate([
            'no_pr' => ['required', 'string', 'max:255'],
        ]);

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_time_planner_ho', NULL],
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['no_pr', NULL],
            ['slug', $req->slug],
        ])->firstOrFail();

        if (Auth::user()->role === "Time Planner HO") {
            $permintaan_barang->update([
                'no_pr' => $req->no_pr,
                'waktu_konfirmasi_time_planner_ho' => now()
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
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['no_pr', '<>', NULL],
            ['slug', $req->slug],
        ])->firstOrFail();

        if (Auth::user()->role === "Time Planner HO") {
            $permintaan_barang->update([
                'no_pr' => NULL,
                'waktu_konfirmasi_time_planner_ho' => NULL
            ]);
        }
        return redirect()->back();
    }
}
