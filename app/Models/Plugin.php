<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    /** @use HasFactory<\Database\Factories\PluginFactory> */
    use HasFactory;

    protected $attributes = [
        'filename' => '',
        'description' => '',
        'authors' => '',
        'prg' => '',
        'chr' => '',
        'wram' => '',
        'version' => '',
        'created' => null,
        'notes' => '',
        'is_hidden' => false,
    ];

    protected $casts = [
        'filename' => 'string',
        'description' => 'string',
        'authors' => 'string',
        'prg' => 'string',
        'chr' => 'string',
        'wram' => 'string',
        'version' => 'string',
        'created' => 'date',
        'notes' => 'string',
        'is_hidden' => 'boolean',
    ];

    protected $fillable = [
        'filename',
        'description',
        'authors',
        'prg',
        'chr',
        'wram',
        'version',
        'created',
        'notes',
        'is_hidden',
    ];
}
