<?php
//姓名配对
function pair($keyword){
        $name = explode("配",$keyword); 
        $namea = $name[0]; 
        $namea = iconv("UTF-8","gb2312",$namea);
        $nameb = $name[1];
        $nameb = iconv("UTF-8","gb2312",$nameb);
        $peidui="姓名缘分配对";
        $peidui = iconv("UTF-8","gb2312",$peidui);
        $data = "namea=".$namea."&nameb=".$nameb."&peidui=".$peidui; 
        $url = "http://www.sheup.com/xingmingyuanfen.php";
        $headers = array(
            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36",
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
            "Accept-Language: zh-CN,zh;q=0.8,en;q=0.6","Referer: http://www.sheup.com/xingmingyuanfen.php");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($curl);
        curl_close($curl);
        $result = iconv("GBK", "UTF-8", $output);
        class get_c_str {  
            var $str;  
            var $start_str;  
            var $end_str;  
            var $start_pos;  
            var $end_pos;  
            var $c_str_l;  
            var $contents;  
            function get_str($str,$start_str,$end_str){  
               $this->str = $str;  
               $this->start_str = $start_str;  
               $this->end_str = $end_str;  
               $this->start_pos = strpos($this->str,$this->start_str)+strlen($this->start_str);  
                 $this->end_pos = strpos($this->str,$this->end_str);  
               $this->c_str_l = $this->end_pos - $this->start_pos;  
               $this->contents = substr($this->str,$this->start_pos,$this->c_str_l);  
               return $this->contents;  
            }  
        }
        $get_c_str = new get_c_str;  
        $paire=$get_c_str -> get_str($result,'姓名配对测试缘分','※本测算结果仅供娱乐');
        $paire=strip_tags($paire);
        $paire=trim($paire);
        return $paire;
}