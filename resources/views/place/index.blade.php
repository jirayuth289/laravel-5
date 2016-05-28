@extends('layouts.layout1')

@section('title')
   Home
@stop
<script src="http://maps.google.com/maps/api/js?sensor=false"
        type="text/javascript"></script>
@section('body')

        <div class="jumbotron" >
          <div style="text-align:left;margin-top:-3%;">
             {!!Form::open(['route'=>'search.index','method'=>'GET','class'=>'Class_name'])!!}
                    {!!Form::label('Search: ')!!}
                    {!!Form::text('keyword')!!}
                    {!!Form::submit('Search')!!}
                    {!!Form::close()!!}
          </div>
          <div id="map" style="width: auto; height: 400px;"></div>

        </div>

        <div class="row marketing">

            @foreach ($place as $data)
              <div class="col-lg-6">
            <table>
              <tr>
                <td style="width:20%;">
                  <img src="images/{{$data->image}}" width="150" height="100">
                </td>
                <td>
                  <h4><a href="{{ URL::to('index='.$data->id) }}">{{$data->hotelName}}</a></h4>
                  <p>รายละเอียด:{{$data->descrip}}</p>
                  <p>{{$data->time}}</p>
                </td>
              </tr>
            </table>
             </div>


            @endforeach
        </div>

        <!--Map-->
        <script type="text/javascript">

    var locations = [
      @foreach ($place as $data)
      ['<h4>{{$data->hotelName}}</h4><img width="120" heigth="100" src="images/{{$data->image}}"><br><a href="{{ URL::to('index='.$data->id) }}">ดูรายละเอียด</a>', {{$data->lat}}, {{$data->longti}}, 4],
      @endforeach
    ];


    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: new google.maps.LatLng(15.117019, 104.900667),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon:'images/icon_hotel.png'
      });

      google.maps.event.addListener(marker, 'mousemove', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));

    /*
    google.maps.event.addListener(marker, 'mouseout',
      function() {
        infowindow.close();
      });
    */

    }
  </script>
@stop
