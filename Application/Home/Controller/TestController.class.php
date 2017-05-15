<?php
namespace Home\Controller;
use Think\Controller;

class TestController extends Controller
{
   public function index()
   {    
	//配置文件 稍后写入数据库
	$num_day=90;//查询几天前的数据
	$beishu=2.5;//大于小于多少倍
	$dayu=0.05;//大于倍数提成多少
	$xiaoyu=0.03;//小于倍数提成多少
	//默认查询当天数据
	$default_stime=strtotime(date("Y-m-d"),time())-(60*60*24*$num_day);
	//$default_stime=date("Y-m-d H:i:s",$default_stime);
	$default_etime = strtotime(date("Y-m-d"),time())+60*60*24-(60*60*24*$num_day);  
    //$default_etime=date("Y-m-d H:i:s", $default_etime);

	if(!empty($_REQUEST['search_stime']))
	{
		$search_stime=strtotime($_REQUEST['search_stime'])-(60*60*24*$num_day);
	}
	else
	{
		$search_stime=$default_stime;	
	}
	$search_stime=date('Y-m-d H:i:s',$search_stime);
	if(!empty($_REQUEST['search_etime']))
	{
		$search_etime=strtotime($_REQUEST['search_etime'])-(60*60*24*$num_day);
	}
	else
	{
		$search_etime=$default_etime;
	}	
	$search_etime=date('Y-m-d H:i:s',$search_etime);


    $orders=M('view_orders');
	$warehouse=M('warehouse');
    $packuser=D('PackUser');
    $sku=D('sku');
	$arraywhere=" 1=1 and oid_status='TRADE_FINISHED' and  (created_time >='".$search_stime."' and created_time <='".$search_etime."')";
   }
   public  function test()
   {
      $txt=array("a","b","c");
      dump($txt);
      $x=  in_array("a1",$txt);
      dump($x);
   }
  
//end	
}
?>