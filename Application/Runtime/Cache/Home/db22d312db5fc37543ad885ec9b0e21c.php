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

<link href="/Public/assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo" >
                        <a href='?'>
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
                                    <!--<img alt="" class="img-circle" src="/Public/assets/layouts/layout/img/avatar3_small.jpg" />-->
                                    <span class="username username-hide-on-mobile"><?php echo ($login_name); ?> </span>
                            
                                </a>
                                
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href='<?php echo U("Login/signout");?>' class="dropdown-toggle">
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
                            <!- 用户权限管理-->
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
							
				<!-- 循环start-->			
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
                            <a href="###">权限配置</a>

                        </li>

                    </ul>

                </div>


                <h1 class="page-title" >权限配置
                    <small>




                    </small>
                </h1>

                <div class="clearfix"></div>
                <!-- table  -->



                <form action="" method="post" id="form1" name="form1">

                    <div id="configTree" ></div>
                    <br>
                    <div>
                        渠道
                        <select name="qudao[]" size="6" multiple="multiple">
                            <?php if(is_array($qudao_list)): $i = 0; $__LIST__ = $qudao_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["title"]); ?>" <?php echo ($vo["s"]); ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        店铺
                        <select name="dianpu[]" size="6" multiple="multiple">
                            <?php if(is_array($dianpu_list)): $i = 0; $__LIST__ = $dianpu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["title"]); ?>" <?php echo ($vo["s"]); ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        仓位
                        <select name="cangwei[]" size="6" multiple="multiple">
                            <?php if(is_array($warehouse_list)): $i = 0; $__LIST__ = $warehouse_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php echo ($vo["s"]); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <br>
                    <input type="button" name="Submit" value="提交" class="btn green" onclick="getMenuIds()"/>
                    <input type="hidden" name="id" value="<?php echo ($id); ?>">
                    <input type="hidden" name="ids" value="" id="ids">
                    <input type="hidden" name="act" value="edit">
                    <div id="test"></div>
                </form>


                <!-- table end -->





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
<script src="/Public/assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/Public/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/Public/js/CheckboxTree.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/Public/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="/Public/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="/Public/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/Public/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script language="javascript">
    jQuery(document).ready(function()
    {
        var treeid = "configTree";
        var menuid=[<?php echo ($ids); ?>];
        showCheckboxTree("<?php echo U('Access/get_tree_menu');?>",treeid,menuid);
    });
    function getMenuIds()
    {

        //取得所有选中的节点，返回节点对象的集合
        var ids="";
        var nodes=$("#configTree").jstree().get_checked(); //使用get_checked方法
        //var nodes2=$("#configTree").jstree("get_all_checked"); //使用get_checked方法
        $('#ids').val(nodes);
        $("#form1").submit();

        //alert(nodes);
        //alert(JSON.stringify(nodes));

        //document.write(JSON.stringify(nodes));
    }


</script>
</body>
</html>