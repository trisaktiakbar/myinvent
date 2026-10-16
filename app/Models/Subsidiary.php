<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subsidiary extends Model
{

    /** @use HasFactory<\Database\Factories\SubsidiaryFactory> */
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'slug',
        'subsidiary_name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'subsidiary_id');
    }

    public function itemCodes(): HasMany
    {
        return $this->hasMany(ItemCode::class, 'subsidiary_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'subsidiary_name',
                'onUpdate' => true,
            ]
        ];
    }
}
