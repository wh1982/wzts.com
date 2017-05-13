<?php
namespace Home\Controller;
class AccessController extends BaseController
{
    public function index()
    {
        $this->assign('left_f0',"open");
        $this->assign('left_arrow0',"open");
        $this->assign('left_c0',"block");
        $this->assign('left_c0_l1',"open");

        $list = M('rbac_user')->field('a.*,b.role_id')->join('as a left join lb_rbac_role_user as b on a.id = b.user_id')->select();
        foreach ($list as $key => &$value) {
            $value['role_name'] = M('rbac_role')->where(array('id'=>$value['role_id']))->getField('name');
        }
        $this->assign('list',$list);
        //dump($list);
        //exit;
        $this->display();
    }
    public function user_edit()
    {
        if(I('post.act')=='edit')
        {
            $user_id = I('post.user_id');
            $role_id = I('post.role_id');

            $role_user = M('rbac_role_user');
            $user = M('rbac_user');
            //删除role_user中user_id 相关信息 再写入 最后更新user表

            $db=M();
            $db->startTrans();



            $res1 = 1;
            $res2 = 1;
            $res3 = 1;
            $count = $role_user->where(array('user_id' => $user_id))->count();
            if ($count > 0)
            {
                $res1 = $role_user->where(array('user_id' => $user_id))->delete();
            }

            $role_user->user_id = $user_id;
            $role_user->role_id = $role_id;
            $res2 = $role_user->add();

            $password = I('post.password');
            if (!empty($password))
            {
                $user->password = md5(I("post.password"));
                $res3 = $user->where("id=" . $user_id)->save();
            }


            if($res1&&$res2&&$res3)
            {
                $db->commit();
                $this->success("修改成功",U("Access/index"));
            }
            else
            {
                $db->rollback();

            }
            exit;
        }
        $this->assign('left_f0',"open");
        $this->assign('left_arrow0',"open");
        $this->assign('left_c0',"block");
        $this->assign('left_c0_l1',"open");
        $user_id=I("get.user_id");
        $role_id=I("get.role_id");
        $this->assign('role_id',$role_id);
        $role=M('rbac_role');
        $user=M('rbac_user');
        $user_info=$user->find($user_id);
        $role_list=$role->select();
        $this->assign('user_info',$user_info);
        $this->assign('role_list',$role_list);
        $this->display();



    }
    public function user_add()
    {
        if(I('post.act')=='add')
        {
            $name = I('post.name');
            $password = I('post.password');
            $role_id = I('post.role_id');
            $role_user = M('rbac_role_user');
            $user = M('rbac_user');
            $db=M();
            $db->startTrans();

            $user->name=$name;
            $user->password = md5($password);
            $user->register_time=time();
            $res1 = $user->add();

            $role_user->user_id = $res1;
            $role_user->role_id = $role_id;
            $res2 = $role_user->add();

            if($res1&&$res2)
            {
                $db->commit();
                $this->success("创建成功",U("Access/index"));
            }
            else
            {
                $db->rollback();

            }
            exit;
        }
        $this->assign('left_f0',"open");
        $this->assign('left_arrow0',"open");
        $this->assign('left_c0',"block");
        $this->assign('left_c0_l1',"open");
        $role=M('rbac_role');
        $role_list=$role->select();
        $this->assign('role_list',$role_list);
        $this->display();
    }
    public function user_del()
    {

    }
    public function node()
    {

    }
//all end	
}
?>