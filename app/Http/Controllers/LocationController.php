<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Place;
class LocationController extends Controller
{
  public function index()
  {
    $place=Place::all();//where('price','>',500)->get();
    return view('place.index')->with("place",$place);
  }


}
