<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{
   public function index()
   {
      
   }
   public function login()
   {
     if(I("get.act")=='check')
	 {
		 $this->success('登陆成功',U("Jixiao/index"),5);
		 exit;
	 }
     $this->display();
   }
   public function checklogin()
   {
   }

//end	
}
?>