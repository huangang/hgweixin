<?php
//查成绩
function searchresults($key,$username){
	if($key==''){
		$text = '接下来请发送你的学号,如:2012810505';
	}elseif ($key=='退出') {
		$lock = 'unlock';
		$mysql = new SaeMysql();
		$sql="UPDATE `wx_users` SET  `lock` =  '$lock' WHERE  `openid` =  '$username'";
		$mysql->runSql($sql);
		if ($mysql->errno() != 0)
		{
			die("Error:" . $mysql->errmsg());
		}
		$mysql->closeDb();
		$text='已退出查成绩模式，再次发送【查成绩】即可开启';
	}else{
		$apiurl = "http://thumbclass.oschina.mopaas.com/queryResults/queryResults.php?stuid=".$key;
		$text = file_get_contents ( $apiurl );
	}
	return $text;
}