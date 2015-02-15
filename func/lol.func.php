<?php
//lol信息查询
function lol($question){
	$apiurl = "http://i.itpk.cn/api.php?question=@lol".$question;
	$reply = file_get_contents($apiurl);
	return $reply;
}