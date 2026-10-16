<?php

namespace App\Exports;

use App\Models\Inventory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryByLokasiExport implements FromView, WithStyles
{
    protected $arguments;
    public function __construct($arguments)
    {
        $this->arguments = $arguments;
    }

    public function view(): View
    {
        $inventories = Inventory::whereHas('itemCode.subsidiary', function ($query) {
            $query->where('id', Auth::user()->subsidiary_id);
        });

        if ($this->arguments['lokasi'] === 'permintaan-barang') {
            $lokasi = 'Permintaan Barang';
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', NULL],
                ['waktu_konfirmasi_purchasing', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($this->arguments['lokasi'] === 'time-planner-ho') {
            $lokasi = 'Permintaan Barang';
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($this->arguments['lokasi'] === 'purchasing') {
            $lokasi = 'Permintaan Barang';
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($this->arguments['lokasi'] === 'gudang-pusat') {
            $lokasi = 'Gudang Pusat';
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($this->arguments['lokasi'] === 'gudang-central') {
            $lokasi = 'Gudang Central';
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', '<>', NULL],
                ['waktu_konfirmasi_gudang_site', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($this->arguments['lokasi'] === 'gudang-site') {
            $lokasi = 'Gudang Site';
            $inventories = $inventories->where([
                ['waktu_konfirmasi_time_planner_ho', '<>', NULL],
                ['waktu_konfirmasi_purchasing', '<>', NULL],
                ['waktu_konfirmasi_gudang_pusat', '<>', NULL],
                ['waktu_konfirmasi_gudang_central', '<>', NULL],
                ['waktu_konfirmasi_gudang_site', '<>', NULL],
                ['pembelian_lokal', false],
            ]);
        } else if ($this->arguments['lokasi'] === 'pembelian-lokal') {
            $lokasi = 'Pembelian Lokal';
            $inventories = $inventories->where([
                ['pembelian_lokal', true],
            ]);
        }

        $inventories = $inventories->get();

        return view(
            'exports.inventory-by-lokasi',
            [
                'inventories' => $inventories,
                'lokasi' => $lokasi,
            ]
        );
    }

    public function styles(Worksheet $sheet)
    {
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
