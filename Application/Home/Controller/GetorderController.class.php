<?php
namespace Home\Controller;


class GetorderController extends BaseController
{

    public function get_tm_orders_count($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='')
    {

        Vendor('TopSdk.TopSdk');
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \TradesSoldGetRequest;
        $req->setFields("tid,status");
        $req->setStartCreated($stime);
        $req->setEndCreated($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("false");
        $resp = $c->execute($req, $token);
        $resp=$this->xmlToArr($resp);
        $order_count=$resp['total_results'];
        return $order_count;

    }

    public function get_tm_orders($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {

        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        //$sku=M('sku','lbpa_',C("DB_SKU"));
        $sku=D('sku');
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \TradesSoldGetRequest;
        $req->setFields("seller_nick,pic_path,payment,seller_rate,post_fee, receiver_name,receiver_state, receiver_address, receiver_zip,
         receiver_mobile,receiver_phone, consign_time,received_payment, receiver_country,receiver_town,shop_pick, tid,
          num,num_iid, status, title, type, price,discount_fee, total_fee,created, pay_time,modified,end_time, seller_flag,
          buyer_nick,has_buyer_message, credit_card_fee,step_trade_status, step_paid_fee,mark_desc,shipping_type,adjust_fee,trade_from,orders");
        $req->setStartCreated($stime);
        $req->setEndCreated($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("true");
        $resp = $c->execute($req, $token);
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
                $orders->dianpu=$dp_name;
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



        echo("<br>天猫新增:".$count_success);
        echo("<br>天猫回滚:".$count_rollback);
        echo("<br>天猫已存在跳过:".$count_skip);
        echo('<br>>>>>>>>>>>>>>>>>>>>>>');
    }

    public function get_origin_tm_orders($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {

        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        //$sku=M('sku','lbpa_',C("DB_SKU"));
        $sku=D('sku');
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \TradesSoldGetRequest;
        $req->setFields("seller_nick,pic_path,payment,seller_rate,post_fee, receiver_name,receiver_state, receiver_address, receiver_zip,
         receiver_mobile,receiver_phone, consign_time,received_payment, receiver_country,receiver_town,shop_pick, tid,
          num,num_iid, status, title, type, price,discount_fee, total_fee,created, pay_time,modified,end_time, seller_flag,
          buyer_nick,has_buyer_message, credit_card_fee,step_trade_status, step_paid_fee,mark_desc,shipping_type,adjust_fee,trade_from,orders");
        $req->setStartCreated($stime);
        $req->setEndCreated($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("true");
        $resp = $c->execute($req, $token);
        //$t = json_encode($resp);
        //echo $t;
        //exit;
        $resp=$this->xmlToArr($resp);
        //dump($resp);
        //exit;
        $has_next=$resp['has_next'];
        //echo($has_next);

        $orders=M('origin_tm_orders');
        $orders_list=M('origin_tm_orders_list');
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
            $order_count=$orders->where("tid='".$list[$i]['tid']."'")->count();
            if($order_count==0)
            {
                //$orders->qudao="天猫";
                //$orders->dianpu=$dp_name;
                $orders->adjust_fee=$list[$i]['adjust_fee'];
                $orders->buyer_nick=$list[$i]['buyer_nick'];
                $orders->consign_time=$list[$i]['consign_time'];
                $orders->created=$list[$i]['created'];
                $orders->discount_fee=$list[$i]['discount_fee'];
                $orders->has_buyer_message=$list[$i]['has_buyer_message'];//
                $orders->modified=$list[$i]['modified'];
                $orders->num=$list[$i]['num'];
                $orders->num_iid=$list[$i]['num_iid'];
                $orders->pay_time=$list[$i]['pay_time'];
                $orders->payment=$list[$i]['payment'];
                $orders->pic_path=$list[$i]['pic_path'];
                $orders->post_fee=$list[$i]['post_fee'];
                $orders->price=$list[$i]['price'];
                $orders->received_payment=$list[$i]['received_payment'];
                $orders->receiver_address=$list[$i]['receiver_address'];
                $orders->receiver_mobile=$list[$i]['receiver_mobile'];
                $orders->receiver_phone=$list[$i]['receiver_phone'];
                $orders->receiver_name=$list[$i]['receiver_name'];
                $orders->receiver_state=$list[$i]['receiver_state'];
                $orders->receiver_town=$list[$i]['receiver_town'];
                $orders->receiver_zip=$list[$i]['receiver_zip'];
                $orders->seller_flag=$list[$i]['seller_flag'];
                $orders->seller_nick=$list[$i]['seller_nick'];
                $orders->seller_rate=$list[$i]['seller_rate'];//
                $orders->shipping_type=$list[$i]['shipping_type'];
                $orders->status=$list[$i]['status'];
                $orders->tid=$list[$i]['tid'];
                $orders->title=$list[$i]['title'];
                $orders->total_fee=$list[$i]['total_fee'];
                $orders->trade_from=$list[$i]['trade_from'];
                $orders->type=$list[$i]['type'];
                $orders->credit_card_fee=$list[$i]['credit_card_fee'];
                $orders->remark=serialize($list[$i]);
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

                    $orders_list->tid=$list[$i]['tid'];
                    $orders_list->adjust_fee=$list2[$j]['adjust_fee'];
                    $orders_list->buyer_rate=$list2[$j]['buyer_rate'];
                    $orders_list->cid=$list2[$j]['cid'];
                    $orders_list->consign_time=$list2[$j]['consign_time'];
                    $orders_list->discount_fee=$list2[$j]['discount_fee'];
                    $orders_list->invoice_no=$list2[$j]['invoice_no'];
                    $orders_list->is_daixiao=$list2[$j]['is_daixiao'];
                    $orders_list->logistics_company=$list2[$j]['logistics_company'];
                    $orders_list->num=$list2[$j]['num'];
                    $orders_list->num_iid=$list2[$j]['num_iid'];
                    $orders_list->oid=$list2[$j]['oid'];
                    $orders_list->outer_iid=$list2[$j]['outer_iid'];
                    $orders_list->outer_sku_id=$list2[$j]['outer_sku_id'];
                    $orders_list->payment=$list2[$j]['payment'];
                    $orders_list->pic_path=$list2[$j]['pic_path'];
                    $orders_list->price=$list2[$j]['price'];
                    $orders_list->refund_status=$list2[$j]['refund_status'];
                    $orders_list->seller_rate=$list2[$j]['seller_rate'];
                    $orders_list->seller_type=$list2[$j]['seller_type'];
                    $orders_list->shipping_type=$list2[$j]['shipping_type'];
                    $orders_list->sku_id=$list2[$j]['sku_id'];
                    $orders_list->sku_properties_name=$list2[$j]['sku_properties_name'];
                    $orders_list->status=$list2[$j]['status'];
                    $orders_list->title=$list2[$j]['title'];
                    $orders_list->total_fee=$list2[$j]['total_fee'];
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



        echo("<br>天猫新增:".$count_success);
        echo("<br>天猫回滚:".$count_rollback);
        echo("<br>天猫已存在跳过:".$count_skip);
        echo('<br>>>>>>>>>>>>>>>>>>>>>>');
    }



    //抓取天猫退款数据
    public function get_origin_tm_refund_count($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');

        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \RefundsReceiveGetRequest;
        $req->setFields("refund_id, tid,oid, total_fee,buyer_nick,seller_nick, created,modified, order_status, status,good_status,
        has_good_return, refund_fee,payment, reason,desc, title,num,company_name,sid, refund_phase,refund_version,sku, attribute,outer_id,operation_contraint");
        $req->setStartModified($stime);
        $req->setEndModified($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("false");
        $resp = $c->execute($req, $token);
        $resp=$this->xmlToArr($resp);
        $order_count=$resp['total_results'];
        return $order_count;

    }
    public function get_origin_tm_refund($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {
        //考虑了退款订单更新问题。
        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \RefundsReceiveGetRequest;
        $req->setFields("refund_id, tid,oid, total_fee,buyer_nick,seller_nick, created,modified, order_status, status,good_status,
        has_good_return, refund_fee,payment, reason,desc, title,num,company_name,sid, refund_phase,refund_version,sku, attribute,outer_id,operation_contraint");
        $req->setStartModified($stime);
        $req->setEndModified($etime);
        $req->setStatus($status);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("true");
        $resp = $c->execute($req, $token);
        $resp=$this->xmlToArr($resp);
        //$t = json_encode($resp);
        //echo $t;
        //exit;
        //dump($resp);
        //exit;
        $refund=M('origin_tm_refund');
        $count_success=0;
        $count_skip=0;
        $count_update=0;
        //如果只有一个订单  返回的格式不一样
        if(!(array_key_exists(0,$resp['refunds']['refund'])))
        {
            $t=$resp['refunds']['refund'];
            unset($resp['refunds']['refund']);
            $resp['refunds']['refund'][0]=$t;
        }
        $list=$resp['refunds']['refund'];
        foreach($list as $key=>$val)
        {
            $key_list=(array_keys($val));
            //dump($val);
            //先判断是否存在 不存在写入 存在更新状态
            $count=$refund->where("refund_id ='".$val['refund_id']."' ")->count();
            if($count==0)
            {

                foreach($key_list as $k=>$v )
                {
                    $refund->$v=$val[$v];
                    //dump($v);

                }
                $res=$refund->add();
                if($res)
                {
                    $count_success+=1;
                }

            }
            else
            {
                //判断modified是否不同 相同跳过 不同更新退款信息
                $c_tmp=$refund->where("refund_id ='".$val['refund_id']."' ")->find();
                if($c_tmp['modified']==$val['modified'])
                {
                    $count_skip+=1;
                }
                else//更新订单
                {
                    $db=M();
                    $db->startTrans();
                    $res1=$refund->where("refund_id ='".$val['refund_id']."' ")->delete();
                    foreach($key_list as $k=>$v )
                    {
                        $refund->$v=$val[$v];
                        //dump($v);

                    }
                    $res2=$refund->add();

                    if($res1&&$res2)
                    {
                        $count_update+=1;
                        $db->commit();

                    }
                    else
                    {
                        $db->rollback();
                    }

                }
            }




        }
        echo("<br>新增记录:".$count_success);
        echo("<br>相同记录:".$count_skip);
        echo("<br>更新记录:".$count_update);
        echo("<br>**********************************");


    }
    public function get_origin_tm_pingjia_count($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \TraderatesGetRequest;
        $req->setFields(" tid,oid, role,nick,result, created,rated_nick,item_title,item_price,content,reply,num_iid, valid_score");
        $req->setRateType("get");
        $req->setRole("buyer");
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("false");
        $resp = $c->execute($req, $token);
        $resp=$this->xmlToArr($resp);
        $order_count=$resp['total_results'];
        return $order_count;

    }
    public function get_origin_tm_pingjia($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {

        header("Content-Type:text/html; charset=utf-8");
        Vendor('TopSdk.TopSdk');
        $c = new \TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secretkey;
        $c->gatewayUrl = $gatewayurl;
        $req = new \TraderatesGetRequest;
        $req->setFields(" tid,oid, role,nick,result, created,rated_nick,item_title,item_price,content,reply,num_iid, valid_score");
        $req->setRateType("get");
        $req->setRole("buyer");
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setUseHasNext("true");
        $resp = $c->execute($req, $token);
        $resp=$this->xmlToArr($resp);
        //$t = json_encode($resp);
        //echo $t;
        //exit;
        //dump($resp);
        //exit;
        $pingjia=M('origin_tm_pingjia');
        $count_success=0;
        $count_skip=0;

        //如果只有一个订单  返回的格式不一样
        if(!(array_key_exists(0,$resp['trade_rates']['trade_rate'])))
        {
            $t=$resp['trade_rates']['trade_rate'];
            unset($resp['trade_rates']['trade_rate']);
            $resp['trade_rates']['trade_rate'][0]=$t;
        }
        $list=$resp['trade_rates']['trade_rate'];
        //dump($list);
        //exit;
        foreach($list as $key=>$val)
        {
            $key_list=(array_keys($val));
            $count=$pingjia->where( array("oid"=>$val['oid'],"nick"=>$val['nick']) )->count();
            if($count==0)
            {

                foreach($key_list as $k=>$v )
                {
                    $pingjia->$v=$val[$v];
                    //dump($v);

                }
                $res=$pingjia->add();
                if($res)
                {
                    $count_success+=1;
                }

            }
            else
            {


                    $count_skip+=1;

            }




        }
        echo("<br>新增记录:".$count_success);
        echo("<br>相同记录:".$count_skip);

        echo("<br>**********************************");


    }
    public function get_jd_orders_count ($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='')
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = $appkey;
        $c->appSecret = $secretkey;
        $c->accessToken = $token;
        $c->serverUrl = $gatewayurl;
        $req = new \OrderSearchRequest();
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setOrderState( $status );
        $req->setPage($pageno);
        $req->setPageSize($pagesize);
        $req->setDateType(1);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        return $resp['order_search']['order_total'];
    }
    public function get_jd_orders($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = $appkey;
        $c->appSecret = $secretkey;
        $c->accessToken = $token;
        $c->serverUrl = $gatewayurl;
        $req = new \OrderSearchRequest();
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setOrderState( $status );
        $req->setPage($pageno);
        $req->setPageSize($pagesize);
        $req->setDateType(1);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        $list=$resp['order_search']['order_info_list'];
        //dump($resp['order_search']['order_total']);
        //exit;
        //$t = json_encode($resp);
        //echo $t;
        //dump($resp);
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
                $orders->dianpu=$dp_name;
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
        echo("<br>京东新增:".$count_success);
        echo("<br>京东回滚:".$count_rollback);
        echo("<br>京东已存在跳过:".$count_skip);
        echo('<br>>>>>>>>>>>>>>>>>>>>>>');

    }

    public function get_origin_jd_orders($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = $appkey;
        $c->appSecret = $secretkey;
        $c->accessToken = $token;
        $c->serverUrl = $gatewayurl;
        $req = new \OrderSearchRequest();
        $req->setStartDate($stime);
        $req->setEndDate($etime);
        $req->setOrderState( $status );
        $req->setPage($pageno);
        $req->setPageSize($pagesize);
        $req->setDateType(1);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        $list=$resp['order_search']['order_info_list'];
        //dump($resp['order_search']['order_total']);
        //exit;
        //$t = json_encode($resp);
        //echo $t;
        //dump($resp);
        //exit;
        $sku=D('sku');
        $orders=M('origin_jd_orders');
        $orders_list=M('origin_jd_orders_list');
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
                //$orders->qudao="京东";
                //$orders->dianpu=$dp_name;
                $orders->modified=$list[$i]['modified'];
                $orders->customs=$list[$i]['customs'];
                $orders->order_id=$list[$i]['order_id'];
                $orders->vender_id=$list[$i]['vender_id'];
                $orders->pay_type=$list[$i]['pay_type'];
                $orders->order_total_price=$list[$i]['order_total_price'];
                $orders->order_seller_price=$list[$i]['order_seller_price'];
                $orders->order_payment=$list[$i]['order_payment'];
                $orders->freight_price=$list[$i]['freight_price'];
                $orders->seller_discount=$list[$i]['seller_discount'];
                $orders->order_state=$list[$i]['order_state'];
                $orders->delivery_type=$list[$i]['delivery_type'];
                $orders->invoice_info=$list[$i]['invoice_info'];
                $orders->order_remark=$list[$i]['order_remark'];
                $orders->order_start_time=$list[$i]['order_start_time'];
                $orders->consignee_info=serialize($list[$i]['consignee_info']);
                $orders->item_info_list=serialize($list[$i]['item_info_list']);
                $orders->coupon_detail_list=serialize($list[$i]['coupon_detail_list']);
                $orders->order_type=$list[$i]['order_type'];
                $orders->order_source=$list[$i]['order_source'];
                $orders->store_order=$list[$i]['store_order'];
                $orders->customs_model=$list[$i]['customs_model'];
                $orders->order_sign=$list[$i]['order_sign'];
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
                    $orders_list->order_id=$list[$i]['order_id'];

                    $orders_list->sku_id=$item_info_list[$j]['sku_id'];
                    $orders_list->outer_sku_id=$item_info_list[$j]['outer_sku_id'];
                    $orders_list->sku_name=$item_info_list[$j]['sku_name'];
                    $orders_list->jd_price=$item_info_list[$j]['jd_price'];
                    $orders_list->gift_point=$item_info_list[$j]['gift_point'];
                    $orders_list->ware_id=$item_info_list[$j]['ware_id'];
                    $orders_list->item_total=$item_info_list[$j]['item_total'];
                    $orders_list->coupon_price=(isset($coupon_list[$item_info_list[$j]['sku_id']])?$coupon_list[$item_info_list[$j]['sku_id']]:0)/$item_info_list[$j]['item_total'];
                    $orders_list->payment=($item_info_list[$j]['jd_price']*$item_info_list[$j]['item_total'])-(isset($coupon_list[$item_info_list[$j]['sku_id']])?$coupon_list[$item_info_list[$j]['sku_id']]:0);
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
        echo("<br>京东新增:".$count_success);
        echo("<br>京东回滚:".$count_rollback);
        echo("<br>京东已存在跳过:".$count_skip);
        echo('<br>>>>>>>>>>>>>>>>>>>>>>');

    }
    public function get_origin_jd_refund_count($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {

        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = $appkey;
        $c->appSecret = $secretkey;
        $c->accessToken = $token;
        $c->serverUrl = $gatewayurl;
        $req = new \PopAfsSoaRefundapplyQueryPageListRequest();
        $req->setStatus($status );
        $req->setApplyTimeStart($stime);
        $req->setApplyTimeEnd($etime);
        /* 审核时间 用在更新退款状态？
        $req->setCheckTimeStart();
        $req->setCheckTimeEnd();
        */
        $req->setPageIndex($pageno);
        $req->setPageSize($pagesize);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        return ($resp['queryResult']['totalCount']);

    }
    public function get_origin_jd_refund($stime='',$etime='',$pageno=1,$pagesize=100,$status='',$token='',$appkey='',$secretkey='',$gatewayurl='',$dp_name)
    {
        header("Content-Type:text/html; charset=utf-8");
        Vendor('JdSdk.JdSdk');
        $c = new \JdClient();
        $c->appKey = $appkey;
        $c->appSecret = $secretkey;
        $c->accessToken = $token;
        $c->serverUrl = $gatewayurl;
        $req = new \PopAfsSoaRefundapplyQueryPageListRequest();
        $req->setStatus($status );
        $req->setApplyTimeStart($stime);
        $req->setApplyTimeEnd($etime);
        /* 审核时间 用在更新退款状态？
        $req->setCheckTimeStart();
        $req->setCheckTimeEnd();
        */
        $req->setPageIndex($pageno);
        $req->setPageSize($pagesize);
        $resp = $c->execute($req, $c->accessToken);
        $resp=$this->object2array($resp);
        //$t = json_encode($resp);
        //echo $t;
        //dump($resp);
        //exit;
        $refund=M('origin_jd_refund');
        $count_success=0;
        $count_skip=0;
        $list=$resp['queryResult']['result'];
        //dump($resp['queryResult']['totalCount']);
        //exit;
        foreach($list as $key=>$val)
        {
            $key_list=(array_keys($val));
            $count=$refund->where( array("id"=>$val['id']) )->count();
            if($count==0)
            {

                foreach($key_list as $k=>$v )
                {
                    $refund->$v=$val[$v];
                    //dump($v);

                }
                $res=$refund->add();
                if($res)
                {
                    $count_success+=1;
                }

            }
            else
            {


                $count_skip+=1;

            }

        }
        echo("<br>京东新增:".$count_success);
        echo("<br>京东已存在跳过:".$count_skip);
        echo('<br>>>>>>>>>>>>>>>>>>>>>>');

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