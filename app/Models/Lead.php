<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
   protected $fillable = [
  'name','phone','email',
  'housing_type','lat','lng','area_m2','geojson','bill_monthly',
  'ip','user_agent'
];
 
}
