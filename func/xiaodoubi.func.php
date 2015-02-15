<?php
//小逗比
function xiaodoubi($chat,$username){
	if($chat==''){
		$text = '现在可以和小逗比聊天了,回复【退出】即可退出和小逗比聊天模式';
	}elseif ($chat=='退出') {
		$lock = 'unlock';
		$mysql = new SaeMysql();
		$sql="UPDATE `wx_users` SET  `lock` =  '$lock' WHERE  `openid` =  '$username'";
		$mysql->runSql($sql);
		if ($mysql->errno() != 0)
		{
			die("Error:" . $mysql->errmsg());
		}
		$mysql->closeDb();
		$text='已退出小逗比聊天模式，再次发送【小逗比】即可开启';
	}else{
		$key="29A7BA3C-0219-CDEC-8B89-0E4B2C7BEE27";
		$apiurl = "http://api.xiaodoubi.com/api.php?key=".$key."&chat=".$chat;
		$text = file_get_contents ( $apiurl );
	}
	return $text;
}