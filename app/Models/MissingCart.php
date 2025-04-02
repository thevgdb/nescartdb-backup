<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissingCart extends Model
{
    /** @use HasFactory<\Database\Factories\MissingCartFactory> */
    use HasFactory;

    protected $attributes = [
        'region' => '',
        'catalog_id' => '',
        'game_title' => '',
        'game_subtitle' => '',
        'released' => '',
        'publisher' => '',
        'system' => '',
        'class' => '',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $casts = [
        'region' => 'string',
        'catalog_id' => 'string',
        'game_title' => 'string',
        'game_subtitle' => 'string',
        'released' => 'string',
        'publisher' => 'string',
        'system' => 'string',
        'class' => 'string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'region',
        'catalog_id',
        'game_title',
        'game_subtitle',
        'released',
        'publisher',
        'system',
        'class',
    ];
}
