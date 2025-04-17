<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UniqueGame extends Model
{
    /** @use HasFactory<\Database\Factories\UniqueGameFactory> */
    use HasFactory;

    protected $table = "unique_games";

    protected $attributes = [
        'title' => '',
    ];

    protected $casts = [
        'title' => 'string',
    ];

    protected $fillable = [
        'title',
    ];

//    protected $with = ['cartProfiles'];

    public function cartProfiles(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
