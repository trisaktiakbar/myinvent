<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCode extends Model
{
    use Sluggable;

    protected $fillable = [
        'subsidiary_id',
        'slug',
        'kode_item',
        'nama_item',
    ];


    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'item_code_id');
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kode_item',
                'onUpdate' => true,
            ]
        ];
    }
}
