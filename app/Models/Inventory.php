<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'slug',
        'kode_item',
        'nama_item',
        'no_pp_manual',
        'no_pr',
        'kuantitas',
        'uom',
        'estimasi_harga',
        'keterangan_alokasi',
        'waktu_konfirmasi_gudang_pusat',
        'waktu_konfirmasi_gudang_central',
        'waktu_konfirmasi_gudang_site',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_item',
                'onUpdate' => true,
            ]
        ];
    }
}
