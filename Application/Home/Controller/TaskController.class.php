<?php
namespace Home\Controller;


class TaskController extends BaseController
{
    public function index()
    {

    }
    public function test()
    {

//start 2017-02-07
        $stime='2017-05-08 00:00:00';
        $etime='2017-05-10 00:00:00';
        $pageno=1;
        $pagesize=100;
        $status='';
        //$this->get_tm_orders($stime,$etime,$pageno,$pagesize,$status,C("TB_LB_TOKEN"));
        //exit;
        $order_count=$this->get_tm_orders_count($stime,$etime,$pageno,$pagesize,$status,C("TB_LB_TOKEN"));
        $pageall=ceil($order_count/$pagesize);
        //dump($order_count);
        //dump($pageall);
        //exit;

        for($i=1;$i<=$pageall;$i++)
        {
            $this->get_tm_orders($stime,$etime,$i,$pagesize,$status,C("TB_LB_TOKEN"));

        }

        /*
        $stime='2017-04-01 00:00:00';
        $etime='2017-04-01 23:59:59';
        $pageno=1;
        $pagesize=100;
        $status='FINISHED_L';
        $order_count=$this->get_jd_orders_count($stime,$etime,$pageno,$pagesize,$status,C("JD_LB_TOKEN"));
        //dump($order_count);
        //dump($pagesize);
        $pageall=ceil($order_count/$pagesize);
        //dump($pageall);
        for($i=1;$i<=$pageall;$i++)
        {
            $this->get_jd_orders($stime,$etime,$i,$pagesize,$status,C("JD_LB_TOKEN"));

        }
        */

    }
    public function test2()
    {
        $ol=M('orders_list');
        $sku=D('sku');
        $list=$ol->where('xilie is null')->select();
        //dump($list);
        //exit;
        $i=1;
        foreach($list as $key=>$val)
        {
            $sku_info=$sku->where("taoguanhao='".$list[$key]['outer_sku_id']."'")->find();
            //dump($sku_info);
            $ol->pinlei=$sku_info['pinlei'];;
            $ol->xilie=$sku_info['xilie'];;
            $ol->where("id=".$list[$key]['id'])->save();
            echo($i."<br>");
            $i++;

        }


    }


    public function get_tm_orders_count($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$tb_token='')
    {

        Vendor('TopSdk.TopSdk');
        $c = new \TopClient;
        $c->appkey = C("TB_APPKEY");
        $c->secretKey = C("TB_SECRETKEY");
        $c->gatewayUrl = 'http://121.41.33.119/jst/index.php';
        $req = new \TradesSoldGetRequest;
        $req->setFields("tid,status");
        $req->setStartCreated($stime);
        $req->setEndCreated($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("false");
        $resp = $c->execute($req, $tb_token);
        $resp=$this->xmlToArr($resp);
        $order_count=$resp['total_results'];
        return $order_count;

    }
    public function get_tm_orders_test($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$tb_token='')
    {

        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        //$sku=M('sku','lbpa_',C("DB_SKU"));
        $sku=D('sku');
        $c = new \TopClient;
        $c->appkey = C("TB_APPKEY");
        $c->secretKey = C("TB_SECRETKEY");
        $c->gatewayUrl = 'http://121.41.33.119/jst/index.php';
        $req = new \TradesSoldGetRequest;
        $req->setFields("payment,post_fee,consign_time,tid,status,
	 created, pay_time, end_time,orders,seller_flag, trade_from");
        $req->setStartCreated($stime);
        $req->setEndCreated($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("false");
        $resp = $c->execute($req, $tb_token);
        $resp=$this->xmlToArr($resp);
        $has_next=$resp['has_next'];
        dump($resp);
        echo('...............................<br>');





    }
    public function get_tm_orders($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$tb_token='')
    {

        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        //$sku=M('sku','lbpa_',C("DB_SKU"));
        $sku=D('sku');
        $c = new \TopClient;
        $c->appkey = C("TB_APPKEY");
        $c->secretKey = C("TB_SECRETKEY");
        $c->gatewayUrl = 'http://121.41.33.119/jst/index.php';
        $req = new \TradesSoldGetRequest;
        $req->setFields("payment,post_fee,consign_time,tid,status,
	 created, pay_time, end_time,orders,seller_flag, trade_from");
        $req->setStartCreated($stime);
        $req->setEndCreated($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("true");
        $resp = $c->execute($req, $tb_token);
        //$t = json_encode($resp);
        //echo $t;
        //exit;
        $resp=$this->xmlToArr($resp);
        //dump($resp);
        //exit;
        $has_next=$resp['has_next'];
        //echo($has_next);

        $orders=M('orders');
        $orders_list=M('orders_list');
        $count_success=0;
        $count_skip=0;
        $count_rollback=0;

        //如果只有一个订单 trade 返回的格式不一样
        if(!(array_key_exists(0,$resp['trades']['trade'])))
        {
            $t=$resp['trades']['trade'];
            unset($resp['trades']['trade']);
            $resp['trades']['trade'][0]=$t;
        }
        $list=$resp['trades']['trade'];
        for($i=0;$i<count($list);$i++)
        {
            $db=M();
            $db->startTrans();
            //先看订单是否已经抓取过
            $order_count=$orders->where("order_id='".$list[$i]['tid']."'")->count();
            if($order_count==0)
            {
                $orders->qudao="天猫";
                $orders->dianpu="领般旗舰店";
                $orders->order_id=$list[$i]['tid'];
                $orders->addtime=time();
                $orders->created_time =$list[$i]['created'];
                $orders->pay_time =$list[$i]['pay_time'];
                $orders->consign_time =$list[$i]['consign_time'];
                $orders->end_time =$list[$i]['end_time'];
                $orders->payment  =$list[$i]['payment'];
                $orders->post_fee  =$list[$i]['post_fee'];
                $orders->order_status =$list[$i]['status'];
                $orders->seller_flag =$list[$i]['seller_flag'];
                $orders->trade_from =$list[$i]['trade_from'];
                $result=$orders->add();
                if(!(array_key_exists(0,$list[$i]['orders']['order'])))
                {
                    $t=$list[$i]['orders']['order'];
                    unset($list[$i]['orders']['order']);
                    $list[$i]['orders']['order'][0]=$t;
                }
                $list2=$list[$i]['orders']['order'];
                for($j=0;$j<count($list2);$j++)
                {

                    $orders_list->refund_status=$list2[$j]['refund_status'];
                    $buyer_rate=$list2[$j]['buyer_rate'];
                    $seller_rate=$list2[$j]['seller_rate'];
                    if($buyer_rate=='true')
                    {
                        $buyer_rate=1;
                    }
                    else
                    {
                        $buyer_rate=0;
                    }
                    if($seller_rate=='true')
                    {
                        $seller_rate=1;
                    }
                    else
                    {
                        $seller_rate=0;
                    }
                    $orders_list->buyer_rate=$buyer_rate;
                    $orders_list->seller_rate=$seller_rate;
                    $orders_list->order_id=$list[$i]['tid'];
                    $orders_list->oid=$list2[$j]['oid'];
                    $orders_list->oid_status=$list2[$j]['status'];
                    $orders_list->outer_sku_id=$list2[$j]['outer_sku_id'];
                    $orders_list->order_from=$list2[$j]['order_from'];
                    $orders_list->price=$list2[$j]['price'];
                    $orders_list->num=$list2[$j]['num'];
                    $orders_list->total_fee=$list2[$j]['total_fee'];
                    $orders_list->payment=$list2[$j]['payment'];
                    $orders_list->discount_fee=$list2[$j]['discount_fee'];
                    $orders_list->adjust_fee=$list2[$j]['adjust_fee'];
                    $orders_list->end_time=$list2[$j]['end_time'];
                    $orders_list->consign_time=$list2[$j]['consign_time'];
                    $orders_list->shipping_type=$list2[$j]['shipping_type'];
                    $orders_list->logistics_company=$list2[$j]['logistics_company'];
                    $orders_list->invoice_no=$list2[$j]['invoice_no'];
                    $orders_list->title=$list2[$j]['title'];
                    //获取lbpak SKU表信息
                    $sku_info=$sku->where("taoguanhao='".$list2[$j]['outer_sku_id']."'")->find();
                    if(!empty($sku_info))
                    {
                        $orders_list->cangwei=$sku_info['warehouse'];
                        $orders_list->gongyingshang=$sku_info['dangkou'];
                        $orders_list->lururen=$sku_info['luru_id'];
                        $orders_list->cost_price=$sku_info['settle_price'];
                        $orders_list->pinlei=$sku_info['pinlei'];
                        $orders_list->xilie=$sku_info['xilie'];
                        $orders_list->jiandang_time=$sku_info['created_dt'];

                    }
                    $result2=$orders_list->add();
                }



                if($result&&$result2)
                {
                    $count_success+=1;
                    $db->commit();
                }
                else
                {
                    $count_rollback+=1;
                    $db->rollback();
                }


            }
            else//已经抓取过
            {
                $count_skip+=1;

            }//if end  判断是否抓取过





        }//for end



        dump($count_success);
        dump($count_rollback);
        dump($count_skip);
        echo('>>>>>>>>>>>>>>>>>>>>>><br>');
    }
    public function get_jd_orders_count ($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$jd_token='')
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = C("JD_APPKEY");
        $c->appSecret = C("JD_SECRETKEY");
        $c->accessToken = $jd_token;
        $c->serverUrl = "http://103.235.242.85/jdcloud/index.php";
        $req = new \OrderSearchRequest();
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setOrderState( $status );
        $req->setPage($pageno);
        $req->setPageSize($pagesize);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        return $resp['order_search']['order_total'];
    }
    public function get_jd_orders($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$jd_token='')
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = C("JD_APPKEY");
        $c->appSecret = C("JD_SECRETKEY");
        $c->accessToken = $jd_token;
        $c->serverUrl = "http://103.235.242.85/jdcloud/index.php";
        $req = new \OrderSearchRequest();
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setOrderState( $status );
        $req->setPage($pageno);
        $req->setPageSize($pagesize);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        $list=$resp['order_search']['order_info_list'];
        //dump($resp['order_search']['order_total']);
        //exit;
        //$t = json_encode($resp);
        //echo $t;
        //exit;
        $sku=D('sku');
        $orders=M('orders');
        $orders_list=M('orders_list');
        $count_success=0;
        $count_skip=0;
        $count_rollback=0;
        for($i=0;$i<count($list);$i++)
        {

            $db=M();
            $db->startTrans();
            //先看订单是否已经抓取过
            $order_count=$orders->where("order_id='".$list[$i]['order_id']."'")->count();
            if($order_count==0)
            {
                $orders->qudao="京东";
                $orders->dianpu="领般旗舰店";
                $orders->order_id=$list[$i]['order_id'];
                $orders->addtime=time();
                $orders->created_time =$list[$i]['order_start_time'];
                $orders->end_time =$list[$i]['modified'];
                $orders->payment  =$list[$i]['order_payment'];
                $orders->post_fee  =$list[$i]['freight_price'];
                $orders->order_status =$list[$i]['order_state'];
                $result=$orders->add();
                $item_info_list=$list[$i]['item_info_list'];
                $coupon_detail_list=$list[$i]['coupon_detail_list'];
                $item_info_amount = count($item_info_list);
                $coupon_list=array();
                foreach($coupon_detail_list as $k => $v)
                {
                    if(!empty($v['sku_id']))
                    {
                        $coupon_list[$v['sku_id']] = $v['coupon_price'];
                    }
                }
                for($j=0;$j<count($item_info_list);$j++)
                {

                    $orders_list->refund_status='';
                    $orders_list->buyer_rate='';
                    $orders_list->seller_rate='';
                    $orders_list->order_id=$list[$i]['order_id'];
                    //$orders_list->oid=$item_info_list[$j]['oid'];
                    //$orders_list->oid_status=$item_info_list[$j]['status'];
                    $orders_list->outer_sku_id=$item_info_list[$j]['outer_sku_id'];
                    //$orders_list->order_from=$item_info_list[$j]['order_from'];
                    $orders_list->price=$item_info_list[$j]['jd_price'];
                    $orders_list->num=$item_info_list[$j]['item_total'];
                    $orders_list->total_fee='';
                    $orders_list->payment=($item_info_list[$j]['jd_price']*$item_info_list[$j]['item_total'])-(isset($coupon_list[$item_info_list[$j]['sku_id']])?$coupon_list[$item_info_list[$j]['sku_id']]:0);

                    $orders_list->discount_fee=0;//优惠金额
                    $orders_list->adjust_fee=0;//手动调整金额
                    //$orders_list->end_time=$item_info_list[$j]['end_time'];
                    //$orders_list->consign_time=$item_info_list[$j]['consign_time'];
                    //$orders_list->shipping_type=$item_info_list[$j]['shipping_type'];
                    //$orders_list->logistics_company=$item_info_list[$j]['logistics_company'];
                    //$orders_list->invoice_no=$item_info_list[$j]['invoice_no'];
                    $orders_list->title=$item_info_list[$j]['sku_name'];
                    //获取lbpak SKU表信息
                    $sku_info=$sku->where("taoguanhao='".$item_info_list[$j]['outer_sku_id']."'")->find();
                    if(!empty($sku_info))
                    {
                        $orders_list->cangwei=$sku_info['warehouse'];
                        $orders_list->gongyingshang=$sku_info['dangkou'];
                        $orders_list->lururen=$sku_info['luru_id'];
                        $orders_list->cost_price=$sku_info['settle_price'];
                        $orders_list->pinlei=$sku_info['pinlei'];
                        $orders_list->xilie=$sku_info['xilie'];
                        $orders_list->jiandang_time=$sku_info['created_dt'];
                    }
                    $result2=$orders_list->add();
                }


                if($result&&$result2)
                {
                    $count_success+=1;
                    $db->commit();
                }
                else
                {
                    $count_rollback+=1;
                    $db->rollback();
                }
            }
            else//已经抓取过
            {
                $count_skip+=1;
            }


        }//for end
        dump($count_success);
        dump($count_rollback);
        dump($count_skip);

    }
    public function get_jx_kefu()
    {
        header("Content-Type:text/html; charset=utf-8");

        //获取上个月月份
        $thismonth = date('m');
        $thisyear = date('Y');
        if ($thismonth == 1)
        {
            $lastmonth = 12;
            $lastyear = $thisyear - 1;
        }
        else
        {
            $lastmonth = $thismonth - 1;
            $lastyear = $thisyear;
        }
        $lastStartDay = $lastyear . '-' . $lastmonth . '-1';
        $lastEndDay = $lastyear . '-' . $lastmonth . '-' . date('t', strtotime($lastStartDay));
        $start_time = ($lastStartDay);//上个月的月初时间
        $end_time = ($lastEndDay);//上个月的月末时间
        dump($start_time);
        dump($end_time);
        $cp=D("chapingyujing");
        $orders=M('view_orders');
        $jx_kefu=M('jx_kefu');
        $list=$cp->where("luru_dt>='".$start_time."' and luru_dt<='".$end_time."'")->select();
        //dump($list);
        $count_new=0;//新增
        $count_skip=0;//相同调过
        $count_no=0;//不存在
        $count_error=0;
        foreach($list as $key=>$val)
        {
            //pak 差评预警 订单号order_id 录入的是订单号 还是子订单号，可能同一个订单有多个产品 如果退款的子订单 客服如何录入 ，程序如何处理
            //先判断订单表中是否有相关销售记录，并且没有退款。
            $count=$orders->where("order_id='".$list[$key]['order_id']."' and outer_sku_id='".$list[$key]['sku']."' and refund_status='NO_REFUND' and oid_status='TRADE_FINISHED'")->count();
            if($count>0)
            {
                $i+=1;
                //先判断jx_kefu表是否已存在相关记录order_id and sku再抓取数据到本地表
                $count2=$jx_kefu->where("order_id='".$list[$key]['order_id']."' and sku='".$list[$key]['sku']."' ")->count();
                if($count2==0)//不存在 抓回
                {
                    $jx_kefu->pingtai_id=$list[$key]['pingtai_id'];
                    $jx_kefu->pingtai_name=$this->get_pingtai_name($list[$key]['pingtai_id']);
                    $jx_kefu->order_id=$list[$key]['order_id'];
                    $jx_kefu->pingjia_content=$list[$key]['pingjia_content'];
                    $jx_kefu->sku=$list[$key]['sku'];
                    $jx_kefu->remark=$list[$key]['remark'];
                    $jx_kefu->image=$list[$key]['image'];
                    $jx_kefu->luru_id=$list[$key]['luru_id'];
                    $jx_kefu->luru_dt=$list[$key]['luru_dt'];
                    $jx_kefu->kefu_id=$list[$key]['kefu_id'];
                    $jx_kefu->kefu_dt=$list[$key]['kefu_dt'];
                    //add
                    $order_info=$orders->where("order_id='".$list[$key]['order_id']."' and outer_sku_id='".$list[$key]['sku']."' ")->find();
                    $jx_kefu->cangwei_name=$order_info['cangwei_name'];
                    $jx_kefu->gongyingshang=$order_info['gongyingshang'];
                    $jx_kefu->dianpu=$order_info['dianpu'];
                    $jx_kefu->pinlei=$order_info['pinlei'];
                    $jx_kefu->xilie=$order_info['xilie'];
                    $jx_kefu->payment=$order_info['payment'];
                    //add end
                    $result=$jx_kefu->add();
                    if($result)
                    {
                        $count_new+=1;
                    }
                    else
                    {
                        $count_error+=1;
                    }
                }
                else
                {
                    $count_skip+=1;
                }
            }
            else
            {
                $count_no+=1;
            }
        }
        echo("新增记录:".$count_new);
        echo("相同记录:".$count_skip);
        echo("出错记录:".$count_);
        echo("不存在记录:".$count_no);

        //$this->display();
    }
    public function get_pingtai_name($id)
    {
        switch ($id)
        {
            case 1:
                $name='天猫';
                break;
            case 2:
                $name='京东';
                break;
            case 3:
                $name='C店';
                break;
            case 4:
                $name='商城';
                break;
            case 5:
                $name='其他';
                break;

            default:
                $name='';

        }
        return $name;
    }
    public function arrayLevel($arr)
    {
        $al = array(0);
        function aL($arr,&$al,$level=0){
            if(is_array($arr)){
                $level++;
                $al[] = $level;
                foreach($arr as $v){
                    aL($v,$al,$level);
                }
            }
        }
        aL($arr,$al);
        return max($al);
    }
    public function object2array($object)
    {
        $object =  json_decode( json_encode($object),true);
        return  $object;
    }
    public function xmlToArr($xml, $root = false)
    {

        if(!$xml->children())
        {
            return (string)$xml;
        }
        $array = array();
        foreach($xml->children() as $element => $node)
        {
            $totalElement = count($xml->{$element});
            if(!isset($array[$element]))
            {
                $array[$element] = "";
            }
            // Has attributes
            if($attributes = $node->attributes())
            {
                $data = array('attributes' => array(), 'value' => (count($node) > 0) ? $this->xmlToArr($node, false) : (string)$node);
                foreach($attributes as $attr => $value)
                {
                    $data['attributes'][$attr] = (string)$value;
                }
                if($totalElement > 1)
                {
                    $array[$element][] = $data;
                }
                else
                {
                    $array[$element] = $data;
                }
                // Just a value
            }
            else
            {
                if($totalElement > 1)
                {
                    $array[$element][] = $this->xmlToArr($node, false);
                }
                else
                {
                    $array[$element] = $this->xmlToArr($node, false);
                }
            }
        }
        if($root)
        {
            return array($xml->getName() => $array);
        }
        else
        {
            return $array;
        }

    }
//end	
}
?>