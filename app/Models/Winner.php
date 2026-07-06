<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    public const CATEGORIES = ['A1', 'A2', 'A3', 'A5', 'BS', 'C'];

    public const RANKS = [
        '1' => 'Juara 1',
        '2' => 'Juara 2',
        '3' => 'Juara 3',
        'merah' => 'Juara Merah',
    ];

    protected $fillable = [
        'image',
        'category',
        'rank',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->latest('id');
    }
}
