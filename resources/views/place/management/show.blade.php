@extends('layouts.layout1')

@section('title')
 {{$place->hotelName}}
@stop
<script src="http://maps.google.com/maps/api/js?sensor=false"
        type="text/javascript"></script>
@section('body')
<!--{!!Form::open([
  'method'=>'delete',
  'route'=>['management.destroy',$place->id]
  ])!!}-->
<div>
<h4>ข้อมูลรายละเอียด</h4>
  <table><tr>
    <td style="width:20%;">ชื่อ</td>
    <td>{{$place->hotelName}}</td>
  </tr><tr>
          <td>รายละเอียด</td>
          <td>{{$place->descrip}}</td>
        </tr><tr>
          <td>เบอร์โทร</td>
          <td>{{$place->Tel}}</td>
        </tr><tr>
          <td>อีเมลล์</td>
          <td>{{$place->email}}</td>
        </tr><tr>
          <td>ที่อยู่</td>
          <td>{{$place->addr}}</td>
        </tr>


        <tr>
          <td>ค่าเช่ารายวัน</td>
          <td>{{$place->Monthly_rental}}B</td>
        </tr><tr>
          <td>ค่าเช่ารายเดือน</td>
          <td>{{$place->Daily_rental}}B</td>
        </tr><tr>
          <td>ค่ามัดจำ</td>
          <td>{{$place->deposit}}B</td>
        </tr><tr>
          <td>ค่าน้ำ</td>
          <td>{{$place->cost_of_water}}B</td>
        </tr><tr>
          <td>ค่าไฟ</td>
          <td>{{$place->cost_of_Electric}}B</td>
        </tr><tr>
          <td>ค่าอินเตอร์เน็ต</td>
          <td>{{$place->cost_of_Internet}}B</td>
        </tr><tr>
          <td>ค่าส่วนกลาง</td>
          <td>{{$place->cost_of_central}}B</td>
        </tr>
      </table>
      <br>
      <h4>สิ่งอำนวยความสะดวก</h4>
      <table>
        <tr>
          <td style="text-align:center">เครื่องปรับอากาศ</td>
            <td style="text-align:center">เครื่องเฟอนิเจอร์</td>
              <td style="text-align:center">ทีวี</td>
                <td style="text-align:center">เครื่องทำอุ่น</td>
                  <td style="text-align:center">เครื่องซักผ้า</td>
                    <td style="text-align:center">ที่จอดรถ</td>
        </tr>
        <tr>

        @if($place->has_air==1)
          <td style="text-align:center"><img width="25" height="25" src="images/check.png"></td>
        @else
          <td>-</td>
        @endif

        @if($place->has_furniture==1)
          <td style="text-align:center"><img width="25" height="25" src="images/check.png"></td>
        @else
          <td>-</td>
        @endif

        @if($place->has_tv==1)
          <td style="text-align:center"><img width="25" height="25" src="images/check.png"></td>
        @else
          <td>-</td>
        @endif

        @if($place->has_water_heater==1)
          <td style="text-align:center"><img width="25" height="25" src="images/check.png"></td>
        @else
          <td>-</td>
        @endif
        @if($place->has_wash_machine==1)
          <td style="text-align:center"><img width="25" height="25" src="images/check.png"></td>
        @else
          <td>-</td>
        @endif
        @if($place->has_parking==1)
          <td style="text-align:center"><img width="25" height="25" src="images/check.png"></td>
        @else
          <td>-</td>
        @endif
        </tr>
      </table>

      <!--  <input type="button" onclick="location.href='{{ URL::to('edit='.$place->id) }}';" value="Edit" />
        {!!Form::submit('Delete')!!}
      {!!Form::close()!!}-->
      <br>
      <table>
        <tr>
            <td style="text-align:center">
              แผนที่
          </td>
        </tr>
        <tr>

          <td>
            <div id="map" style="width: auto; height: 400px;"></div>

          </td>
        </tr>
      </table>
</div>




<!--Map-->
<script type="text/javascript">

var locations = [
['<h4>{{$place->hotelName}} Place</h4>', {{$place->lat}}, {{$place->longti}}, 4],

];


var map = new google.maps.Map(document.getElementById('map'), {
zoom: 10,
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
