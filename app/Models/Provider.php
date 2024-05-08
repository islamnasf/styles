<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Provider extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'providers';
    protected $attributes = [
        'type' => 0, 
    ];
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'phone',
        'email',
        'password',
        'active',
        'avater',
        'type',
    ];
    public function locations(){
        return $this->belongsTo(Location::class,'location_id');
      }
      public function services(){
        return $this->belongsTo(Service::class,'service_id');
      }
      public function gallery(){
        return $this->hasMany(Gallery::class,'provider_id');
      }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


   


    public function getJWTIdentifier()   
   		{
       		return $this->getKey();
    	}

		public function getJWTCustomClaims()
    	{
        	return [];
    	}
}
