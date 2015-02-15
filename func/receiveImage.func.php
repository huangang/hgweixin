<?php
//人脸识别
function receiveImage($imgurl){
	    require_once('faceplusplus.php');
        $content = getImageInfo($imgurl);
        return $content;
 }