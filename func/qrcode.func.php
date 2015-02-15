<?php
//二维码
function qrcode($content){
        $img = "http://qr.liantu.com/api.php?text=".$content;
        $articles [0] = array (
						'Title' => $content,
						'Description' => $content,
						'PicUrl' => $img,
						'Url' => $img 
				);
	    return $articles;
}