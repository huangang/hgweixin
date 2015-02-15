<?php
//天气预报
function weather($location){
	$ak = "FFff772938d158843021666960b2a4ed";
	$api_url = "http://api.map.baidu.com/telematics/v3/weather?output=json&ak=".$ak."&location=".$location;
	$result = file_get_contents ( $api_url );
	$result = json_decode ( $result, true );
	if($result[status] == "success"){
		$text = $result['results'][0]['currentCity'].$result['date']."\n";
		$text = $text.'pm25:'.$result['results'][0]['pm25']."\n";
		$text = $text.$result['results'][0]['index'][0]['tipt'].':'.$result['results'][0]['index'][0]['zs'].$result['results'][0]['index'][0]['des']."\n";
		$text = $text.$result['results'][0]['index'][1]['tipt'].':'.$result['results'][0]['index'][1]['zs'].$result['results'][0]['index'][1]['des']."\n";
		$text = $text.$result['results'][0]['index'][2]['tipt'].':'.$result['results'][0]['index'][2]['zs'].$result['results'][0]['index'][2]['des']."\n";
		$text = $text.$result['results'][0]['index'][3]['tipt'].':'.$result['results'][0]['index'][3]['zs'].$result['results'][0]['index'][3]['des']."\n";
		$text = $text.$result['results'][0]['index'][4]['tipt'].':'.$result['results'][0]['index'][4]['zs'].$result['results'][0]['index'][4]['des']."\n";
		$text = $text.$result['results'][0]['weather_data'][0]['date'].':'.$result['results'][0]['weather_data'][0]['weather'].','.$result['results'][0]['weather_data'][0]['wind'].','.$result['results'][0]['weather_data'][0]['temperature']."\n";
	    $text = $text.$result['results'][0]['weather_data'][1]['date'].':'.$result['results'][0]['weather_data'][1]['weather'].','.$result['results'][0]['weather_data'][1]['wind'].','.$result['results'][0]['weather_data'][1]['temperature']."\n";
	    $text = $text.$result['results'][0]['weather_data'][2]['date'].':'.$result['results'][0]['weather_data'][2]['weather'].','.$result['results'][0]['weather_data'][2]['wind'].','.$result['results'][0]['weather_data'][2]['temperature']."\n";
	    $text = $text.$result['results'][0]['weather_data'][3]['date'].':'.$result['results'][0]['weather_data'][3]['weather'].','.$result['results'][0]['weather_data'][3]['wind'].','.$result['results'][0]['weather_data'][3]['temperature']."\n";
	    return $text;
	}

}