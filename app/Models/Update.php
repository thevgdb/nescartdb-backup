<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    /** @use HasFactory<\Database\Factories\UpdateFactory> */
    use HasFactory;

    protected $attributes = [
        'title' => '',
        'posted_at' => null,
        'posted_by' => null,
        'body_content' => '',
        'is_hidden' => false,
    ];

    protected $casts = [
        'title' => 'string',
        'posted_at' => 'datetime',
        'posted_by' => 'string',
        'body_content' => 'string',
        'is_hidden' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'posted_at',
        'posted_by',
        'body_content',
        'is_hidden',
    ];
}
