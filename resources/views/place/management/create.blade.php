@extends('layouts.layout1')

@section('title')
  add
@stop

@section('body')
<style type="text/css">
#map_canvas {
    width:450px;
    height:300px;
    margin:auto;
/*  margin-top:100px;*/
}
</style>

<h4>ADD Place</h4>
  <div class="jumbotron" >

    <div>
{!! Form::open(array('route'=>'management.store','files' => true)) !!}

      <!--{!!Form::open(['route'=>'management.store'])!!}-->
    <table>
      <tr>
      <td>ชื่อ:</td>
      <td>{!!Form::text('hotelName',null,['placeholder'=>""])!!}</td>
    </tr><tr>
        <td>รายละเอียด:</td>
        <td>{!!Form::textarea('descrip',null,['placeholder'=>""])!!}</td>
        </tr>
        <tr>
        <td>เบอร์โทร:</td>
        <td>{!!Form::text('Tel',null,['placeholder'=>""])!!}</td>
      </tr><tr>
        <td>อีเมลล์:</td>
        <td>{!!Form::text('email',null,['placeholder'=>""])!!}</td>
      </tr>
      <tr>
          <td>ที่อยู่:</td>
          <td>{!!Form::textarea('addr',null,['placeholder'=>""])!!}</td>
          </tr>
      <tr>
          <td>แผนที่:</td>
          <td><div style="margin-left:0%" id="map_canvas"></div> </td>
          </tr>
          <tr>
          <td>ละติจูด:</td>
          <td><input  name="lat" type="text" id="lati" value="0"/></td>
        </tr><tr>
            <td>ลองจิจูด:</td>
            <td><input  name="longti" type="text" id="longti" value="0" /></td>
            </tr><tr>
                <td>ค่าเช่ารายวัน:</td>
                <td>{!!Form::text('Daily_rental',null,['placeholder'=>""])!!}</td>
                </tr>
                <tr>
                <td>ค่าเช่ารายเดือน:</td>
                <td>{!!Form::text('Monthly_rental',null,['placeholder'=>""])!!}</td>
              </tr><tr>
                  <td>ค่ามัดจำ:</td>
                  <td>{!!Form::text('deposit',null,['placeholder'=>""])!!}</td>
                  </tr><tr>
                      <td>ค่าน้ำ:</td>
                      <td>{!!Form::text('cost_of_water',null,['placeholder'=>""])!!}</td>
                      </tr>
                      <tr>
                      <td>ค่าไฟ:</td>
                      <td>{!!Form::text('cost_of_Electric',null,['placeholder'=>""])!!}</td>
                    </tr><tr>
                        <td>ค่าอินเตอร์เน็ต:</td>
                        <td>{!!Form::text('cost_of_Internet',null,['placeholder'=>""])!!}</td>
                        </tr>
                        <tr>
                            <td>ค่าส่วนกลาง:</td>
                            <td>{!!Form::text('cost_of_central',null,['placeholder'=>""])!!}</td>
                            </tr>
                            <tr>
                                <td>รูปภาพ:</td>
                                <td>{!!Form::file('image')!!}</td>
                                </tr>
                            <tr>
<td colspan="3">{!!Form::checkbox('has_air')!!} เครื่องปรับอาการ
{!!Form::checkbox('has_tv')!!} เครื่องทีวี
{!!Form::checkbox('has_furniture')!!} ฟอร์นิเจอร์
</td></tr>
<tr>
<td colspan="3">{!!Form::checkbox('has_water_heater')!!} เครื่องทำน้ำอุ่น
{!!Form::checkbox('has_wash_machine')!!} เครื่องซักผ้า
{!!Form::checkbox('has_parking')!!} ที่จอดรถ
</td></tr>
    </table>
    {!!Form::submit('Create')!!}
    {!!Form::close()!!}
  </div>  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script type="text/javascript">
  var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
  var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
  function initialize() { // ฟังก์ชันแสดงแผนที่
  GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
  // กำหนดจุดเริ่มต้นของแผนที่
  var my_Latlng  = new GGM.LatLng(15.117019, 104.900667);
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
