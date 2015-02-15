<?php
//12306
 function get12306($key){
 	$api_url="http://12306c.sinaapp.com/?s=Index/search&key=".$key;
 	$content = file_get_contents($api_url);
    $content = json_decode ( $content, true );
    $length = count($content);
    if($length>9){
    	
        $text=$key.'人很多,查看这个'.'<a href="'.$api_url.'">'.$key.'</a>';
        return $text;

    } else{
            if ($content== null ){
                 $articles [] = array (
                                    'Title' => '别担心，没你啥事',
                                    'Description' => '^_^',
                                    'PicUrl' => '',
                                    'Url' => ''
                        );
             } else{
                 foreach ( $content as $info ) {
                 $articles [] = array (
                                    'Title' => '姓名:'.$info ['name'].',身份证号码:'.$info ['card_id'],
                                    'Description' => '姓名:'.$info ['name'].',身份证号码:'.$info ['card_id'],
                                    'PicUrl' => '',
                                    'Url' => ''
                        );
                 }   
             }
        return $articles;
    }	
 }