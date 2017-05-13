<?php
namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->display();
    }
    /**
     * 登陆动作
     * @return [type] [description]
     */
    public function signin()
    {
        header("Content-Type:text/html; charset=utf-8");
        $Verify = new \Think\Verify();
        $captcha = I('post.code');
        if(!$Verify->check($captcha)){
            $this->error('验证码错误');
        }
        $name = I('post.name');
        //echo(I('post.password'));
        //echo('<br>');
        $password = md5(I('post.password'));
        //echo($password);
        //exit;
        $info = M('rbac_user')->where(array('name'=>$name))->find();
        if(empty($info)){
            $this->error('用户不存在');
        }
        if($info['password'] != $password){
            $this->error('用户名密码错误');
        }
        session('id',$info['id']);
        session('name',$info['name']);
        if($name == C('ADMIN_AUTH_KEY')){
            session(C('ADMIN_AUTH_KEY'),$name);
        }else{
            \Org\Util\Rbac::saveAccessList($info['id']);
        }
        $this->redirect('Home/Jixiao/index', '', 1, '页面跳转中...');
    }



    /**
     * 验证码
     * @return [type] [description]
     */
    public function captcha(){
        $config =    array(
            'length'      =>    4,     // 验证码位数
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    /**
     * 退出
     * @return [type] [description]
     */
    public function signout(){
        session_unset();
        session_destroy();
        $url = U('Home/Login/index');
        echo "<script type='text/javascript'>parent.location.href = '".$url."';</script>";
    }



//end	
}
?>