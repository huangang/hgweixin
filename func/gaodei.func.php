<?php
//高德地图
function gaodei($latitude,$longitude,$name){
	$place ="http://lbs.juhe.cn/api/getaddressbylngb?lngx=".$longitude."&lngy=".$latitude;
	$result = file_get_contents ( $place );
	$result = json_decode ( $result, true );
	$place_name=$result['row']['result']['formatted_address'];
	$api_url="http://mo.amap.com/?q=".$latitude.",".$longitude."&name=".$name."&dev=0";
	$text = $name.'您在'.$place_name.',纬度：'.$latitude.',经度：'.$longitude.'<a href="'.$api_url.'">查看地图</a>';
	return $text;
}