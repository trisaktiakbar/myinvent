<?php

namespace App\Http\Controllers;

use App\Models\ItemCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaItemController extends Controller
{
    public function index(Request $req)
    {
        $item_codes = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id);

        if ($req->search) {
            $item_codes = $item_codes->whereAny(['nama_item', 'kode_item'], 'like', '%' . $req->search . '%');
        }
        $item_codes = $item_codes->orderBy('kode_item')->get();
        return view('manajemen-item.kelola-item.index', compact('item_codes'));
    }

    public function create()
    {
        return view('manajemen-item.kelola-item.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'kode_item' => ['required', 'string',  'max:255'],
            'nama_item' => ['required', 'string',  'max:255'],
        ]);

        ItemCode::create([
            'kode_item' => $req->kode_item,
            'nama_item' => $req->nama_item,
            'subsidiary_id' => Auth::user()->subsidiary_id
        ]);

        return redirect()->route('kelola-item.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function edit(Request $req)
    {
        $item_code = ItemCode::where('slug', $req->slug)->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrFail();
        return view('manajemen-item.kelola-item.edit', compact('item_code'));
    }

    public function update(Request $req)
    {
        $item_code = ItemCode::where('slug', $req->slug)->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrFail();

        $req->validate([
            'nama_item' => ['required', 'string',  'max:255'],
        ]);

        if ($req->kode_item !== $item_code->kode_item) {
            $req->validate([
                'kode_item' => ['required', 'string',  'max:255'],
            ]);
        }

        $item_code->update([
            'kode_item' => $req->kode_item,
            'nama_item' => $req->nama_item,
        ]);

        return redirect()->route('kelola-item.index')->withHeaders(['Cache-Control' => 'no-store']);
    }

    public function destroy(Request $req)
    {
        $item_code = ItemCode::where('slug', $req->slug)->where('subsidiary_id', Auth::user()->subsidiary_id)->firstOrFail();
        $item_code->delete();

        return redirect()->back();
    }
}
