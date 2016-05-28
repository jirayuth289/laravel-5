<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Place;
use Image;
use File;
class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $place=Place::all();//where('price','>',500)->get();
      return view('place.management.index')->with("place",$place);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('place.management.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $mydate=getdate(date("U"));
     $date=$mydate['weekday'].','.$mydate['month'].' '.$mydate['mday'].','.$mydate['year'];

     $place = new Place();
     $place->hotelName=$request->hotelName;
     $place->descrip=$request->descrip;
     $place->Tel=$request->Tel;
     $place->email=$request->email;

     $place->addr=$request->addr;
     $place->Monthly_rental=$request->Monthly_rental;
     $place->Daily_rental=$request->Daily_rental;
     $place->deposit=$request->deposit;

     $place->cost_of_water=$request->cost_of_water;
     $place->cost_of_Electric=$request->cost_of_Electric;
     $place->cost_of_Internet=$request->cost_of_Internet;
     $place->cost_of_central=$request->cost_of_central;

     $place->lat=$request->lat;
     $place->longti=$request->longti;

     $air=$request->has_air;
     if($air==null){
       $air=0;
     }
     $place->has_air=$air;

     $net=$request->has_net;
     if($net==null){
       $net=0;
     }
     $place->has_net=$net;
     $furniture=$request->has_furniture;
     if($furniture==null){
       $furniture=0;
     }
     $place->has_furniture=$furniture;
     $tv=$request->has_tv;
     if($tv==null){
       $tv=0;
     }
     $place->has_tv=$tv;
     $heater=$request->has_water_heater;
     if($heater==null){
       $heater=0;
     }
     $place->has_water_heater=$heater;
     $machince=$request->has_wash_machine;
     if($machince==null){
       $machince=0;
     }
     $place->has_wash_machine=$machince;
     $parking=$request->has_parking;
     if($parking==null){
       $parking=0;
     }
    $place->has_parking=$parking;

    $place->time = $date;

             if ($request->hasFile('image')) {
             $filename = str_random(10) . '.' . $request->file('image')->getClientOriginalExtension();
             $request->file('image')->move(public_path() . '/images/', $filename);
             Image::make(public_path().'/images/'.$filename);
             $place->image = $filename;
             } else {
             $place->image = 'nopic.jpg';
             }

     $place->save();
     return redirect()->action('ManagementController@index');
    /*  $inputs=$request->all();

      $place=Place::Create($inputs);
      return redirect()->action('ManagementController@index');*/
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hotelID)
    {
      $place=Place::find($hotelID);
        return view('place.management.show')->with("place",$place);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($hotelID)
    {
      $place = Place::find($hotelID);

      return view('place.management.edit',compact('place',$place));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $hotelID)
    {

       //////-------------------------------------------------------
       $place =Place::find($hotelID);
       $name_image = $place->image;
       $place->hotelName=$request->hotelName;
       $place->descrip=$request->descrip;
       $place->Tel=$request->Tel;
       $place->email=$request->email;

       $place->addr=$request->addr;
       $place->Monthly_rental=$request->Monthly_rental;
       $place->Daily_rental=$request->Daily_rental;
       $place->deposit=$request->deposit;

       $place->cost_of_water=$request->cost_of_water;
       $place->cost_of_Electric=$request->cost_of_Electric;
       $place->cost_of_Internet=$request->cost_of_Internet;
       $place->cost_of_central=$request->cost_of_central;

       $place->lat=$request->lat;
       $place->longti=$request->longti;

       $air=$request->has_air;
       if(isset($air)){
         $air=1;
       }
       $place->has_air=$air;

       $net=$request->has_net;
       if(isset($net)){
         $net=1;
       }
       $place->has_net=$net;
       $furniture=$request->has_furniture;
       if(isset($furniture)){
         $furniture=1;
       }
       $place->has_furniture=$furniture;
       $tv=$request->has_tv;
       if($tv==null){
         $tv=1;
       }
       $place->has_tv=$tv;
       $heater=$request->has_water_heater;
       if(isset($heater)){
         $heater=1;
       }
       $place->has_water_heater=$heater;
       $machince=$request->has_wash_machine;
       if(isset($machince)){
         $machince=1;
       }
       $place->has_wash_machine=$machince;
       $parking=$request->has_parking;
       if(isset($parking)){
         $parking=1;
       }
      $place->has_parking=$parking;


if($request->image!=''){
  if ($request->hasFile('image')) {
  $filename = str_random(10) . '.' . $request->file('image')->getClientOriginalExtension();
  $request->file('image')->move(public_path() . '/images/', $filename);
  Image::make(public_path().'/images/'.$filename);
  $place->image = $filename;
  } else {
  $place->image = 'nopic.jpg';
  }
}
$place->save();
if($request->image!=''){
if ($name_image != 'nopic.jpg') {
File::delete(public_path() . '/images/' . $name_image);
}
}
       return redirect()->route('management.index');

       /////
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($hotelID)
    {
      $place=Place::find($hotelID)->delete();

       return redirect()->route('management.index');
    }
}
