<?php
//真心话大冒险
function games($words,$username){  

	$domain = 'lock' ;
	if($words==''){
		$text = "回复“真”随机选择真心话，回复“冒”随机选择大冒险\n回复【退出】即可退出真心话大冒险游戏";
	}elseif ($words=='退出') {
		$lock = 'unlock';
		$mysql = new SaeMysql();
    $sql="UPDATE `wx_users` SET  `lock` =  '$lock' WHERE  `openid` =  '$username'";
    $mysql->runSql($sql);
    if ($mysql->errno() != 0)
    {
      die("Error:" . $mysql->errmsg());
    }
    $mysql->closeDb();
		$text='已退出游戏【真心话大冒险】即可重新开启';
	}else{
        switch($words) {
           case "真":
                $file_handle = fopen("true.txt", "r");
                $lines = array();
                while (!feof($file_handle)) {
                   $line = fgets($file_handle);
                   array_push($lines, $line);
                }
                fclose($file_handle);
                $random = rand(0, count($lines) - 1);
                $text=$lines[$random];
               break;
           case "冒":
               $file_handle = fopen( "big.txt", "r");
                $lines = array();
                while (!feof($file_handle)) {
                   $line = fgets($file_handle);
                   array_push($lines, $line);
                }
                fclose($file_handle);
                $random = rand(0, count($lines) - 1);
                $text=$lines[$random];
               break;
           default:
            $text="好吧，我看不懂啦。\n回复“真”随机选择真心话，回复“冒”随机选择大冒险";
       }
		
	}
	return $text;
}