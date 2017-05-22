<?php
namespace Home\Controller;
class TaskController extends BaseController
{
    //2017-05-18
    /*
    订单数据  更新状态问题(天猫京东未处理)
    退款数据  更新状态问题(天猫已做程序处理,京东未处理)
    */
    /*
     注意抓取过程脚本超时问题
    */

    //每日作业更新订单状态origin
    //每日作业更新订单状态orders
    //初始化用获取三个月内订单数据写入orders
    //初始化用获取三个月内订单数据写入origin orders

    public function task_day_tm_order()//每日0点定时作业获取订单数据写入orders
    {

        //start 2017-02-07 end 2017-05-10 00:00:00
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='天猫'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

                $c_pageno=1;
                $c_pagesize=100;
                $c_status='';
                $c_order_count=$getorder->get_tm_orders_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
                $c_pageall=ceil($c_order_count/$c_pagesize);
                for($i=1;$i<=$c_pageall;$i++)
                {
                    $getorder->get_tm_orders($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

                }


        }
    }
    public function task_day_tm_order_update()//每日定时作业抓取增量数据
    {
        header("Content-Type:text/html; charset=utf-8");
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='天猫'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=100;
            $c_status='';
            $c_order_count=$getorder->get_tm_orders_update_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("<br>总记录数:".$c_order_count);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            echo("<br>总页数数:".$c_pageall);
            echo("<br>");
            //exit;
            for($i=$c_pageall;$i>=0;$i--)//
            {
                $getorder->get_tm_orders_update($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }

    public function task_day_origin_tm_order()//每日0点定时作业抓取天猫原数据
    {
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='天猫'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

                $c_pageno=1;
                $c_pagesize=100;
                $c_status='';
                $c_order_count=$getorder->get_origin_tm_orders_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
                $c_pageall=ceil($c_order_count/$c_pagesize);
                for($i=1;$i<=$c_pageall;$i++)//
                {
                    $getorder->get_origin_tm_orders($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

                }

        }
    }

    //change
    public function task_day_origin_tm_order_update()//每日定时作业抓取增量数据
    {
        header("Content-Type:text/html; charset=utf-8");
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='天猫'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=100;
            $c_status='';
            $c_order_count=$getorder->get_origin_tm_orders_update_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("<br>总记录数:".$c_order_count);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            echo("<br>总页数数:".$c_pageall);
            echo("<br>");
            //exit;
            for($i=$c_pageall;$i>=0;$i--)//
            {
                $getorder->get_origin_tm_orders_update($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }
    public function task_day_origin_tm_refund()//每日0点定时作业抓取天猫退款原数据
    {

        //start 2017-02-07 end 2017-05-10 00:00:00
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='天猫'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=100;
            $c_status='';
            $c_order_count=$getorder->get_origin_tm_refund_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("总记录数:".$c_order_count);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_tm_refund($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }
    public function task_day_origin_tm_pingjia()//每日0点定时作业抓取天猫评价原数据
    {

        /*
        搜索到的评价总数。相同的查询时间段条件下，最大只能获取总共1500条评价记录。所以当评价大于等于1500时 ISV可以通过start_date及end_date来进行拆分，以保证可以查询到全部数据
        */
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='天猫'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=100;
            $c_status='';
            $c_order_count=$getorder->get_origin_tm_pingjia_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("总记录数:".$c_order_count);
            //exit;
            $c_pageall=ceil($c_order_count/$c_pagesize);
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_tm_pingjia($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }

    public function task_day_jd_order()//每日0点定时作业获取订单数据写入orders
    {
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {
            $c_pageno=1;
            $c_pagesize=100;
            $c_status='WAIT_SELLER_STOCK_OUT,WAIT_GOODS_RECEIVE_CONFIRM,FINISHED_L,TRADE_CANCELED,LOCKED';
            $c_order_count=$getorder->get_jd_orders_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            for($i=1;$i<=$c_pageall;$i++)
            {
                $getorder->get_jd_orders($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }
        }
    }
    public function task_day_jd_order_update()
    {
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {
            $c_pageno=1;
            $c_pagesize=100;
            $c_status='WAIT_SELLER_STOCK_OUT,WAIT_GOODS_RECEIVE_CONFIRM,FINISHED_L,TRADE_CANCELED,LOCKED';
            $c_order_count=$getorder->get_jd_orders_update_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            echo("总记录数:".$c_order_count."<br>");
            echo("总页数:".$c_pageall."<br>");
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_jd_orders_update($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }
        }
    }
    public function task_day_origin_jd_order()//每日0点定时作业抓取京东原数据
    {

        //start 2017-02-07 end 2017-05-10 00:00:00
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=100;
            $c_status='WAIT_SELLER_STOCK_OUT,WAIT_GOODS_RECEIVE_CONFIRM,FINISHED_L,TRADE_CANCELED,LOCKED';
            $c_order_count=$getorder->get_origin_jd_orders_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_jd_orders($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }
    public function task_day_origin_jd_order_update()//每日0点定时作业抓取京东原数据
    {

        //start 2017-02-07 end 2017-05-10 00:00:00
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=100;
            $c_status='WAIT_SELLER_STOCK_OUT,WAIT_GOODS_RECEIVE_CONFIRM,FINISHED_L,TRADE_CANCELED,LOCKED';
            $c_order_count=$getorder->get_origin_jd_orders_update_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            echo("总记录数:".$c_order_count."<br>");
            echo("总页数:".$c_pageall."<br>");
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_jd_orders_update($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }

    public function task_day_origin_jd_refund()//每日0点定时作业抓取京东退款原数据
    {

        //start 2017-02-07 end 2017-05-10 00:00:00
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=50;
            $c_status='';
            $c_order_count=$getorder->get_origin_jd_refund_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("<br>总记录数:".$c_order_count);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            echo("<br>总页数:".$c_pageall);
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_jd_refund($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }
    public function task_day_origin_jd_refund_update()//每日0点定时作业抓取京东退款原数据
    {

        //start 2017-02-07 end 2017-05-10 00:00:00
        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=50;
            $c_status='';
            $c_order_count=$getorder->get_origin_jd_refund_update_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("<br>总记录数:".$c_order_count);
            $c_pageall=ceil($c_order_count/$c_pagesize);
            echo("<br>总页数:".$c_pageall);
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_jd_refund_update($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }
    public function task_day_origin_jd_pingjia()//每日0点定时作业抓取京东退款原数据
    {


        $c_stime=strtotime(date("Y-m-d"),time());
        $c_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        $c_stime=date("Y-m-d H:i:s", $c_stime);
        $c_etime=date("Y-m-d H:i:s", $c_etime);
        //dump($c_stime);
        //dump($c_etime);
        //exit;
        $getorder=A('Getorder');
        $key=M('config_key');
        $c_list=$key->where("type='京东'")->order('id asc')->select();
        foreach($c_list as $key=>$val)
        {

            $c_pageno=1;
            $c_pagesize=50;
            $c_status='';
            $c_order_count=$getorder->get_origin_jd_pingjia_count($c_stime,$c_etime,$c_pageno,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl']);
            echo("<br>总记录数:".$c_order_count);

            //$c_pageall=ceil($c_order_count/$c_pagesize);
            echo("<br>总页数:".$c_pageall);
            //exit;
            for($i=1;$i<=$c_pageall;$i++)//
            {
                $getorder->get_origin_jd_pingjia($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

            }

        }
    }
    public function test()
    {
        header("Content-Type:text/html; charset=utf-8");
        $t1='2017-05-18 16:15:50';
        $t2='2017-05-18 16:13:50';
        if($t1>$t2)
        {
            echo('t1 max');
        }
        elseif($t1==$t2)
        {
            echo('same');

        }
        else
        {
            echo('t2 max');
        }
    }

    public function test2()
    {
        $orders=M('orders');
        $orders_list=M("orders_list");
        $list=$orders->where("qudao=''")->select();
        $count_succ=0;
        $count_rb=0;
        $count_ol=0;
        foreach($list as $key=>$val)
        {
            $db=M();
            $db->startTrans();
            $res1=$orders_list->where("order_id='".$val['order_id']."'")->delete();
            $res2=$orders->where("order_id='".$val['order_id']."'")->delete();
            if($res1&&$res2)
            {
                $db->commit();
                $count_succ+=1;
                $count_ol+=$res1;
            }
            else
            {
                $db->rollback();
                $count_rb+=1;
            }
        }
        dump($count_succ);
        dump($count_rb);
        dump($count_ol);
    }



//end	
}
?>