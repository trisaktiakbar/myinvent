<?php

namespace App\Http\Controllers;

use App\Models\ItemCode;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianLokalController extends Controller
{
    public function index()
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['pembelian_lokal', true],
        ])->orderBy('created_at', 'desc')->get();

        return view('inventory.pembelian-lokal.index', compact('permintaan_barang'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'Gudang Site') {
            return redirect()->back();
        }

        $item_codes = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->orderBy('nama_item')->get();

        return view('inventory.pembelian-lokal.create', compact('item_codes'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'item_code_id' => ['required', 'numeric'],
            'kuantitas' => ['required', 'numeric',  'max:99999'],
            'uom' => ['nullable', 'string',  'max:255'],
            'estimasi_harga' => ['required', 'string', 'regex:/^\d{1,3}(\.\d{3})*$/', 'max:13'],
            'keterangan_alokasi' => ['nullable', 'string', 'max:255'],
        ]);

        $item_code = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->where('id', $req->item_code_id)->firstOrFail();

        if (Auth::user()->role === 'Gudang Site') {
            Inventory::create([
                'slug' =>  Str::uuid()->toString(),
                'item_code_id' => $item_code->id,
                'kuantitas' => $req->kuantitas,
                'uom' => $req->uom,
                'estimasi_harga' => Str::replace('.', '', $req->estimasi_harga),
                'keterangan_alokasi' => $req->keterangan_alokasi,
                'pembelian_lokal' => true,
                'waktu_konfirmasi_gudang_site' => now()
            ]);
        }


        return redirect()->route('pembelian-lokal.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function edit(Request $req)
    {
        if (Auth::user()->role !== 'Gudang Site') {
            return redirect()->back();
        }

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['pembelian_lokal', true],
            ['slug', $req->slug]
        ])->firstOrFail();

        $item_codes = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->orderBy('nama_item')->get();
        return view('inventory.pembelian-lokal.edit', compact('permintaan_barang', 'item_codes'));
    }

    public function update(Request $req)
    {

        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['pembelian_lokal', true],
            ['slug', $req->slug]
        ])->firstOrFail();

        $req->validate([
            'item_code_id' => ['required', 'string',  'max:255'],
            'kuantitas' => ['required', 'numeric',  'max:99999'],
            'uom' => ['nullable', 'string',  'max:255'],
            'estimasi_harga' => ['required', 'string', 'regex:/^\d{1,3}(\.\d{3})*$/', 'max:13'],
            'keterangan_alokasi' => ['nullable', 'string', 'max:255'],
        ]);

        $item_code = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->where('id', $req->item_code_id)->firstOrFail();



        if (Auth::user()->role === 'Gudang Site') {
            $permintaan_barang->update([
                'item_code_id' => $item_code->id,
                'kuantitas' => $req->kuantitas,
                'uom' => $req->uom,
                'estimasi_harga' => Str::replace('.', '', $req->estimasi_harga),
                'keterangan_alokasi' => $req->keterangan_alokasi,
            ]);
        }

        return redirect()->route('pembelian-lokal.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function destroy(Request $req)
    {
        $permintaan_barang = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->where([
            ['pembelian_lokal', true],
            ['slug', $req->slug]
        ])->firstOrFail();

        if (Auth::user()->role === 'Gudang Site') {
            $permintaan_barang->delete();
        }


        return redirect()->back();
    }
}
