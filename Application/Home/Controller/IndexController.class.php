<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller
{
   public function index()
   {    
     header('Location: '.U("Login/index").'');
   }
  
//end	
}
?>