<?php
@define("WE_ROOT",  dirname(__FILE__) . "/");            

require_once(WE_ROOT . "wechat.class.php");
//require_once(WE_ROOT . "saemysql.class.php");
require_once(WE_ROOT . "function.php");


$options = array(
    'token'=>'huangang', //填写你设定的key
);
$weObj = new Wechat($options);

$weObj->valid();

$type = $weObj->getRev()->getRevType();
$username = $weObj->getRev()->getRevFrom();
$content = $weObj->getRev()->getRevContent();
$content = safe_replace($content);

$mysql = new SaeMysql();
$sql ="select * from wx_users where openid = '$username' ";
$data=$mysql->getLine($sql);
if($data){
	$lock = $data['lock'];
}else{
	$sql ="insert into wx_users(openid) values('$username')";
	$mysql->runSql($sql);
	if ($mysql->errno() != 0){
		die("Error:" . $mysql->errmsg());
	}
	$lock="unlock";
}
$mysql->closeDb();

function safe_replace($string) {
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','&lt;',$string);
    $string = str_replace('>','&gt;',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
    $string = str_replace(' ','',$string);
    return $string;
}


switch($type) {
	/*关注事件回复*/
	case Wechat::MSGTYPE_EVENT:
    $weObj->text("hello, I'm wechat\n平台现有功能:\n智能聊天,天气查询,QQ查询,46级成绩查询,翻译,姓名测试,夫妻相,成语接龙,小逗比聊天模式,lol信息查询,真心话大冒险游戏,二维码,谁是卧底游戏".
                 '<a href="'."http://huangangweixin.sinaapp.com/".'">详细了解</a>')->reply();
			exit;
			break;
	/*文本事件回复*/
	case Wechat::MSGTYPE_TEXT:
    if(substr($content, 0, 12) == "成语接龙"){
			$lock = "idioms";
			upuserlock($lock,$username);
			$content = substr($content, 12);
	}
    if(substr($content, 0, 9) == "小逗比"){
			$lock = "xiaodoubi";
			upuserlock($lock,$username);
			$content = substr($content, 9);
	}
    if(substr($content, 0, 18) == "真心话大冒险" || $content == "真心话" || $content == "大冒险"){
			$lock = "truth_or_brave";
			upuserlock($lock,$username);
			$content = substr($content, 18);
	}if(substr($content, 0, 12) == "谁是卧底"){
			$lock = "under_cover";
			upuserlock($lock,$username);
			$content = substr($content, 12);
	}if(substr($content, 0, 9) == "查成绩"){
			$lock = "search_results";
			upuserlock($lock,$username);
			$content = substr($content, 9);
	}
	if($lock == "idioms"){
		$reply=idioms($content,$username);
		$weObj->text($reply)->reply();
	}
    elseif ($lock == "xiaodoubi") {
		$reply=xiaodoubi($content,$username);
		$weObj->text($reply)->reply();
	}
    elseif ($lock == "truth_or_brave") {
		$reply=games($content,$username);
		$weObj->text($reply)->reply();
	}elseif ($lock == "under_cover") {
		$reply=UnderCover($content,$username);
		$weObj->text($reply)->reply();
	}elseif ($lock == "search_results") {
		$reply=searchresults($content,$username);
		$weObj->text($reply)->reply();
	}
    else{
    	   if(strcasecmp($content) == "help"||$content=="帮助"){
			    $weObj->text("hello, I'm wechat\n平台现有功能:\n智能聊天,天气查询,QQ查询,46级成绩查询,翻译,姓名测试,夫妻相,成语接龙,小逗比聊天模式,lol信息查询,真心话大冒险游戏,二维码,谁是卧底游戏".
                '<a href="'."http://huangangweixin.sinaapp.com/".'">详细了解</a>')->reply();
			}elseif(substr($content, 0, 2)=="QQ"||substr($content, 0, 2)=="qq"){
				$content=substr($content, 2);
				$content=str_replace(" ","",$content);
			    $reply=lookqq($content);
			    $weObj->news($reply)->reply();
			    //$weObj->text($reply)->reply();
			} else if (substr($content, 0, 6)=="天气") {
				$content=substr($content, 6);
			    $reply=weather($content);
			    $weObj->text($reply)->reply();
			} else if(substr($content, 0, 4)=="4级"||substr($content, 0, 4)=="6级"){
				$content=substr($content, 4);
                $content=str_replace(" ","",$content);
				$reply=getCET46Info($content);
			    $weObj->text($reply)->reply();
			} else if(substr($content, 0, 6)=="翻译"){
				$content=substr($content, 6);
				$reply=getTranslateInfo($content);
			    $weObj->text($reply)->reply();
			}  else if(substr($content, 0, 6)=="姓名"){
				$content=substr($content, 6);
				$reply=getFortuneInfo($content);
			    $weObj->text($reply)->reply();
			} else if (substr($content, 0, 5)=="12306") {
				$content=substr($content, 5);
				$reply= get12306($content);
                if(is_array($reply)){
                    $weObj->news($reply)->reply();
                }else {
                    $weObj->text($reply)->reply();
                }
			} elseif (strcasecmp(substr($content, 0, 3),"LOL")==0) {
				$content=substr($content, 3);
				$reply=lol($content);
			    $weObj->text($reply)->reply();
			}
            elseif (substr($content, 0, 9)=="二维码") {
				$content=substr($content, 9);
				$reply=qrcode($content);
			    $weObj->news($reply)->reply();
			}elseif(strpos($content,"配")){
				$reply=pair($content);
			    $weObj->text($reply)->reply();
			}
			else{
				$reply = tuling($content);
				if(gettype($reply)==string){
					$weObj->text($reply)->reply();
				} else if(is_array($reply)) {
					$weObj->news($reply)->reply();
				}
			}
    }
            exit;
			break;
    /*地理事件回复*/
	case Wechat::MSGTYPE_LOCATION:
	        $location=$weObj->getRevGeo();
	       
	        $username = ' ';
	        $reply = gaodei($location['x'], $location['y'], $username);
	        $weObj->text($reply)->reply();
	        exit;
			break;
    /*图片事件处理*/
	case Wechat::MSGTYPE_IMAGE:
	        $image = $weObj->getRevPic();
            $imageurl = $image['picurl'];
	        $response = receiveImage($imageurl);
	        $weObj->text($response)->reply();
			break;
    /*语音识别*/
    case Wechat::MSGTYPE_VOICE:
           $reply = tuling($content);
           $reply = "您说的是:".$content."\n".$reply;
		   if(gettype($reply)==string){
				$weObj->text($reply)->reply();
			} else if(is_array($reply)) {
				$weObj->news($reply)->reply();
			}
            break;
	default:
			$weObj->text($type."\n "."hello, I'm wechat\n平台现有功能:\n智能聊天,天气查询,QQ查询,46级成绩查询,翻译,姓名测试,夫妻相,成语接龙,小逗比聊天模式,lol信息查询,真心话大冒险游戏,二维码,谁是卧底游戏".
                 '<a href="'."http://huangangweixin.sinaapp.com/".'">详细了解</a>')->reply();
}

function upuserlock($lock,$username){
	$mysql = new SaeMysql();
	$sql="UPDATE `wx_users` SET  `lock` =  '$lock' WHERE  `openid` =  '$username'";
	$mysql->runSql($sql);
	if ($mysql->errno() != 0)
	{
		die("Error:" . $mysql->errmsg());
	}
	$mysql->closeDb();
}