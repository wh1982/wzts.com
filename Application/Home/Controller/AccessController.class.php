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
        $user_id=I('get.user_id');
        $user=M('rbac_user');
        $role_user = M('rbac_role_user');
        $db=M();
        $db->startTrans();

        $res=$user->where(array("id"=>$user_id))->delete();
        $res2=$role_user->where(array("user_id"=>$user_id))->delete();
        if($res&&$res2)
        {
            $db->commit();
            $this->success("删除成功",U("Access/index"));
        }
        else
        {
            $db->rollback();
            $this->error("删除失败",U("Access/index"));
        }
        //dump($user_id);

    }
    public function role()
    {
        $this->assign('left_f0',"open");
        $this->assign('left_arrow0',"open");
        $this->assign('left_c0',"block");
        $this->assign('left_c0_l2',"open");
        $role=M('rbac_role');
        $list=$role->order('id asc')->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function role_edit()
    {

    }
    public function role_del()
    {
        $id=I("get.id");
        $role=M('rbac_role');
        $role_user=M('rbac_role_user');
        $db=M();
        $db->startTrans();
        $res1=$role->where(array("id"=>$id))->delete();
        $res2=$role_user->where(array("role_id"=>$id))->delete();
        if($res1&&$res2)
        {
            $db->commit();
            $this->success("删除成功",U("Access/role"));
        }
        else
        {
            $db->rollback();
            $this->error("删除失败",U("Access/role"));
        }


    }
    public function role_add()
    {
        $this->assign('left_f0',"open");
        $this->assign('left_arrow0',"open");
        $this->assign('left_c0',"block");
        $this->assign('left_c0_l2',"open");
        if(I("post.act")=='add')
        {
            $role=M('rbac_role');
            $role->create();
            $res=$role->add();
            if($res)
            {
                $this->success("创建成功",U("Access/role"));

            }
            else
            {
                $this->error("创建失败",U("Access/role"));
            }
            exit;

        }
        $this->display();
    }
    public function node()
    {
        $this->assign('left_f0',"open");
        $this->assign('left_arrow0',"open");
        $this->assign('left_c0',"block");
        $this->assign('left_c0_l3',"open");
        $data = M('rbac_node')->select();
        $list = category($data);
        //dump($list);
        $this->assign('list',$list);
        $this->display();

    }
    public function node_add()
    {
        if(I("post.act")=='add')
        {

            $data = array(
                'name'  => I('post.name',''),
                'title' => I('post.title',''),
                'level' => I('post.level',''),
                'pid'   => I('post.pid','')

            );
            $status = M('rbac_node')->add($data);
            //dump(M('node')->getlastsql());
            if($status)
            {
                $this->success('添加成功',U('Access/node'));
            }
            else
            {
                $this->error('添加失败');
            }
            exit;
        }
        $pid = I('get.pid','0');
        $level = I('get.level','1');
        switch ($level) {
            case '1':
                $view = '模块';
                break;
            case '2':
                $view = '控制器';
                break;
            case '3':
                $view = '方法';
                break;
            case '4':
                $view = '操作';
                break;
            default:
                $view = '模块';
                break;
        }
        $this->assign('view',$view);
        $this->assign('pid',$pid);
        $this->assign('level',$level);
        $this->display();
    }
//all end	
}
?>