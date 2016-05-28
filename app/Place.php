<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
  protected $fillable=[
  'id',
 'hotelName',
 'descrip',
 'Tel',
 'email',
 'addr',
 'Monthly_rental',
 'Daily_rental',
 'deposit',
 'cost_of_water',
 'cost_of_Electric',
 'cost_of_Internet',
 'cost_of_central',
 'lat','longti',
 'has_air','has_net',
 'has_furniture',
 'has_tv',
 'has_water_heater',
 'has_wash_machine',
 'has_parking',
 'time',
 'image','eID'
];
  public $timestamps=false;

  protected $table ='place';
}
