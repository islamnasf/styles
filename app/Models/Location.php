<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function providers(){
      return $this->hasMany(Provider::class,'location_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
      }
}
