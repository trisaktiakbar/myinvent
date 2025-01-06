<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PermintaanBarangController extends Controller
{
    public function index()
    {
        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->orderBy('updated_at', 'desc')->get();
        return view('inventory.permintaan-barang.index', compact('permintaan_barang'));
    }

    public function create()
    {
        return view('inventory.permintaan-barang.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'kode_item' => ['required', 'string',  'max:255', 'unique:' . Inventory::class],
            'nama_item' => ['required', 'string',  'max:255'],
            'no_pp_manual' => ['nullable', 'string',  'max:255'],
            'no_pr' => ['nullable', 'string',  'max:255'],
            'kuantitas' => ['required', 'numeric',  'max:99999'],
            'uom' => ['nullable', 'string',  'max:255'],
            'estimasi_harga' => ['required', 'string', 'regex:/^\d{1,3}(\.\d{3})*$/', 'max:13'],
            'keterangan_alokasi' => ['nullable', 'string', 'max:255'],
        ]);

        Inventory::create([
            'kode_item' => $req->kode_item,
            'nama_item' => $req->nama_item,
            'no_pp_manual' => $req->no_pp_manual,
            'no_pr' => $req->no_pr,
            'kuantitas' => $req->kuantitas,
            'uom' => $req->uom,
            'estimasi_harga' => Str::replace('.', '', $req->estimasi_harga),
            'keterangan_alokasi' => $req->keterangan_alokasi,
        ]);

        return redirect()->route('permintaan-barang.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function edit(Request $req)
    {
        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        return view('inventory.permintaan-barang.edit', compact('permintaan_barang'));
    }

    public function update(Request $req)
    {
        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();

        $req->validate([
            'nama_item' => ['required', 'string',  'max:255'],
            'no_pp_manual' => ['nullable', 'string',  'max:255'],
            'no_pr' => ['nullable', 'string',  'max:255'],
            'kuantitas' => ['required', 'numeric',  'max:99999'],
            'uom' => ['nullable', 'string',  'max:255'],
            'estimasi_harga' => ['required', 'string', 'regex:/^\d{1,3}(\.\d{3})*$/', 'max:13'],
            'keterangan_alokasi' => ['nullable', 'string', 'max:255'],
        ]);

        if ($permintaan_barang->kode_item !== $req->kode_item) {
            $req->validate([
                'kode_item' => ['required', 'string',  'max:255', 'unique:' . Inventory::class],
            ]);
        }

        $permintaan_barang->update([
            'kode_item' => $req->kode_item,
            'nama_item' => $req->nama_item,
            'no_pp_manual' => $req->no_pp_manual,
            'no_pr' => $req->no_pr,
            'kuantitas' => $req->kuantitas,
            'uom' => $req->uom,
            'estimasi_harga' => Str::replace('.', '', $req->estimasi_harga),
            'keterangan_alokasi' => $req->keterangan_alokasi,
        ]);

        return redirect()->route('permintaan-barang.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function destroy(Request $req)
    {
        $permintaan_barang = Inventory::where('waktu_konfirmasi_gudang_pusat', NULL)->where('waktu_konfirmasi_gudang_central', NULL)->where('waktu_konfirmasi_gudang_site', NULL)->where('slug', $req->slug)->firstOrFail();
        $permintaan_barang->delete();

        return redirect()->back();
    }
}
