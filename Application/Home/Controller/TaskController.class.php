<?php
namespace Home\Controller;
class TaskController extends BaseController
{
    /*
     注意抓取过程脚本超时问题
    */


    //每日作业更新订单状态origin
    //每日作业更新订单状态orders
    //初始化用获取三个月内订单数据写入orders
    //初始化用获取三个月内订单数据写入origin orders

    public function task_day_order()//每日0点定时作业获取订单数据写入orders
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
            //根据type获取不同的数据(天猫,京东)
            if($val['type']=='天猫')
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
            elseif($val['type']=='京东')
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
    }
    public function task_day_origin_tm_order()//每日0点定时作业抓取原数据
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
                for($i=1;$i<=$c_pageall;$i++)//
                {
                    $getorder->get_origin_tm_orders($c_stime,$c_etime,$i,$c_pagesize,$c_status,$val['token'],$val['appkey'],$val['secretkey'],$val['gatewayurl'],$val['name']);

                }

        }
    }
    public function test()
    {
        header("Content-Type:text/html; charset=utf-8");

        $t='a:27:{s:10:"adjust_fee";s:4:"0.00";s:10:"buyer_nick";s:15:"猪小兔子呀";s:7:"created";s:19:"2017-05-17 18:14:18";s:12:"discount_fee";s:5:"50.00";s:17:"has_buyer_message";s:5:"false";s:8:"modified";s:19:"2017-05-17 18:14:24";s:6:"orders";a:1:{s:5:"order";a:2:{i:0;a:22:{s:10:"adjust_fee";s:4:"0.00";s:10:"buyer_rate";s:5:"false";s:3:"cid";s:8:"50000436";s:12:"discount_fee";s:5:"80.00";s:16:"divide_order_fee";s:5:"69.48";s:10:"is_daixiao";s:5:"false";s:3:"num";s:1:"1";s:7:"num_iid";s:12:"548570755822";s:3:"oid";s:17:"16132862292311927";s:12:"outer_sku_id";s:18:"T恤9229AL浅灰2X";s:17:"part_mjz_discount";s:5:"19.52";s:7:"payment";s:5:"89.00";s:8:"pic_path";s:94:"https://img.alicdn.com/bao/uploaded/i3/1016143238/TB2JwxNmCBjpuFjSsplXXa5MVXa_!!1016143238.jpg";s:5:"price";s:6:"169.00";s:13:"refund_status";s:9:"NO_REFUND";s:11:"seller_rate";s:5:"false";s:11:"seller_type";s:1:"B";s:6:"sku_id";s:13:"3493627883622";s:19:"sku_properties_name";s:24:"颜色:浅灰;尺码:2XL";s:6:"status";s:22:"WAIT_SELLER_SEND_GOODS";s:5:"title";s:89:"领般夏季v领短袖t恤男韩版修身学生潮流体恤日系青年运动简约上衣";s:9:"total_fee";s:5:"89.00";}i:1;a:22:{s:10:"adjust_fee";s:4:"0.00";s:10:"buyer_rate";s:5:"false";s:3:"cid";s:4:"3035";s:12:"discount_fee";s:6:"110.00";s:16:"divide_order_fee";s:6:"108.52";s:10:"is_daixiao";s:5:"false";s:3:"num";s:1:"1";s:7:"num_iid";s:12:"545002288403";s:3:"oid";s:17:"16132862293311927";s:12:"outer_sku_id";s:22:"休闲裤6600M蓝色33";s:17:"part_mjz_discount";s:5:"30.48";s:7:"payment";s:6:"139.00";s:8:"pic_path";s:94:"https://img.alicdn.com/bao/uploaded/i4/1016143238/TB2IJdPeYBmpuFjSZFAXXaQ0pXa_!!1016143238.jpg";s:5:"price";s:6:"249.00";s:13:"refund_status";s:9:"NO_REFUND";s:11:"seller_rate";s:5:"false";s:11:"seller_type";s:1:"B";s:6:"sku_id";s:13:"3450339039720";s:19:"sku_properties_name";s:23:"颜色:蓝色;尺码:33";s:6:"status";s:22:"WAIT_SELLER_SEND_GOODS";s:5:"title";s:90:"领般青年男士韩版修身西裤简约时尚休闲裤夏季薄款商务九分裤小脚";s:9:"total_fee";s:6:"139.00";}}}s:8:"pay_time";s:19:"2017-05-17 18:14:23";s:7:"payment";s:6:"178.00";s:8:"post_fee";s:4:"0.00";s:16:"received_payment";s:4:"0.00";s:16:"receiver_address";s:41:"梅*镇*店  金**路**号快天下快餐";s:15:"receiver_mobile";s:11:"137********";s:13:"receiver_name";s:5:"冯**";s:14:"receiver_state";s:9:"安徽省";s:13:"receiver_town";s:9:"梅山镇";s:12:"receiver_zip";s:6:"237300";s:11:"seller_flag";s:1:"0";s:11:"seller_nick";s:25:"leabornesl领般旗舰店";s:11:"seller_rate";s:5:"false";s:13:"shipping_type";s:7:"express";s:6:"status";s:22:"WAIT_SELLER_SEND_GOODS";s:3:"tid";s:17:"16132862291311927";s:5:"title";s:25:"leabornesl领般旗舰店";s:9:"total_fee";s:6:"418.00";s:10:"trade_from";s:7:"WAP,WAP";s:4:"type";s:5:"fixed";}';
        dump(unserialize($t));
    }

    public function test2()
    {
        $orders=M('orders');
        $orders_list=M("orders_list");
        $list=$orders->where("qudao='京东'")->select();
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