<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use Notifiable;

    protected $attributes = [
        'name' => '',
        'email' => '',
        'email_verified_at' => null,
        'password' => '',
        'remember_token' => '',
        'registered_at' => null,
        'last_login_at' => null,
        'login_count' => 0,
        'last_ip' => '',
        'last_activity_at' => null,
        'is_admin' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'remember_token' => 'string',
        'registered_at' => 'datetime',
        'last_login_at' => 'datetime',
        'login_count' => 'integer',
        'last_ip' => 'string',
        'last_activity_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

//    /**
//     * Get the attributes that should be cast.
//     *
//     * @return array<string, string>
//     */
//    protected function casts(): array
//    {
//        return [
//            'name' => 'string',
//            'email' => 'string',
//            'email_verified_at' => 'datetime',
//            'password' => 'hashed',
//            'remember_token' => 'string',
//            'registered_at' => 'datetime',
//            'last_login_at' => 'datetime',
//            'login_count' => 'integer',
//            'last_ip' => 'string',
//            'last_activity_at' => 'datetime',
//            'is_admin' => 'boolean',
//        ];
//    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'registered_at',
        'last_login_at',
        'login_count',
        'last_ip',
        'last_activity_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isGuest(): bool
    {
        return is_null( $this->getAttribute('registered_at') );
    }

    public function isRegistered(): bool
    {
        return !$this->isGuest();
    }

    public function isAdmin(): bool
    {
        return (bool)$this->getAttribute('is_admin');
    }


    public function cartContributions(): HasMany
    {
        return $this->hasMany(Cart::class, 'submitter_id', 'id');
    }

    public function cartImageContributions(): HasMany
    {
        return $this->hasManyThrough(CartImage::class, Cart::class, 'submitter_id', 'id');
    }

}
