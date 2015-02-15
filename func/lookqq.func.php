<?php
//QQ头像和昵称
function lookqq($uin){
	$lookqqurl="http://r.qzone.qq.com/cgi-bin/user/cgi_personal_card?uin=".$uin;
	$result = file_get_contents ( $lookqqurl );
	$result = substr($result, 12);
	$result = substr($result, 0,strlen($result)-4);
	$qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
	$result = str_replace($qian,$hou,$result);
	$arr = explode(',',$result);
    $arr2 = array();
    foreach($arr as $k=>$v){
        $arr = explode('":',$v);
        $arr[0] = str_replace("\"","",$arr[0]);
        $arr[1] = str_replace("\"","",$arr[1]);
        $arr2[$arr[0]] = $arr[1];
    }
	$qqcontent[0] = array (
		'Title' => $rarr2['uin'],
		'Description' => $arr2['nickname'],
		'PicUrl' => $arr2['avatarUrl'],
		'Url' => $arr2['avatarUrl']
		); 
	return $qqcontent;
}