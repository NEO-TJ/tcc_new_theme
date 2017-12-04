var map; // Global declaration of the map
var lat_longs_map = new Array();
var markers_map = new Array();
var iw_map;
var markerCluster;

iw_map = new google.maps.InfoWindow();
    
        function initialize_map() {
    
    var myLatlng = new google.maps.LatLng(12.5,100);
    var myOptions = {
        zoom: 8,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP}
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
var myLatlng = new google.maps.LatLng(13.286,100.911);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "Project 1"      
};
marker_0 = createMarker_map(markerOptions);

marker_0.set("content", "Project 1<p>250 กิโลกรัม");

google.maps.event.addListener(marker_0, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.6637,101.038);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "Project 2"      
};
marker_1 = createMarker_map(markerOptions);

marker_1.set("content", "Project 2<p>600 กิโลกรัม");

google.maps.event.addListener(marker_1, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.5,99.98);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "Project 3"      
};
marker_2 = createMarker_map(markerOptions);

marker_2.set("content", "Project 3<p>80 กิโลกรัม");

google.maps.event.addListener(marker_2, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(9.7405,98.3686);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "เกาะพยาม จ.ระนอง"       
};
marker_3 = createMarker_map(markerOptions);

marker_3.set("content", "เกาะพยาม จ.ระนอง<p>103 กิโลกรัม");

google.maps.event.addListener(marker_3, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(13.5886,100.289);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมชนตำบลบางขุนเทียน"       
};
marker_4 = createMarker_map(markerOptions);

marker_4.set("content", "ชุมชนตำบลบางขุนเทียน<p>250 กิโลกรัม");

google.maps.event.addListener(marker_4, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.8868,100.881);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมชนบ้านบางละมุง"      
};
marker_5 = createMarker_map(markerOptions);

marker_5.set("content", "ชุมชนบ้านบางละมุง<p>399 กิโลกรัม");

google.maps.event.addListener(marker_5, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(13.4013,100.008);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมชนตำบลบ้านบางแก้ว"       
};
marker_6 = createMarker_map(markerOptions);

marker_6.set("content", "ชุมชนตำบลบ้านบางแก้ว<p>205 กิโลกรัม");

google.maps.event.addListener(marker_6, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.62603,100.155);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "หาดแสนสุขลำปำ ต.ลำปำ.อ.เมือง"       
};
marker_7 = createMarker_map(markerOptions);

marker_7.set("content", "หาดแสนสุขลำปำ ต.ลำปำ.อ.เมือง<p>42 กิโลกรัม");

google.maps.event.addListener(marker_7, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(13.4954,100.993);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมชนชายทะเลวัดคงคาราม"     
};
marker_8 = createMarker_map(markerOptions);

marker_8.set("content", "ชุมชนชายทะเลวัดคงคาราม<p>382 กิโลกรัม");

google.maps.event.addListener(marker_8, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.44177,100.018);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "คลองปากนคร ต.ปากนคร อ.เมือง"        
};
marker_9 = createMarker_map(markerOptions);

marker_9.set("content", "คลองปากนคร ต.ปากนคร อ.เมือง<p>527 กิโลกรัม");

google.maps.event.addListener(marker_9, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(13.4508,100.148);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมชนชายทะเลกาหลง"      
};
marker_10 = createMarker_map(markerOptions);

marker_10.set("content", "ชุมชนชายทะเลกาหลง<p>387 กิโลกรัม");

google.maps.event.addListener(marker_10, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.16529,100.524);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ม.1 เกาะยอ อ.เมือง"     
};
marker_11 = createMarker_map(markerOptions);

marker_11.set("content", "ม.1 เกาะยอ อ.เมือง<p>142 กิโลกรัม");

google.maps.event.addListener(marker_11, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(10.4279,99.257);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "เกาะง่ามน้อย-ง่ามใหญ่ อำเภอเมือง จังหวัดชุมพร"      
};
marker_12 = createMarker_map(markerOptions);

marker_12.set("content", "เกาะง่ามน้อย-ง่ามใหญ่ อำเภอเมือง จังหวัดชุมพร<p>892 กิโลกรัม");

google.maps.event.addListener(marker_12, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(13.5077,100.706);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมชนชายทะเลบ้านคลองเสาธง"      
};
marker_13 = createMarker_map(markerOptions);

marker_13.set("content", "ชุมชนชายทะเลบ้านคลองเสาธง<p>341 กิโลกรัม");

google.maps.event.addListener(marker_13, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.53683,101.744);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "หาดบ้านทอน ต.โคกเคียน อ.เมือง"      
};
marker_14 = createMarker_map(markerOptions);

marker_14.set("content", "หาดบ้านทอน ต.โคกเคียน อ.เมือง<p>257 กิโลกรัม");

google.maps.event.addListener(marker_14, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.81932,98.2915);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "อ่าวกะตะ ต.กะรน จ.ภูเก็ต"       
};
marker_15 = createMarker_map(markerOptions);

marker_15.set("content", "อ่าวกะตะ ต.กะรน จ.ภูเก็ต<p>133 กิโลกรัม");

google.maps.event.addListener(marker_15, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.84409,98.2745);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "อ่าวกะรน ภูเก็ต"        
};
marker_16 = createMarker_map(markerOptions);

marker_16.set("content", "อ่าวกะรน ภูเก็ต<p>381 กิโลกรัม");

google.maps.event.addListener(marker_16, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(13.0055,100.033);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "หาดเจ้าสำราญ"       
};
marker_17 = createMarker_map(markerOptions);

marker_17.set("content", "หาดเจ้าสำราญ<p>172 กิโลกรัม");

google.maps.event.addListener(marker_17, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(11.0403,99.4487);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "หมู่เกาะทะลุ บางสะพานน้อย ประจวบคีรีขันธ์"      
};
marker_18 = createMarker_map(markerOptions);

marker_18.set("content", "หมู่เกาะทะลุ บางสะพานน้อย ประจวบคีรีขันธ์<p>190 กิโลกรัม");

google.maps.event.addListener(marker_18, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.71388,101.603);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "หาดวาสุกรี ต.ตะลุบัน อ.สายบุรี"     
};
marker_19 = createMarker_map(markerOptions);

marker_19.set("content", "หาดวาสุกรี ต.ตะลุบัน อ.สายบุรี<p>2150 กิโลกรัม");

google.maps.event.addListener(marker_19, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(11.0484,99.4487);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชายหาดเกาะทะลุ บางสะพานน้อย"        
};
marker_20 = createMarker_map(markerOptions);

marker_20.set("content", "ชายหาดเกาะทะลุ บางสะพานน้อย<p>130 กิโลกรัม");

google.maps.event.addListener(marker_20, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(14,110);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "Project 4"      
};
marker_21 = createMarker_map(markerOptions);

marker_21.set("content", "Project 4<p>72 กิโลกรัม");

google.maps.event.addListener(marker_21, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.38406,98.4719);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "กระบี่ ปี 2012  อันดามัน"       
};
marker_22 = createMarker_map(markerOptions);

marker_22.set("content", "กระบี่ ปี 2012  อันดามัน<p>135 กิโลกรัม");

google.maps.event.addListener(marker_22, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.38456,98.4719);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "กระบี่ ปี 2014  อันดามัน"       
};
marker_23 = createMarker_map(markerOptions);

marker_23.set("content", "กระบี่ ปี 2014  อันดามัน<p>1293.5 กิโลกรัม");

google.maps.event.addListener(marker_23, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.38406,98.4719);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "กระบี่ ปี 2013  อันดามัน"       
};
marker_24 = createMarker_map(markerOptions);

marker_24.set("content", "กระบี่ ปี 2013  อันดามัน<p>556.6 กิโลกรัม");

google.maps.event.addListener(marker_24, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.22463,99.4399);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตรัง ปี 2009 อันดามัน"      
};
marker_25 = createMarker_map(markerOptions);

marker_25.set("content", "ตรัง ปี 2009 อันดามัน<p>0 กิโลกรัม");

google.maps.event.addListener(marker_25, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.22463,99.4399);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตรัง ปี 2010  อันดามัน"     
};
marker_26 = createMarker_map(markerOptions);

marker_26.set("content", "ตรัง ปี 2010  อันดามัน<p>56 กิโลกรัม");

google.maps.event.addListener(marker_26, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.22463,99.4399);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตรัง ปี 2011  อันดามัน"     
};
marker_27 = createMarker_map(markerOptions);

marker_27.set("content", "ตรัง ปี 2011  อันดามัน<p>103 กิโลกรัม");

google.maps.event.addListener(marker_27, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.22463,99.4399);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตรัง ปี 2013 อันดามัน"      
};
marker_28 = createMarker_map(markerOptions);

marker_28.set("content", "ตรัง ปี 2013 อันดามัน<p>91.5 กิโลกรัม");

google.maps.event.addListener(marker_28, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(7.22463,99.4399);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตรัง ปี 2014  อันดามัน"     
};
marker_29 = createMarker_map(markerOptions);

marker_29.set("content", "ตรัง ปี 2014  อันดามัน<p>2374 กิโลกรัม");

google.maps.event.addListener(marker_29, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.7902,99.9481);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "เพชรบุรี ปี 2012  อ่าวไทยตอนบน"     
};
marker_30 = createMarker_map(markerOptions);

marker_30.set("content", "เพชรบุรี ปี 2012  อ่าวไทยตอนบน<p>41 กิโลกรัม");

google.maps.event.addListener(marker_30, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.7902,99.9481);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "เพชรบุรี ปี 2014  อ่าวไทยตอนบน"     
};
marker_31 = createMarker_map(markerOptions);

marker_31.set("content", "เพชรบุรี ปี 2014  อ่าวไทยตอนบน<p>1342.01 กิโลกรัม");

google.maps.event.addListener(marker_31, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.7902,99.9481);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "เพชรบุรี ปี 2015  อ่าวไทยตอนบน"     
};
marker_32 = createMarker_map(markerOptions);

marker_32.set("content", "เพชรบุรี ปี 2015  อ่าวไทยตอนบน<p>408.6 กิโลกรัม");

google.maps.event.addListener(marker_32, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9289,100.595);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชลบุรี ปี 2010  อ่าวไทยตอนบน"       
};
marker_33 = createMarker_map(markerOptions);

marker_33.set("content", "ชลบุรี ปี 2010  อ่าวไทยตอนบน<p>1475.5 กิโลกรัม");

google.maps.event.addListener(marker_33, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9289,100.595);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชลบุรี ปี 2011  อ่าวไทยตอนบน"       
};
marker_34 = createMarker_map(markerOptions);

marker_34.set("content", "ชลบุรี ปี 2011  อ่าวไทยตอนบน<p>1937 กิโลกรัม");

google.maps.event.addListener(marker_34, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9289,100.595);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชลบุรี ปี 2012  อ่าวไทยตอนบน"       
};
marker_35 = createMarker_map(markerOptions);

marker_35.set("content", "ชลบุรี ปี 2012  อ่าวไทยตอนบน<p>1288 กิโลกรัม");

google.maps.event.addListener(marker_35, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9289,100.595);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชลบุรี ปี 2013  อ่าวไทยตอนบน"       
};
marker_36 = createMarker_map(markerOptions);

marker_36.set("content", "ชลบุรี ปี 2013  อ่าวไทยตอนบน<p>4345.2 กิโลกรัม");

google.maps.event.addListener(marker_36, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9289,100.595);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชลบุรี ปี 2014  อ่าวไทยตอนบน"       
};
marker_37 = createMarker_map(markerOptions);

marker_37.set("content", "ชลบุรี ปี 2014  อ่าวไทยตอนบน<p>2275.1 กิโลกรัม");

google.maps.event.addListener(marker_37, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9289,100.595);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชลบุรี ปี 2015  อ่าวไทยตอนบน"       
};
marker_38 = createMarker_map(markerOptions);

marker_38.set("content", "ชลบุรี ปี 2015  อ่าวไทยตอนบน<p>257.7 กิโลกรัม");

google.maps.event.addListener(marker_38, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(10.7722,99.0916);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมพร ปี 2010  อ่าวไทยตอนกลาง"      
};
marker_39 = createMarker_map(markerOptions);

marker_39.set("content", "ชุมพร ปี 2010  อ่าวไทยตอนกลาง<p>79 กิโลกรัม");

google.maps.event.addListener(marker_39, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.79922,100.786);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "สงขลา ปี2009 อ่าวไทยตอนล่าง"        
};
marker_40 = createMarker_map(markerOptions);

marker_40.set("content", "สงขลา ปี2009 อ่าวไทยตอนล่าง<p>79.3 กิโลกรัม");

google.maps.event.addListener(marker_40, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(10.7722,99.0916);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ชุมพร ปี 2015 อ่าวไทยตอนกลาง"       
};
marker_41 = createMarker_map(markerOptions);

marker_41.set("content", "ชุมพร ปี 2015 อ่าวไทยตอนกลาง<p>704 กิโลกรัม");

google.maps.event.addListener(marker_41, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.98075,100.12);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "สงขลา ปี 2014 อ่าวไทยตอนล่าง"       
};
marker_42 = createMarker_map(markerOptions);

marker_42.set("content", "สงขลา ปี 2014 อ่าวไทยตอนล่าง<p>2772 กิโลกรัม");

google.maps.event.addListener(marker_42, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.42973,101.673);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "นราธิวาส ปี2014 อ่าวไทยตอนล่าง"     
};
marker_43 = createMarker_map(markerOptions);

marker_43.set("content", "นราธิวาส ปี2014 อ่าวไทยตอนล่าง<p>240 กิโลกรัม");

google.maps.event.addListener(marker_43, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.8479,101.189);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ปัตตานี ปี2014 อ่าวไทยตอนล่าง"      
};
marker_44 = createMarker_map(markerOptions);

marker_44.set("content", "ปัตตานี ปี2014 อ่าวไทยตอนล่าง<p>1070 กิโลกรัม");

google.maps.event.addListener(marker_44, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.2191,102.315);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตราด ปี2009 อ่าวไทยฝั่งตะวันออก"        
};
marker_45 = createMarker_map(markerOptions);

marker_45.set("content", "ตราด ปี2009 อ่าวไทยฝั่งตะวันออก<p>0 กิโลกรัม");

google.maps.event.addListener(marker_45, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.28945,98.1106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "พังงา ปี 2010  อันดามัน"        
};
marker_46 = createMarker_map(markerOptions);

marker_46.set("content", "พังงา ปี 2010  อันดามัน<p>171.4 กิโลกรัม");

google.maps.event.addListener(marker_46, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.2342,102.287);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ตราด ปี2015 อ่าวไทยฝั่งตะวันออก"        
};
marker_47 = createMarker_map(markerOptions);

marker_47.set("content", "ตราด ปี2015 อ่าวไทยฝั่งตะวันออก<p>325 กิโลกรัม");

google.maps.event.addListener(marker_47, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.6877,101.169);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระยอง ปี2009 อ่าวไทยฝั่งตะวันออก"       
};
marker_48 = createMarker_map(markerOptions);

marker_48.set("content", "ระยอง ปี2009 อ่าวไทยฝั่งตะวันออก<p>5100 กิโลกรัม");

google.maps.event.addListener(marker_48, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.28945,98.1106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "พังงา ปี 2011 อันดามัน"     
};
marker_49 = createMarker_map(markerOptions);

marker_49.set("content", "พังงา ปี 2011 อันดามัน<p>68.36 กิโลกรัม");

google.maps.event.addListener(marker_49, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.28945,98.1106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "พังงา ปี 2012 อันดามัน"     
};
marker_50 = createMarker_map(markerOptions);

marker_50.set("content", "พังงา ปี 2012 อันดามัน<p>510.8 กิโลกรัม");

google.maps.event.addListener(marker_50, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.7778,101.387);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระยอง ปี2010 อ่าวไทยฝั่งตะวันออก"       
};
marker_51 = createMarker_map(markerOptions);

marker_51.set("content", "ระยอง ปี2010 อ่าวไทยฝั่งตะวันออก<p>337.5 กิโลกรัม");

google.maps.event.addListener(marker_51, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9764,101.11);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระยอง ปี2014 อ่าวไทยฝั่งตะวันออก"       
};
marker_52 = createMarker_map(markerOptions);

marker_52.set("content", "ระยอง ปี2014 อ่าวไทยฝั่งตะวันออก<p>18007.7 กิโลกรัม");

google.maps.event.addListener(marker_52, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.738,100.976);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระยอง ปี2011 อ่าวไทยฝั่งตะวันออก"       
};
marker_53 = createMarker_map(markerOptions);

marker_53.set("content", "ระยอง ปี2011 อ่าวไทยฝั่งตะวันออก<p>160 กิโลกรัม");

google.maps.event.addListener(marker_53, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.28945,98.1106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "พังงา ปี 2013  อันดามัน"        
};
marker_54 = createMarker_map(markerOptions);

marker_54.set("content", "พังงา ปี 2013  อันดามัน<p>206.3 กิโลกรัม");

google.maps.event.addListener(marker_54, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.738,100.976);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระยอง ปี2013 อ่าวไทยฝั่งตะวันออก"       
};
marker_55 = createMarker_map(markerOptions);

marker_55.set("content", "ระยอง ปี2013 อ่าวไทยฝั่งตะวันออก<p>636 กิโลกรัม");

google.maps.event.addListener(marker_55, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.28945,98.1106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "พังงา ปี 2014  อันดามัน"        
};
marker_56 = createMarker_map(markerOptions);

marker_56.set("content", "พังงา ปี 2014  อันดามัน<p>998.4 กิโลกรัม");

google.maps.event.addListener(marker_56, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.28945,98.1106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "พังงา ปี 2015  อันดามัน"        
};
marker_57 = createMarker_map(markerOptions);

marker_57.set("content", "พังงา ปี 2015  อันดามัน<p>362.9 กิโลกรัม");

google.maps.event.addListener(marker_57, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.9703,101.358);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระยอง ปี2015 อ่าวไทยฝั่งตะวันออก"       
};
marker_58 = createMarker_map(markerOptions);

marker_58.set("content", "ระยอง ปี2015 อ่าวไทยฝั่งตะวันออก<p>2018 กิโลกรัม");

google.maps.event.addListener(marker_58, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.07049,98.085);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ภูเก็ต ปี 2009  อันดามัน"       
};
marker_59 = createMarker_map(markerOptions);

marker_59.set("content", "ภูเก็ต ปี 2009  อันดามัน<p>270 กิโลกรัม");

google.maps.event.addListener(marker_59, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.07049,98.085);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ภูเก็ต ปี 2010  อันดามัน"       
};
marker_60 = createMarker_map(markerOptions);

marker_60.set("content", "ภูเก็ต ปี 2010  อันดามัน<p>1019.7 กิโลกรัม");

google.maps.event.addListener(marker_60, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.07049,98.085);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ภูเก็ต ปี 2012  อันดามัน"       
};
marker_61 = createMarker_map(markerOptions);

marker_61.set("content", "ภูเก็ต ปี 2012  อันดามัน<p>7007.3 กิโลกรัม");

google.maps.event.addListener(marker_61, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(9.43814,98.1705);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระนอง ปี 2011  อันดามัน"        
};
marker_62 = createMarker_map(markerOptions);

marker_62.set("content", "ระนอง ปี 2011  อันดามัน<p>453.8 กิโลกรัม");

google.maps.event.addListener(marker_62, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(9.43814,98.1705);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระนอง ปี 2011  อันดามัน"        
};
marker_63 = createMarker_map(markerOptions);

marker_63.set("content", "ระนอง ปี 2011  อันดามัน<p>453.8 กิโลกรัม");

google.maps.event.addListener(marker_63, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.60885,98.5471);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "สตูล ปี 2014  อันดามัน"     
};
marker_64 = createMarker_map(markerOptions);

marker_64.set("content", "สตูล ปี 2014  อันดามัน<p>884 กิโลกรัม");

google.maps.event.addListener(marker_64, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.60885,98.5471);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "สตูล ปี 2013  อันดามัน"     
};
marker_65 = createMarker_map(markerOptions);

marker_65.set("content", "สตูล ปี 2013  อันดามัน<p>884 กิโลกรัม");

google.maps.event.addListener(marker_65, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(6.60885,98.5471);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "สตูล ปี 2013  อันดามัน"     
};
marker_66 = createMarker_map(markerOptions);

marker_66.set("content", "สตูล ปี 2013  อันดามัน<p>1194 กิโลกรัม");

google.maps.event.addListener(marker_66, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.42513,99.8069);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "นครศรีธรรมราช ปี2012 อ่าวไทยตอนกลาง"        
};
marker_67 = createMarker_map(markerOptions);

marker_67.set("content", "นครศรีธรรมราช ปี2012 อ่าวไทยตอนกลาง<p>2 กิโลกรัม");

google.maps.event.addListener(marker_67, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.96473,99.6441);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "นครศรีธรรมราช ปี2014 อ่าวไทยตอนกลาง"        
};
marker_68 = createMarker_map(markerOptions);

marker_68.set("content", "นครศรีธรรมราช ปี2014 อ่าวไทยตอนกลาง<p>1245 กิโลกรัม");

google.maps.event.addListener(marker_68, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(12.4969,99.4129);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ประจวบคีรีขันธ์ ปี2010 อ่าวไทยตอนกลาง"      
};
marker_69 = createMarker_map(markerOptions);

marker_69.set("content", "ประจวบคีรีขันธ์ ปี2010 อ่าวไทยตอนกลาง<p>120 กิโลกรัม");

google.maps.event.addListener(marker_69, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(11.8587,99.4645);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ประจวบคีรีขันธ์ ปี2011 อ่าวไทยตอนกลาง"      
};
marker_70 = createMarker_map(markerOptions);

marker_70.set("content", "ประจวบคีรีขันธ์ ปี2011 อ่าวไทยตอนกลาง<p>171.5 กิโลกรัม");

google.maps.event.addListener(marker_70, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(9.0954,99.1672);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "สุราษฎร์ธานี ปี2010 อ่าวไทยตอนกลาง"     
};
marker_71 = createMarker_map(markerOptions);

marker_71.set("content", "สุราษฎร์ธานี ปี2010 อ่าวไทยตอนกลาง<p>83 กิโลกรัม");

google.maps.event.addListener(marker_71, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.07049,98.085);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ภูเก็ต ปี 2013  อันดามัน"       
};
marker_72 = createMarker_map(markerOptions);

marker_72.set("content", "ภูเก็ต ปี 2013  อันดามัน<p>5393.5 กิโลกรัม");

google.maps.event.addListener(marker_72, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.07049,98.085);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ภูเก็ต ปี 2014  อันดามัน"       
};
marker_73 = createMarker_map(markerOptions);

marker_73.set("content", "ภูเก็ต ปี 2014  อันดามัน<p>979.7 กิโลกรัม");

google.maps.event.addListener(marker_73, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(9.90076,98.2819);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระนอง ปี2013 อันดามัน"      
};
marker_74 = createMarker_map(markerOptions);

marker_74.set("content", "ระนอง ปี2013 อันดามัน<p>399.3 กิโลกรัม");

google.maps.event.addListener(marker_74, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(8.07049,98.085);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ภูเก็ต ปี 2015  อันดามัน"       
};
marker_75 = createMarker_map(markerOptions);

marker_75.set("content", "ภูเก็ต ปี 2015  อันดามัน<p>1144 กิโลกรัม");

google.maps.event.addListener(marker_75, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(9.43822,98.3106);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระนอง ปี2014 อันดามัน"      
};
marker_76 = createMarker_map(markerOptions);

marker_76.set("content", "ระนอง ปี2014 อันดามัน<p>549.5 กิโลกรัม");

google.maps.event.addListener(marker_76, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var myLatlng = new google.maps.LatLng(10.3855,98.6397);
    
var markerOptions = {
    map: map,
    position: myLatlng,
    title: "ระนอง ปี2015 อันดามัน"      
};
marker_77 = createMarker_map(markerOptions);

marker_77.set("content", "ระนอง ปี2015 อันดามัน<p>468.3 กิโลกรัม");

google.maps.event.addListener(marker_77, "click", function(event) {
    iw_map.setContent(this.get("content"));
    iw_map.open(map, this);

});

var clusterOptions = {
    gridSize: 60,
    minimumClusterSize: 2
};
markerCluster = new MarkerClusterer(map, markers_map, clusterOptions);


}


function createMarker_map(markerOptions) {
    var marker = new google.maps.Marker(markerOptions);
    markers_map.push(marker);
    lat_longs_map.push(marker.getPosition());
    return marker;
}

    google.maps.event.addDomListener(window, "load", initialize_map);
