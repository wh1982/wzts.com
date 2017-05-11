<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

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
    <!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo" >
                        <a href="index.html">
                            <img src="/Public/assets/layouts/layout/img/logo2.png" alt="logo" class="logo-default"  style="margin:0px;"/> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="/Public/assets/layouts/layout/img/avatar3_small.jpg" />
                                    <span class="username username-hide-on-mobile"> admin </span>
                            
                                </a>
                                
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href='<?php echo U("Login/login");?>' class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <!--  left_comm-->
        <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            <li class="sidebar-search-wrapper">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
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
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
    
           
							
				<!-- 循环start-->			
                            <li class="nav-item <?php echo ($left_f1); ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-bar-chart"></i>
                                    <span class="title">绩效数据</span>
                                    <span class="arrow <?php echo ($left_arrow1); ?> "></span>
                                </a>
                                <ul class="sub-menu"  style="display:<?php echo ($left_c1); ?>">
                                    <li class="nav-item <?php echo ($left_cc1); ?> ">
                                        <a href='<?php echo U("Jixiao/index");?>' class="nav-link ">
                                            <span class="title">产品部绩效</span>
												<span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item  <?php echo ($left_cc2); ?>">
                                        <a href='<?php echo U("Jixiao/shejibu");?>' class="nav-link ">
                                            <span class="title">设计部绩效</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  <?php echo ($left_cc3); ?>">
                                        <a href='<?php echo U("Jixiao/kefu");?>'class="nav-link ">
                                            <span class="title">客服部绩效</span>
                                        </a>
                                    </li>									                                   
                    
                                </ul>
                            </li>
                <!-- 循环end -->
                            
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
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN THEME PANEL -->

                <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.html">首页</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>绩效数据明细 </span>
                        </li>
                    </ul>

                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title" >绩效数据明细
                    <small></small>
                </h1>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN DASHBOARD STATS 1-->

                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->





                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Ajax Datatable</span>
                        </div>
                        <div class="actions">

                            <div class="btn-group">
                                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                    <i class="fa fa-share"></i>
                                    <span class="hidden-xs"> 导出</span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">导出到Excel </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container" >

                            <table width="100%" class="table table-striped table-bordered table-hover " id="datatable_ajax">
                                <thead>
                                <tr role="row" class="heading">
                                    <th> 序号&nbsp;# </th>
                                    <th width="200"> 时间 </th>
                                    <th>渠道</th>
                                    <th>店铺</th>
                                    <th>仓位</th>
                                    <th>供应商</th>
                                    <th>品类</th>
                                    <th>SKU</th>
                                    <th>订单号</th>
                                    <th>客服</th>
                                    <th>销售价(总)</th>
                                    <th>提成</th>
                                    <th>录入时间</th>
                                    <th>操作</th>
                                </tr>

                                <tr role="row" class="filter">
                                    <td></td>
                                    <td>
                                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                            <input name="search_stime" type="text" class="form-control form-filter input-sm" id="search_stime"  placeholder="From">
                                            <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>                                                                    </button>
                                                                </span>                                                            </div>
                                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                            <input name="search_etime" type="text" class="form-control form-filter input-sm" id="search_etime" placeholder="To">
                                            <span class="input-group-btn">
                                                                    <button class="btn btn-sm default" type="button">
                                                                        <i class="fa fa-calendar"></i>                                                                    </button>
                                                                </span>                                                            </div>                                                        </td>
                                    <td><input name="qudao" type="text" class="form-control  input-sm valid" id="qudao"></td>
                                    <td><input name="dianpu" type="text" class="form-control form-filter input-sm" id="dianpu"></td>
                                    <td><input name="cangwei" type="text" class="form-control form-filter input-sm" id="cangwei"></td>
                                    <td><input name="gongyingshang" type="text" class="form-control form-filter input-sm" id="gongyingshang"></td>
                                    <td>
                                        <input name="title" type="text" class="form-control form-filter input-sm" id="title"> </td>
                                    <td><input name="sku" type="text" class="form-control form-filter input-sm" id="sku"></td>
                                    <td><input name="order_id" type="text" class="form-control form-filter input-sm" id="order_id"></td>
                                    <td><input name="kefu" type="text" class="form-control form-filter input-sm" id="kefu"></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>

                                    <td>&nbsp;</td>

                                    <td>

                                        <div class="margin-bottom-5">
                                            <button class="btn btn-sm green btn-outline  margin-bottom filter-submit">
                                                <i class="fa fa-search"></i> Search</button>
                                        </div>
                                        <button class="btn btn-sm red btn-outline filter-cancel">
                                            <i class="fa fa-times"></i> Reset</button>                                                        </td>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        <a href="javascript:;" class="page-quick-sidebar-toggler">
            <i class="icon-login"></i>
        </a>

        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
                <div class="page-footer-inner"> 2017 &copy; Leabornes Technology Co., Ltd.
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
    <!-- END FOOTER -->
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

<script language="javascript">

    jQuery(document).ready(function() {
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
        //start

        var grid = new Datatable();
        grid.init({
            src: $("#datatable_ajax"),
            filterApplyAction: "filter-submit",
            filterCancelAction: "filter-cancel",
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },

            loadingMessage: 'Loading...',//assets/global/img/loading-spinner-grey.gif
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

                // save datatable state(pagination, sort, etc) in cookie.
                "bStateSave":false,
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "autoWidth": true,
                "searching":true,

                "serverSide": true,
                "processing": true,

                //"scrollX": true,
                //"scrollY": 400,
                "pageLength": 20, // default record count per page

                "ajax": {
                    url: '<?php echo U("Jixiao/ajax_jx_get_kefu");?>', // ajax source
                    type:"POST",
                    data:function(d){
                        d.search_stime=$("#search_stime").val();
                        d.search_etime=$("#search_etime").val();
                        d.qudao=$("#qudao").val();
                        d.dianpu=$("#dianpu").val();
                        d.cangwei=$("#cangwei").val();
                        d.gongyingshang=$("#gongyingshang").val();
                        d.title=$("#title").val();
                        d.sku=$("#sku").val();
                        d.order_id=$("#order_id").val();
                        d.kefu=$("#kefu").val();

                    }

                },

                "order": [
                    [1, "asc"]

                ]// set first column as a default sort by asc
                ,
                "columnDefs":[{
                    "orderable":false,//禁用排序
                    "targets":[0]//指定的列
                }],

            }
        });

        //end

    });

</script>
</body>
</html>