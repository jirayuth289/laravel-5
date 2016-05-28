<?php
use App\Place;

Route::get('-',function(){
  return view('place.index');
});

Route::resource('/', 'LocationController');

Route::resource('management', 'ManagementController');
Route::get('index={id}','ManagementController@show', function(){});
Route::get('add={id}','ManagementController@create', function(){});
Route::get('edit={id}','ManagementController@edit', function(){});

Route::get('delete/{id}', [
      'method' => 'delete',
      'uses' => 'ManagementController@destroy'
  ]);

Route::resource('search', 'SearchControll');
/*Route::post('search2',function(){
  $keyword =Input::get('keyword');

  $place1=Place::where('hotelName','LIKE','%'.$keyword.'%')->get();
  //  var_dump('search results');
  foreach ($place1 as $places) {
    $place=$places->hotelName;
  }
  echo $place;
    //return view('place.index')->with("name",$name);

});*/

  Route::get('about',
    array('as' => 'about',
    'uses' => 'PagesController@getAbout'));

    Route::get('contact',
      array('as' => 'contact',
      'uses' => 'PagesController@getContact'));

Route::resource('product', 'ProductController');
