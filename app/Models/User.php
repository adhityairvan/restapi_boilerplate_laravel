<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Sametsahindogan\JWTRedis\Traits\JWTRedisHasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, JWTRedisHasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * implement get auth identifier to specified what data goes in our WJT Token
     *
     * @return integer
     */
    public function getJWTIdentifier()
    {
        // return our user id
        return $this->getKey();
    }

    /**
     * specify extra data we want in our Token
     *
     * @return void
     */
    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name
        ];
    }
}
