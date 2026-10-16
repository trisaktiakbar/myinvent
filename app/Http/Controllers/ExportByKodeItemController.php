<?php

namespace App\Http\Controllers;

use App\Models\ItemCode;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryByKodeItemExport;

class ExportByKodeItemController extends Controller
{
    public function index(Request $req)
    {
        $item_codes = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id);

        if ($req->search) {
            $item_codes = $item_codes->whereAny(['kode_item', 'nama_item'], 'like', "%{$req->search}%");
        }

        $item_codes = $item_codes->orderBy('kode_item')->get();
        return view('export-data.kode-item.index', compact('item_codes'));
    }

    public function show(Request $req)
    {
        $item_code = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->where('slug', $req->slug)->firstOrFail();
        $inventories = Inventory::where('item_code_id', $item_code->id)->orderBy('created_at')->get();

        return view('export-data.kode-item.show', compact('inventories', 'item_code'));
    }

    public function export(Request $req)
    {
        $item_code = ItemCode::where('subsidiary_id', Auth::user()->subsidiary_id)->where('slug', $req->slug)->firstOrFail();

        $filename = $item_code->kode_item . '.xlsx';

        return Excel::download(new InventoryByKodeItemExport(['item_code_slug' => $item_code->slug]), $filename);
    }
}
