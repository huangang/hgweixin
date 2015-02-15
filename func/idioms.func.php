<?php
//成语接龙
function idioms($key,$username){
	$domain = 'lock' ;
	if($key==''){
        $text = "请输入一个成语开始接龙吧~比如：一马当先\n回复【退出】即可退出和成语接龙模式";
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
		$text='已退出成语接龙模式，再次发送【成语接龙】即可开启';
	}else{
		$reply=file_get_contents('http://i.itpk.cn/api.php?question=@cy'.$key);
		if($reply=='别来骗人家，不是随便打4个字就是成语哒！' || $reply=='成语必须为4个汉字'){
			$text=$reply.'重新输入一个成语开始接龙,输入【退出】退出成语接龙';
		}else{
			$text=$reply;
		}
	}
	return $text;
}