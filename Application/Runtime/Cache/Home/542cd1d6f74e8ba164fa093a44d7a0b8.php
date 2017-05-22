<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>leabornes</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/Public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/Public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/Public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/Public/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/Public/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/Public/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <div class="page-logo" >
                <a href='?'>
                    <img src="/Public/assets/layouts/layout/img/logo2.png" alt="logo" class="logo-default"  style="margin:0px;"/> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-hide-on-mobile"><?php echo ($login_name); ?> </span>
                        </a>
                    </li>
                    <li class="dropdown dropdown-quick-sidebar-toggler">
                        <a href='<?php echo U("Login/signout");?>' class="dropdown-toggle">
                            <i class="icon-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="clearfix"> </div>
    <div class="page-container">

        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <li class="sidebar-search-wrapper">
                        <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                            <a href="javascript:;" class="remove">
                                <i class="icon-close"></i>
                            </a>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                            </div>
                        </form>
                    </li>
                    
    <!-- 用户权限管理-->
<li class="nav-item <?php echo ($left_f0); ?>">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-user"></i>
        <span class="title">用户管理</span>
        <span class="arrow <?php echo ($left_arrow0); ?> "></span>
    </a>
    <ul class="sub-menu"  style="display: <?php echo ($left_c0); ?>">
        <li class="nav-item <?php echo ($left_c0_l1); ?> ">
            <a href='<?php echo U("Access/index");?>' class="nav-link ">
                <span class="title">用户列表</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item  <?php echo ($left_c0_l2); ?>">
            <a href='<?php echo U("Access/role");?>' class="nav-link ">
                <span class="title">角色列表</span>
            </a>
        </li>
        <li class="nav-item  <?php echo ($left_c0_l3); ?>">
            <a href='<?php echo U("Access/node");?>' class="nav-link ">
                <span class="title">节点列表</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-item <?php echo ($left_f1); ?>">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-bar-chart"></i>
        <span class="title">绩效数据</span>
        <span class="arrow <?php echo ($left_arrow1); ?> "></span>
    </a>
    <ul class="sub-menu"  style="display: <?php echo ($left_c1); ?>">
        <li class="nav-item <?php echo ($left_c1_l1); ?> ">
            <a href='<?php echo U("Jixiao/index");?>' class="nav-link ">
                <span class="title">产品部绩效</span>
                <span class="selected"></span>
            </a>
        </li>
        <li class="nav-item  <?php echo ($left_c1_l2); ?>">
            <a href='<?php echo U("Jixiao/shejibu");?>' class="nav-link ">
                <span class="title">设计部绩效</span>
            </a>
        </li>
        <li class="nav-item  <?php echo ($left_c1_l3); ?>">
            <a href='<?php echo U("Jixiao/kefu");?>' class="nav-link ">
                <span class="title">客服部绩效</span>
            </a>
        </li>

    </ul>
</li>
<!--
           <li class="nav-item ">
               <a href="javascript:;" class="nav-link nav-toggle">
                   <i class="icon-bulb"></i>
                   <span class="title">售后退换货</span>
                   <span class="arrow"></span>
               </a>
               <ul class="sub-menu" >
                   <li class="nav-item  ">
                       <a href="cs_index.html" class="nav-link ">
                           <span class="title">明细</span>
                       </a>
                   </li>
                     <li class="nav-item  ">
                       <a href="cs_th.html" class="nav-link ">
                           <span class="title">退货率Top 10</span>
                       </a>
                   </li>

                   <li class="nav-item  ">
                       <a href="cs_hh.html" class="nav-link ">
                           <span class="title">换货率Top 10</span>
                       </a>
                   </li>
                         <li class="nav-item  ">
                       <a href="cs_fx.html" class="nav-link ">
                           <span class="title">好评返现</span>
                       </a>
                   </li>

                                                       <li class="nav-item  ">
                       <a href="cs_cp.html" class="nav-link ">
                           <span class="title">差评率</span>
                       </a>
                   </li>
               </ul>
           </li>


           <li class="nav-item ">
               <a href="javascript:;" class="nav-link nav-toggle">
                   <i class="icon-diamond"></i>
                   <span class="title">销售数据</span>
                   <span class="arrow  "></span>
               </a>
               <ul class="sub-menu" >
                   <li class="nav-item  ">
                       <a href="sale.html" class="nav-link ">
                           <span class="title">明细</span>

                       </a>
                   </li>
                    <li class="nav-item  ">
                       <a href="sale_profit.html" class="nav-link ">
                           <span class="title">盈利Top 10</span>
                       </a>
                   </li>
                    <li class="nav-item  ">
                       <a href="sale_loss.html" class="nav-link ">
                           <span class="title">亏损Top 10</span>
                       </a>
                   </li>


               </ul>
           </li>




           <li class="nav-item  ">
               <a href="javascript:;" class="nav-link nav-toggle">
                   <i class="icon-social-dribbble"></i>
                   <span class="title">物流未发货</span>
                   <span class="arrow "></span>
               </a>
               <ul class="sub-menu" >
                   <li class="nav-item  ">
                       <a href="wuliu_wfh.html" class="nav-link ">
                           <span class="title">当日22点未发货</span>
                       </a>
                   </li>
                   <li class="nav-item  ">
                       <a href="wuliu_qh.html" class="nav-link ">
                           <span class="title">缺货数据</span>
                       </a>
                   </li>

               </ul>
           </li>



           <li class="nav-item  ">
               <a href="javascript:;" class="nav-link nav-toggle">
                   <i class="icon-briefcase"></i>
                   <span class="title">产品周转备货</span>
                   <span class="arrow"></span>
               </a>
               <ul class="sub-menu" >
                   <li class="nav-item  ">
                       <a href="cpzzbh.html" class="nav-link ">
                           <span class="title">明细</span>
                       </a>
                   </li>
                      <li class="nav-item  ">
                       <a href="cpzzbh_chart.html" class="nav-link ">
                           <span class="title">图表</span>
                       </a>
                   </li>

               </ul>
           </li>

           <li class="nav-item  ">
               <a href="javascript:;" class="nav-link nav-toggle">
                   <i class="icon-feed"></i>
                   <span class="title">排名流量监控</span>
                   <span class="arrow"></span>
               </a>
               <ul class="sub-menu" >
                   <li class="nav-item  ">
                       <a href="pro_kwd.html" class="nav-link ">
                           <span class="title">产品关键字查询修改</span>
                       </a>
                   </li>
                   <li class="nav-item  ">
                       <a href="pro_uv.html" class="nav-link ">
                           <span class="title">UV排名数据</span>
                       </a>
                   </li>
                   <li class="nav-item">
                        <a href="pro_chart.html" class="nav-link ">
                           <span class="title">数据报表(关键词下单量)</span>
                       </a>
                   </li>

                        <li class="nav-item">
                        <a href="pro_chart2.html" class="nav-link ">
                           <span class="title">数据报表(盈亏)</span>
                       </a>
                   </li>
               </ul>
           </li>

           <li class="nav-item  ">
               <a href="javascript:;" class="nav-link nav-toggle">
                   <i class="icon-basket"></i>
                   <span class="title">供应商</span>
                   <span class="arrow"></span>
               </a>
               <ul class="sub-menu" >
                   <li class="nav-item  ">
                       <a href="supplier_pro.html" class="nav-link ">
                           <span class="title">品类</span>
                       </a>
                   </li>
                   <li class="nav-item  ">
                       <a href="supplier_qh.html" class="nav-link ">
                           <span class="title">缺货次数</span>
                       </a>
                   </li>
                     <li class="nav-item  ">
                       <a href="supplier_wfh.html" class="nav-link ">
                           <span class="title">今日未发货</span>
                       </a>
                   </li>
                                                       <li class="nav-item  ">
                       <a href="supplier_sh.html" class="nav-link ">
                           <span class="title">售后率</span>
                       </a>
                   </li>
                                                       <li class="nav-item  ">
                       <a href="supplier_cp.html" class="nav-link ">
                           <span class="title">产品差评</span>
                       </a>
                   </li>
                                                       <li class="nav-item  ">
                       <a href="supplier_xssh.html" class="nav-link ">
                           <span class="title">销售售后</span>
                       </a>
                   </li>

               </ul>
           </li>
          -->



                </ul>
            </div>
        </div>


        
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="<?php echo ($home); ?>">首页</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href='<?php echo U("Access/index");?>'>用户管理</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="###">用户修改</a>

                    </li>

                </ul>

            </div>


            <h1 class="page-title" >用户修改
                <small></small>
            </h1>

            <div class="clearfix"></div>
            <!-- table  -->



            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="/index.php/Home/Access/user_edit" id="form_sample_1" class="form-horizontal" method="post">
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">用户名
                                <span class="required"> </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name"  class="form-control" value="<?php echo ($user_info["name"]); ?>" readonly="readonly"/> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">密码
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-4">
                                <input name="password" type="text" class="form-control" /> </div>
                        </div>



                        <div class="form-group">
                            <label class="control-label col-md-3">角色
                                <span class="required">  </span>
                            </label>
                            <div class="col-md-4">
                                <select class="form-control" name="role_id">
                                    <option value="">请选择</option>
                                    <?php if(is_array($role_list)): $i = 0; $__LIST__ = $role_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($role_id) == $vo['id']): ?>selected<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <button type="button" class="btn grey-salsa btn-outline">Cancel</button>
                                <input type="hidden" name="user_id" value="<?php echo ($user_info['id']); ?>">
                                <input type="hidden" name="act" value="edit">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>






            <!-- table end -->





        </div>
        <!-- END CONTENT BODY -->
    </div>

        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>
    </div>

    
        <div class="page-footer">
            <div class="page-footer-inner"> 2017 &copy; Leabornes Technology Co., Ltd.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
    

</div>
<!--[if lt IE 9]>
<script src="/Public/assets/global/plugins/respond.min.js"></script>
<script src="/Public/assets/global/plugins/excanvas.min.js"></script>
<script src="/Public/assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/Public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/Public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/Public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

    <script src="/Public/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/Public/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/Public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="/Public/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/Public/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="/Public/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="/Public/assets/global/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->


<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Public/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Public/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>
</html>