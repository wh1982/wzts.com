<?php

function hello()
{
  echo('hello world');
}
function alert($msg="",$url="")
{
  echo "<literal><script language='javascript' charset='utf-8'>alert('$msg');window.location.href='$url';</Script></literal>";
}
   
function alert_back($msg="")
{
   echo("<script language='javascript' charset='utf-8'>alert('$msg');history.back();</Script>");
}


function msubstr1($str, $start=0, $length, $charset="utf-8", $suffix=true)
{
    $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
    $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
    $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
    $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $str_lenth = count($match[0]);
    if(function_exists("mb_substr"))
{ 
        if($suffix && $str_lenth>$length) 
        return mb_substr($str, $start, $length, $charset)."...";
        else
        return mb_substr($str, $start, $length, $charset);
}
    elseif(function_exists('iconv_substr')) {
  if($suffix && $str_lenth>$length) 
       return iconv_substr($str,$start,$length,$charset)."...";
       else
       return iconv_substr($str,$start,$length,$charset); 
    }    
}

/*--------------------------------
功能:HTTP接口 发送短信
修改日期:	2009-04-08
说明:		http://http.chinasms.com.cn/tx/?uid=用户账号&pwd=MD5位32密码&mobile=号码&content=内容
状态:
	100 发送成功
	101 验证失败
	102 短信不足
	103 操作失败
	104 非法字符
	105 内容过多
	106 号码过多
	107 频率过快
	108 号码内容空
	109 账号冻结
	110 禁止频繁单条发送
	111 系统暂定发送
	112 号码不正确
	113 连接失败
	120 系统升级
--------------------------------*/
function sendSMS($mobile,$content,$time='',$mid='')
{
    $uid = '52201166';		//用户账号
    $pwd = '123123';		//密码
	$http = 'http://http.chinasms.com.cn/tx/';
	$data = array
		(
		'encode'=>'utf8',
		'uid'=>$uid,					//用户账号
		'pwd'=>strtolower(md5($pwd)),	//MD5位32密码
		'mobile'=>$mobile,				//号码
		'content'=>$content,			//内容
		'time'=>$time,		//定时发送
		'mid'=>$mid						//子扩展号
		);
	$re= postSMS($http,$data);			//POST方式提交
	if( trim($re) == '100' )
	{
		return "发送成功!";
	}
	else 
	{
		return "发送失败! 状态：".$re;
	}
}

function postSMS($url,$data='')
{
	$row = parse_url($url);
	$host = $row['host'];
	$port = $row['port'] ? $row['port']:80;
	$file = $row['path'];
	while (list($k,$v) = each($data)) 
	{
		$post .= rawurlencode($k)."=".rawurlencode($v)."&";	//转URL标准码
	}
	$post = substr( $post , 0 , -1 );
	$len = strlen($post);
	$fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
	if (!$fp) {
		return "$errstr ($errno)\n";
	} else {
		$receive = '';
		$out = "POST $file HTTP/1.1\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Content-type: application/x-www-form-urlencoded\r\n";
		$out .= "Connection: Close\r\n";
		$out .= "Content-Length: $len\r\n\r\n";
		$out .= $post;		
		fwrite($fp, $out);
		while (!feof($fp)) {
			$receive .= fgets($fp, 128);
		}
		fclose($fp);
		$receive = explode("\r\n\r\n",$receive);
		unset($receive[0]);
		return implode("",$receive);
	}
}


 //author:zhxia 获取指定日期所在星期的开始时间与结束时间
 function getWeekRange($date){
     $ret=array();
     $timestamp=strtotime($date);
     $w=strftime('%u',$timestamp);
     $ret['sdate']=date('Y-m-d 00:00:00',$timestamp-($w-1)*86400);
     $ret['edate']=date('Y-m-d 23:59:59',$timestamp+(7-$w)*86400);
     return $ret;
 }
 
 //author:zhxia 获取指定日期所在月的开始日期与结束日期
 function getMonthRange($date){
     $ret=array();
     $timestamp=strtotime($date);
     $mdays=date('t',$timestamp);
     $ret['sdate']=date('Y-m-1 00:00:00',$timestamp);
     $ret['edate']=date('Y-m-'.$mdays.' 23:59:59',$timestamp);
     return $ret;
 }
 
 
 //author:zhxia  以上两个函数的应用
 function getFilter($n){
     $ret=array();
     switch($n){
         case 1:// 昨天
             $ret['sdate']=date('Y-m-d 00:00:00',strtotime('-1 day'));
             $ret['edate']=date('Y-m-d 23:59:59',strtotime('-1 day'));
         break;
         case 2://本星期
             $ret=getWeekRange(date('Y-m-d'));
         break;
         case 3://上一个星期
             $strDate=date('Y-m-d',strtotime('-1 week'));
             $ret=getWeekRange($strDate);
         break;
         case 4: //上上星期
             $strDate=date('Y-m-d',strtotime('-2 week'));
             $ret=getWeekRange($strDate);
         break;
         case 5: //本月
             $ret=getMonthRange(date('Y-m-d'));
             break;
         case 6://上月
             $strDate=date('Y-m-d',strtotime('-1 month'));
             $ret=getMonthRange($strDate);
         break;
     }
     return $ret;
 }

?>