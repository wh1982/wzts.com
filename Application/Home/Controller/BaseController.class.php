<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller
{

    Public function _initialize()
    {
        if (!isset($_SESSION['id']))
        {
            $this->error('请重新登录', U('Home/Login/index'));
        }
        $access = \Org\Util\Rbac::AccessDecision();
        //dump($access);
        if(!$access)
        {
            $this->error('你没有权限');
        }
        $login_name=session('name');
        $this->assign('login_name',$login_name);
        $home=U("Jixiao/index");
        $this->assign('home',$home);
    }
//end
}
?>