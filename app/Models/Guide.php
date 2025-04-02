<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    /** @use HasFactory<\Database\Factories\GuideFactory> */
    use HasFactory;

    protected $attributes = [
        'identifier_key' => '',
        'title' => '',
        'menu' => '',
        'body_content' => '',
    ];

    protected $casts = [
        'identifier_key' => 'string',
        'title' => 'string',
        'menu' => 'string',
        'body_content' => 'string',
    ];

    protected $fillable = [
        'identifier_key',
        'title',
        'menu',
        'body_content',
    ];
}
