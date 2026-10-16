<?php

namespace App\Exports;

use App\Models\ItemCode;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryByKodeItemExport implements FromView, WithStyles
{

    protected $arguments;
    public function __construct($arguments)
    {
        $this->arguments = $arguments;
    }

    public function view(): View
    {
        $item_code =  ItemCode::where([
            ['subsidiary_id', Auth::user()->subsidiary_id],
            ['slug', $this->arguments['item_code_slug']]
        ])->firstOrFail();

        return view(
            'exports.inventory-by-kode-item',
            [
                'item_code' => $item_code
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
