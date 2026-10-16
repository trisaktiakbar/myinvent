<?php

namespace App\Http\Controllers;

use App\Models\ItemCode;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanBarangController extends Controller
{
    public function index()
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_time_planner_ho', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false]
        ])->orderBy('created_at', 'desc')->get();

        return view('inventory.permintaan-barang.index', compact('permintaan_barang'));
    }

    public function create()
    {
        $item_codes = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->orderBy('nama_item')->get();
        return view('inventory.permintaan-barang.create', compact('item_codes'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'item_code_id' => ['required', 'numeric'],
            'no_pp_manual' => ['nullable', 'string',  'max:255'],
            'kuantitas' => ['required', 'numeric',  'max:99999'],
            'uom' => ['nullable', 'string',  'max:255'],
            'estimasi_harga' => ['required', 'string', 'regex:/^\d{1,3}(\.\d{3})*$/', 'max:13'],
            'keterangan_alokasi' => ['nullable', 'string', 'max:255'],
        ]);

        $item_code = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->where('id', $req->item_code_id)->firstOrFail();

        Inventory::create([
            'slug' =>  Str::uuid()->toString(),
            'item_code_id' => $item_code->id,
            'no_pp_manual' => $req->no_pp_manual,
            'kuantitas' => $req->kuantitas,
            'uom' => $req->uom,
            'estimasi_harga' => Str::replace('.', '', $req->estimasi_harga),
            'keterangan_alokasi' => $req->keterangan_alokasi,
            'pembelian_lokal' => false
        ]);

        return redirect()->route('permintaan-barang.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function edit(Request $req)
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_time_planner_ho', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['slug', $req->slug]
        ])->firstOrFail();

        $item_codes = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->orderBy('nama_item')->get();
        return view('inventory.permintaan-barang.edit', compact('permintaan_barang', 'item_codes'));
    }

    public function update(Request $req)
    {

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_time_planner_ho', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['slug', $req->slug]
        ])->firstOrFail();

        $req->validate([
            'item_code_id' => ['required', 'string',  'max:255'],
            'no_pp_manual' => ['nullable', 'string',  'max:255'],
            'kuantitas' => ['required', 'numeric',  'max:99999'],
            'uom' => ['nullable', 'string',  'max:255'],
            'estimasi_harga' => ['required', 'string', 'regex:/^\d{1,3}(\.\d{3})*$/', 'max:13'],
            'keterangan_alokasi' => ['nullable', 'string', 'max:255'],
        ]);

        $item_code = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->where('id', $req->item_code_id)->firstOrFail();

        $permintaan_barang->update([
            'item_code_id' => $item_code->id,
            'no_pp_manual' => $req->no_pp_manual,
            'kuantitas' => $req->kuantitas,
            'uom' => $req->uom,
            'estimasi_harga' => Str::replace('.', '', $req->estimasi_harga),
            'keterangan_alokasi' => $req->keterangan_alokasi,
        ]);

        return redirect()->route('permintaan-barang.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function destroy(Request $req)
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['waktu_konfirmasi_purchasing', NULL],
            ['waktu_konfirmasi_time_planner_ho', NULL],
            ['waktu_konfirmasi_gudang_pusat', NULL],
            ['waktu_konfirmasi_gudang_central', NULL],
            ['waktu_konfirmasi_gudang_site', NULL],
            ['pembelian_lokal', false],
            ['slug', $req->slug]
        ])->firstOrFail();
        $permintaan_barang->delete();

        return redirect()->back();
    }
}
