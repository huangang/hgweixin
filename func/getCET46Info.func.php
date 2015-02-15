<?php
//46级查询
function getCET46Info($keyword){ 
    if (preg_match_all("/^([\x{4e00}-\x{9fa5}]{2,4})(\d{15})/u", $keyword, $info)){ 
    	$name = substr($info[1][0],0,6); 
    	$name_gb2312 = urlencode(mb_convert_encoding($name, 'gb2312', 'utf-8')); 
    	$number = $info[2][0]; 
    	$data = "id=".$number."&name=".$name_gb2312; 
    	$url = "http://cet.99sushe.com/find";
    	$headers = array(
    		"User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
    		"Accept: text/html,application/xhtml+xml,application/xml; q=0.9,image/webp,*/*;q=0.8",
    		"Accept-Language: en-us,en;q=0.5","Referer: http://cet.99sushe.com/");
    	$curl = curl_init();
    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    	curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($curl);
        curl_close($curl);
        $result = iconv("GBK", "UTF-8//IGNORE", $output);
        $score = explode(",",$result);
        $content =  "考生姓名：".$score[6]."\n"."学校：".$score[5]."\n"."准考证号：".$number."\n"."您的成绩总分：".$score[4]."\n"."听力：".$score[1]."\n"."阅读：".$score[2]."\n".
        "写作和翻译：".$score[3]."\n\n".(($score[4] >= 425)?"恭喜":"加油");
        return $content;    
    }else{
    	return "格式错误";
    }
}