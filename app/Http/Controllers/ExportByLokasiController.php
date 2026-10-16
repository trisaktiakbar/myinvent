<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryByLokasiExport;

class ExportByLokasiController extends Controller
{
    public function index(Request $req)
    {
        $inventories = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        })->get();

        $data["Permintaan Barang"] = 0;
        $data["Time Planner HO"] = 0;
        $data["Purchasing"] = 0;
        $data["Gudang Pusat"] = 0;
        $data["Gudang Central"] = 0;
        $data["Gudang Site"] = 0;
        $data["Pembelian Lokal"] = 0;

        foreach ($inventories as $inventory) {
            if ($inventory->pembelian_lokal) {
                $data["Pembelian Lokal"]++;
            } else if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_site) {
                $data["Gudang Site"]++;
            } else if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_central && !$inventory->waktu_konfirmasi_gudang_site) {
                $data["Gudang Central"]++;
            } else if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_gudang_pusat && !$inventory->waktu_konfirmasi_gudang_central && !$inventory->waktu_konfirmasi_gudang_site) {
                $data["Gudang Pusat"]++;
            } else if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_purchasing && !$inventory->waktu_konfirmasi_gudang_pusat && !$inventory->waktu_konfirmasi_gudang_central && !$inventory->waktu_konfirmasi_gudang_site) {
                $data["Purchasing"]++;
            } else if (!$inventory->pembelian_lokal && $inventory->waktu_konfirmasi_time_planner_ho && !$inventory->waktu_konfirmasi_purchasing && !$inventory->waktu_konfirmasi_gudang_pusat && !$inventory->waktu_konfirmasi_gudang_central && !$inventory->waktu_konfirmasi_gudang_site) {
                $data["Time Planner HO"]++;
            } else if (!$inventory->pembelian_lokal && !$inventory->waktu_konfirmasi_time_planner_ho && !$inventory->waktu_konfirmasi_purchasing && !$inventory->waktu_konfirmasi_gudang_pusat && !$inventory->waktu_konfirmasi_gudang_central && !$inventory->waktu_konfirmasi_gudang_site) {
                $data["Permintaan Barang"]++;
            }
        }
        return view('export-data.lokasi.index', compact('data'));
    }

    public function show(Request $req)
    {
        $lokasi = $req->lokasi;

        $inventories = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        });

        if ($lokasi === 'gudang-site') {
            $inventories = $inventories->where([
                ['waktu_konfirmasi_gudang_site', '<>', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($lokasi === 'gudang-central') {
            $inventories = $inventories->where([
                ['waktu_konfirmasi_gudang_central', '<>', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($lokasi === 'gudang-pusat') {
            $inventories = $inventories->where([
                ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($lokasi === 'purchasing') {
            $inventories = $inventories->where([
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($lokasi === 'time-planner-ho') {
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($lokasi === 'permintaan-barang') {
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', NULL],
                ['waktu_konfirmasi_purchasing', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($lokasi === 'pembelian-lokal') {
            $inventories = $inventories->where([
                ['pembelian_lokal', true],
            ]);
        }

        $inventories = $inventories->orderBy('created_at')->get();

        return view('export-data.lokasi.show', compact('inventories', 'lokasi'));
    }

    public function export(Request $req)
    {
        $lokasi = $req->slug;

        $filename = $lokasi . '.xlsx';


        return Excel::download(new InventoryByLokasiExport(['lokasi' => $lokasi]), $filename);
    }
}
