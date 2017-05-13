<?php
namespace Home\Controller;
class JixiaoController extends BaseController
{
   public function index()
   {

       $this->assign('left_f1',"open");
       $this->assign('left_arrow1',"open");
       $this->assign('left_c1',"block");
       $this->assign('left_c1_l1',"open");
       $this->display('chanpinbu');
   }

   public function shejibu()
   {
       $this->assign('left_f1',"open");
       $this->assign('left_arrow1',"open");
       $this->assign('left_c1',"block");
       $this->assign('left_c1_l2',"open");
       $this->display();

   }
    public function kefu()
    {
        $this->assign('left_f1',"open");
        $this->assign('left_arrow1',"open");
        $this->assign('left_c1',"block");
        $this->assign('left_c1_l3',"open");
        $this->display();
    }
   public function ajax_jx_get_chanpinbu()
   {
       //配置文件 稍后写入数据库
       $num_day=90;//建档时间多少天内的销售数据
       $beishu=2.5;//大于小于多少倍
       $dayu=10;//大于倍数提成多少单位元
       $xiaoyu=5;//小于倍数提成多少单位元
       //默认查询当天数据
       $default_stime=strtotime(date("Y-m-d"),time());
       //$default_stime=date("Y-m-d H:i:s",$default_stime);
       $default_etime = strtotime(date("Y-m-d"),time())+60*60*24;
       //$default_etime=date("Y-m-d H:i:s", $default_etime);

       if(!empty($_REQUEST['search_stime']))
       {
           $search_stime=strtotime($_REQUEST['search_stime']);
       }
       else
       {
           $search_stime=$default_stime;
       }
       $search_stime=date('Y-m-d H:i:s',$search_stime);
       if(!empty($_REQUEST['search_etime']))
       {
           $search_etime=strtotime($_REQUEST['search_etime']);
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
       //and TO_DAYS( created_time ) - TO_DAYS( jiandang_time ) >=0 不需要 实际不会有这种情况
       $arraywhere=" 1=1 and (TO_DAYS( created_time ) - TO_DAYS( jiandang_time ) <=".$num_day." ) 
	   and oid_status='TRADE_FINISHED' and  (created_time >='".$search_stime."' and created_time <='".$search_etime."')";

       //修改
       if(!empty($_REQUEST['qudao']))
       {
           $arraywhere.=" and qudao like '%".trim($_REQUEST["qudao"])."%' ";
       }
       if(!empty($_REQUEST['dianpu']))
       {
           $arraywhere.=" and dianpu like '%".trim($_REQUEST["dianpu"])."%' ";
       }
       if(!empty($_REQUEST['cangwei']))//转化成ID
       {
           $cangwei=$warehouse->where("name like '%".trim($_REQUEST['cangwei'])."%'")->getfield('id');
           $arraywhere.=" and cangwei ='".$cangwei."' ";
       }
       if(!empty($_REQUEST['lururen']))//转化成ID
       {
           $lururen=$packuser->where("user_login like '%".trim($_REQUEST['lururen'])."%'")->getfield('id');
           $arraywhere.=" and lururen ='".$lururen."' ";
       }

       if(!empty($_REQUEST['gongyingshang']))
       {
           $arraywhere.=" and gongyingshang like '%".trim($_REQUEST["gongyingshang"])."%' ";
       }
       if(!empty($_REQUEST['title']))
       {
           $arraywhere.=" and pinlei like '%".trim($_REQUEST["title"])."%' ";
       }
       if(!empty($_REQUEST['sku']))
       {
           $arraywhere.=" and outer_sku_id like '%".trim($_REQUEST["sku"])."%' ";
       }
       if(!empty($_REQUEST['order_id']))
       {
           $arraywhere.=" and order_id like '%".trim($_REQUEST["order_id"])."%' ";
       }
       //dump($arraywhere);
       //exit;
       $list=$orders->where($arraywhere)->order('created_time asc')->select();

       //dump($list);
       //exit;
       $iTotalRecords = count($list);
       $iDisplayLength = intval($_REQUEST['length']);
       $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
       $iDisplayStart = intval($_REQUEST['start']);
       $sEcho = intval($_REQUEST['draw']);
       $records = array();
       $records["data"] = array();
       $end = $iDisplayStart + $iDisplayLength;
       $end = $end > $iTotalRecords ? $iTotalRecords : $end;
       for($i = $iDisplayStart; $i < $end; $i++)
       {


           $id = ($i + 1);

           /*
           if(!empty($list[$i]['lururen']))
           {
               $user_login=$packuser->where("id=".$list[$i]['lururen'])->getfield('user_login');
           }
           else
           {
               $user_login="无记录";
           }
           if(!empty($list[$i]['cangwei']))
           {
               $list[$i]['cangwei_name']=$warehouse->where("id=".$list[$i]['cangwei'])->getfield('name');
               $list[$i]['cangwei_name']="无记录";
           }
           */
           $user_login=$packuser->where("id=".$list[$i]['lururen'])->getfield('user_login');
           //$pinlei=$sku->where("taoguanhao='".$list[$i]['outer_sku_id']."'")->getfield('pinlei');
           //$created_dt=$sku->where("taoguanhao='".$list[$i]['outer_sku_id']."'")->getfield('CREATED_DT');
           //$list[$i]['cangwei_name']=$warehouse->where("id=".$list[$i]['cangwei'])->getfield('name');
           $p=$list[$i]['payment']/$list[$i]['num'];
           $t=$p/$list[$i]['cost_price'];
           $t=sprintf("%.2f", $t);
           if($t>=$beishu)
           {
               $list[$i]['ticheng']=$dayu;

           }
           else
           {
               $list[$i]['ticheng']=$xiaoyu;

           }

           $records["data"][] = array(
               $id,
               $list[$i]['created_time'],
               $list[$i]['qudao'],
               $list[$i]['dianpu'],
               $list[$i]['cangwei_name'],
               $list[$i]['gongyingshang'],
               $list[$i]['pinlei'],
               $list[$i]['outer_sku_id'],
               $list[$i]['order_id'],
               $user_login,
               $list[$i]['cost_price'],
               $list[$i]['num'],
               $list[$i]['payment'],
               $list[$i]['ticheng'],
               $list[$i]['jiandang_time'],
               $list[$i]['oid_status'],
               ''//<a href="javascript:;" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>
           );

       }

       if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action")
       {
           $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
           $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
       }

       $records["draw"] = $sEcho;
       $records["recordsTotal"] = $iTotalRecords;
       $records["recordsFiltered"] = $iTotalRecords;
       echo json_encode($records);
	   

   }
    
   public function ajax_jx_get_shejibu()
   {
       //配置文件 稍后写入数据库
       $num_day=60;//建档时间多少天内的销售数据
       $beishu=2.5;//大于小于多少倍
       $dayu=10;//大于倍数提成多少
       $xiaoyu=5;//小于倍数提成多少
       //默认查询当天数据
       $default_stime=strtotime(date("Y-m-d"),time());
       //$default_stime=date("Y-m-d H:i:s",$default_stime);
       $default_etime = strtotime(date("Y-m-d"),time())+60*60*24;
       //$default_etime=date("Y-m-d H:i:s", $default_etime);

       if(!empty($_REQUEST['search_stime']))
       {
           $search_stime=strtotime($_REQUEST['search_stime']);
       }
       else
       {
           $search_stime=$default_stime;
       }
       $search_stime=date('Y-m-d H:i:s',$search_stime);
       if(!empty($_REQUEST['search_etime']))
       {
           $search_etime=strtotime($_REQUEST['search_etime']);
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
       //and TO_DAYS( created_time ) - TO_DAYS( jiandang_time ) >=0 不需要 实际不会有这种情况
       $arraywhere=" 1=1 and (TO_DAYS( created_time ) - TO_DAYS( jiandang_time ) <=".$num_day." ) 
	and oid_status='TRADE_FINISHED' and  (created_time >='".$search_stime."' and created_time <='".$search_etime."')";

       //修改
       if(!empty($_REQUEST['qudao']))
       {
           $arraywhere.=" and qudao like '%".trim($_REQUEST["qudao"])."%' ";
       }
       if(!empty($_REQUEST['dianpu']))
       {
           $arraywhere.=" and dianpu like '%".trim($_REQUEST["dianpu"])."%' ";
       }
       if(!empty($_REQUEST['cangwei']))//转化成ID
       {
           $cangwei=$warehouse->where("name like '%".trim($_REQUEST['cangwei'])."%'")->getfield('id');
           $arraywhere.=" and cangwei ='".$cangwei."' ";
       }
       if(!empty($_REQUEST['lururen']))//转化成ID
       {
           $lururen=$packuser->where("user_login like '%".trim($_REQUEST['lururen'])."%'")->getfield('id');
           $arraywhere.=" and lururen ='".$lururen."' ";
       }

       if(!empty($_REQUEST['gongyingshang']))
       {
           $arraywhere.=" and gongyingshang like '%".trim($_REQUEST["gongyingshang"])."%' ";
       }
       if(!empty($_REQUEST['title']))
       {
           $arraywhere.=" and pinlei like '%".trim($_REQUEST["title"])."%' ";
       }
       if(!empty($_REQUEST['sku']))
       {
           $arraywhere.=" and outer_sku_id like '%".trim($_REQUEST["sku"])."%' ";
       }
       if(!empty($_REQUEST['order_id']))
       {
           $arraywhere.=" and order_id like '%".trim($_REQUEST["order_id"])."%' ";
       }
       $list=$orders->where($arraywhere)->order('created_time asc')->select();
       $iTotalRecords = count($list);
       $iDisplayLength = intval($_REQUEST['length']);
       $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
       $iDisplayStart = intval($_REQUEST['start']);
       $sEcho = intval($_REQUEST['draw']);
       $records = array();
       $records["data"] = array();
       $end = $iDisplayStart + $iDisplayLength;
       $end = $end > $iTotalRecords ? $iTotalRecords : $end;
       for($i = $iDisplayStart; $i < $end; $i++)
       {


           $id = ($i + 1);

           /*
           if(!empty($list[$i]['lururen']))
           {
               $user_login=$packuser->where("id=".$list[$i]['lururen'])->getfield('user_login');
           }
           else
           {
               $user_login="无记录";
           }
           if(!empty($list[$i]['cangwei']))
           {
               $list[$i]['cangwei_name']=$warehouse->where("id=".$list[$i]['cangwei'])->getfield('name');
           }
           else
           {
               $list[$i]['cangwei_name']="无记录";
           }
           */
           $user_login=$packuser->where("id=".$list[$i]['lururen'])->getfield('user_login');
           //$pinlei=$sku->where("taoguanhao='".$list[$i]['outer_sku_id']."'")->getfield('pinlei');
           //$created_dt=$sku->where("taoguanhao='".$list[$i]['outer_sku_id']."'")->getfield('CREATED_DT');
           //$list[$i]['cangwei_name']=$warehouse->where("id=".$list[$i]['cangwei'])->getfield('name');
           $p=$list[$i]['payment']/$list[$i]['num'];
           $t=$p/$list[$i]['cost_price'];
           $t=sprintf("%.2f", $t);
           if($t>=$beishu)
           {
               $list[$i]['ticheng']=$dayu;

           }
           else
           {
               $list[$i]['ticheng']=$xiaoyu;

           }

           $records["data"][] = array(
               $id,
               $list[$i]['created_time'],
               $list[$i]['qudao'],
               $list[$i]['dianpu'],
               $list[$i]['cangwei_name'],
               $list[$i]['gongyingshang'],
               $list[$i]['pinlei'],
               $list[$i]['outer_sku_id'],
               $list[$i]['order_id'],
               $list[$i]['cost_price'],
               $list[$i]['num'],
               $list[$i]['payment'],
               $list[$i]['ticheng'],
               $list[$i]['jiandang_time'],
               $list[$i]['oid_status'],
               ''//<a href="javascript:;" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>
           );

       }

       if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action")
       {
           $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
           $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
       }

       $records["draw"] = $sEcho;
       $records["recordsTotal"] = $iTotalRecords;
       $records["recordsFiltered"] = $iTotalRecords;
       echo json_encode($records);
   }

    public function ajax_jx_get_kefu()
    {
        //写入数据表
        $qujian1=200;
        $qujian2=300;
        $qujian3=500;
        $jd_qujian1=5;
        $jd_qujian2=10;
        $jd_qujian3=15;
        $tm_qujian1=6;
        $tm_qujian2=8;
        $tm_qujian3=12;
        $tb_qujian1=4;
        $tb_qujian2=6;
        $tb_qujian3=8;
        //默认查询当天数据
        $default_stime=strtotime(date("Y-m-d"),time());
        //$default_stime=date("Y-m-d H:i:s",$default_stime);
        $default_etime = strtotime(date("Y-m-d"),time())+60*60*24;
        //$default_etime=date("Y-m-d H:i:s", $default_etime);

        if(!empty($_REQUEST['search_stime']))
        {
            $search_stime=strtotime($_REQUEST['search_stime']);
        }
        else
        {
            $search_stime=$default_stime;
        }
        $search_stime=date('Y-m-d H:i:s',$search_stime);
        if(!empty($_REQUEST['search_etime']))
        {
            $search_etime=strtotime($_REQUEST['search_etime']);
        }
        else
        {
            $search_etime=$default_etime;
        }
        $search_etime=date('Y-m-d H:i:s',$search_etime);
        $jixiao=M('jx_kefu');
        $packuser=D('PackUser');

        $arraywhere=" 1=1 and (luru_dt >='".$search_stime."' and luru_dt <='".$search_etime."')";

        //修改
        if(!empty($_REQUEST['qudao']))
        {
            $arraywhere.=" and qudao like '%".trim($_REQUEST["qudao"])."%' ";
        }
        if(!empty($_REQUEST['dianpu']))
        {
            $arraywhere.=" and dianpu like '%".trim($_REQUEST["dianpu"])."%' ";
        }
        if(!empty($_REQUEST['cangwei']))
        {
            $arraywhere.=" and cangwei_name like '%".trim($_REQUEST["cangwei"])."%' ";
        }
        if(!empty($_REQUEST['kefu']))//转化成ID
        {
            $lururen=$packuser->where("user_login like '%".trim($_REQUEST['kefu'])."%'")->getfield('id');
            $arraywhere.=" and luru_id ='".$lururen."' ";
        }

        if(!empty($_REQUEST['gongyingshang']))
        {
            $arraywhere.=" and gongyingshang like '%".trim($_REQUEST["gongyingshang"])."%' ";
        }
        if(!empty($_REQUEST['title']))
        {
            $arraywhere.=" and pinlei like '%".trim($_REQUEST["title"])."%' ";
        }
        if(!empty($_REQUEST['sku']))
        {
            $arraywhere.=" and sku like '%".trim($_REQUEST["sku"])."%' ";
        }
        if(!empty($_REQUEST['order_id']))
        {
            $arraywhere.=" and order_id like '%".trim($_REQUEST["order_id"])."%' ";
        }
        $list=$jixiao->where($arraywhere)->order('luru_dt asc')->select();
        //dump($jixiao->getLastSql());
        $iTotalRecords = count($list);
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        $records = array();
        $records["data"] = array();
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        for($i = $iDisplayStart; $i < $end; $i++)
        {


            $id = ($i + 1);
            $user_login=$packuser->where("id=".$list[$i]['luru_id'])->getfield('user_login');
            //计算提成
            $ticheng=$this->get_kefu_tc($list[$i]['pingtai_name'],$list[$i]['payment']);

            $records["data"][] = array(
                $id,
                $list[$i]['luru_dt'],
                $list[$i]['pingtai_name'],
                $list[$i]['dianpu'],
                $list[$i]['cangwei_name'],
                $list[$i]['gongyingshang'],
                $list[$i]['pinlei'],
                $list[$i]['sku'],
                $list[$i]['order_id'],
                $user_login,
                $list[$i]['payment'],
                $ticheng,
                $list[$i]['luru_dt'],

                ''//<a href="javascript:;" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>
            );

        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action")
        {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }
    public function get_kefu_tc($qudao,$payment)
    {
        $conf=M('config_jx_kefu');
        $list=$conf->where("qudao='".$qudao."'")->find();

        $ticheng=0;
        if($payment<$list['qujian1'])
        {
            $ticheng=$list['ticheng1'];

        }
        elseif ($payment>=$list['qujian1']&&$payment<=$list['qujian2'])
        {
            $ticheng=$list['ticheng2'];

        }
        elseif($payment>$list['qujian3'])
        {
            $ticheng=$list['ticheng3'];

        }

        return $ticheng;
    }
    public function test()
    {
        $res=$this->get_kefu_tc("天猫",180);
        dump($res);
    }
    public function test2()
    {

    }
//all end	
}
?>