@extends('layouts.layout1')

@section('title')
   ALL Place
@stop

@section('body')
   <h2>List Place</h2>
   <div >
     <a href="{{ URL::to('add=create') }}">[Add Place]</a>

     <table style="margin-top:1%">
       <tr style="background-color: #f2f2f2">
         <td style="width:4%">
           #
         </td>
         <td style="width:20%">
           <b>Name</b>
         </td>
         <td style="width:30%">
           <b>address</b>
         </td>
         <td style="width:10%">
           <b>Option</b>
         </td>
       </tr>
     <tr>
<?php
$i=1;
 ?>
        @foreach ($place as $data)
        <td>
          <?=$i++?>
        </td>
        <td>
          <a href="{{ URL::to('index='.$data->id) }}">{{$data->hotelName}}</a>
        </td>
        <td>
          {{$data->addr}}
        </td>
          <td>
            <input type="button" onclick="location.href='{{ URL::to('edit='.$data->id) }}';" value="Edit" />
            <input type="button" onclick="location.href='{{ URL::to('delete/'.$data->id) }}';" value="delete" />
          </td>
         </tr>

        @endforeach
        </table>
        <br>
   </div>
@stop
