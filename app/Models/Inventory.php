<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    /** @use HasFactory<\Database\Factories\InventoryFactory> */
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'slug',
        'item_code_id',
        'no_pp_manual',
        'no_pr',
        'no_po',
        'kuantitas',
        'uom',
        'estimasi_harga',
        'keterangan_alokasi',
        'waktu_konfirmasi_time_planner_ho',
        'waktu_konfirmasi_purchasing',
        'waktu_konfirmasi_gudang_pusat',
        'waktu_konfirmasi_gudang_central',
        'waktu_konfirmasi_gudang_site',
        'pengiriman_langsung_gudang_site',
        'pembelian_lokal',
        'no_pengiriman',
    ];

    public function itemCode(): BelongsTo
    {
        return $this->belongsTo(ItemCode::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug',
                'onUpdate' => true,
            ]
        ];
    }
}
