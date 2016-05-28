@extends('layouts.layout1')

@section('title')
Edit {{$place->hotelname}}
@stop
<style type="text/css">
#map_canvas {
    width:450px;
    height:300px;
    margin:auto;
/*  margin-top:100px;*/
}
</style>
@section('body')

  <h4>Update Place</h4>
    <div class="jumbotron" >
  {!!Form::model($place,[
    'method'=>'patch',
    'route'=>['management.update',$place->id],'files'=>true
    ]) !!}

    <table>
      <tr>
      <td>ชื่อ:</td>
      <td>{!!Form::text('hotelName',$place->hotelName,['placeholder'=>""])!!}</td>
    </tr><tr>
        <td>รายละเอียด:</td>
        <td>{!!Form::textarea('descrip',$place->descrip,['placeholder'=>""])!!}</td>
        </tr>
        <tr>
        <td>เบอร์โทร:</td>
        <td>{!!Form::text('Tel',$place->Tel,['placeholder'=>""])!!}</td>
      </tr><tr>
        <td>อีเมลล์:</td>
        <td>{!!Form::text('email',$place->email,['placeholder'=>""])!!}</td>
      </tr>
      <tr>
          <td>ที่อยู่:</td>
          <td>{!!Form::textarea('addr',$place->addr,['placeholder'=>""])!!}</td>
          </tr>

          <tr>
              <td>แผนที่:</td>
              <td ><div style="margin-left:0%" id="map_canvas"></div> </td>
              </tr>
              <tr>
              <td>ละติจูด:</td>
              <td><input  name="lat" type="text" id="lati" value="{{$place->lat}}"/></td>
            </tr><tr>
                <td>ลองจิจูด:</td>
                <td><input  name="longti" type="text" id="longti" value="{{$place->longti}}" /></td>
                </tr>


    <tr>
                <td>ค่าเช่ารายวัน:</td>
                <td>{!!Form::text('Daily_rental',$place->Monthly_rental,['placeholder'=>""])!!}</td>
                </tr>
                <tr>
                <td>ค่าเช่ารายเดือน:</td>
                <td>{!!Form::text('Monthly_rental',$place->Daily_rental,['placeholder'=>""])!!}</td>
              </tr><tr>
                  <td>ค่ามัดจำ:</td>
                  <td>{!!Form::text('deposit',$place->deposit,['placeholder'=>""])!!}</td>
                  </tr><tr>
                      <td>ค่าน้ำ:</td>
                      <td>{!!Form::text('cost_of_water',$place->cost_of_water,['placeholder'=>""])!!}</td>
                      </tr>
                      <tr>
                      <td>ค่าไฟ:</td>
                      <td>{!!Form::text('cost_of_Electric',$place->cost_of_Electric,['placeholder'=>""])!!}</td>
                    </tr><tr>
                        <td>ค่าอินเตอร์เน็ต:</td>
                        <td>{!!Form::text('cost_of_Internet',$place->cost_of_Internet,['placeholder'=>""])!!}</td>
                        </tr>
                        <tr>
                            <td>ค่าส่วนกลาง:</td>
                            <td>{!!Form::text('cost_of_central',$place->cost_of_central,['placeholder'=>""])!!}</td>
                            </tr>
                            <tr>
                                <td>รูปภาพ:</td>
                                <td><img width="200" height="150" src="images/{{$place->image}}" alt="" /></td>
                                </tr>
                            <tr>
                                <td></td>
                                <td>{!!Form::file('image')!!}</td>
                                </tr>
                            <tr>
    <td colspan="3">{!!Form::checkbox('has_air',$place->has_air)!!} มีเครื่องปรับอาการ
    {!!Form::checkbox('has_tv',$place->has_tv)!!} มีเครื่องทีวี
    {!!Form::checkbox('has_furniture',$place->has_furniture)!!} มีฟอร์นิเจอร์
    </td></tr>
    <tr>
    <td colspan="3">{!!Form::checkbox('has_water_heater',$place->has_water_heater)!!} มีเครื่องทำน้ำอุ่น
    {!!Form::checkbox('has_wash_machine',$place->has_wash_machine)!!} มีเครื่องซักผ้า
    {!!Form::checkbox('has_parking',$place->has_parking)!!} มีที่จอดรถ
    </td></tr>
    </table>

  {!!Form::submit('Edit')!!}
  {!!Form::close()!!}
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript">
var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
function initialize() { // ฟังก์ชันแสดงแผนที่
GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
// กำหนดจุดเริ่มต้นของแผนที่
var my_Latlng  = new GGM.LatLng({{$place->lat}}, {{$place->longti}});
var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
// กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
var my_DivObj=$("#map_canvas")[0];
// กำหนด Option ของแผนที่
var myOptions = {
    zoom: 13, // กำหนดขนาดการ zoom
    center: my_Latlng , // กำหนดจุดกึ่งกลาง
    mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่
};
map = new GGM.Map(my_DivObj,myOptions);// สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

var my_Marker = new GGM.Marker({ // สร้างตัว marker
    position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
    map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
    draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
    title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
});

// กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
GGM.event.addListener(my_Marker, 'dragend', function() {
    var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
    map.panTo(my_Point);  // ให้แผนที่แสดงไปที่ตัว marker
    $("#lati").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
    $("#longti").val(my_Point.lng()); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
});
// กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
GGM.event.addListener(map, 'zoom_changed', function() {
    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
});

}
$(function(){
// โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
// ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
// v=3.2&sensor=false&language=th&callback=initialize
//  v เวอร์ชัน่ 3.2
//  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
//  language ภาษา th ,en เป็นต้น
//  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
$("<script/>", {
  "type": "text/javascript",
  src: "http://maps.google.com/maps/api/js?v=3.2&sensor=false&language=th&callback=initialize"
}).appendTo("body");
});
</script>
@stop
