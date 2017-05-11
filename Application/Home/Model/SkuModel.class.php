<?php
namespace Home\Model;
use Think\Model;
class SkuModel extends Model{
    //或者使用字符串定义
    protected $connection = array(
        'db_type'  => 'mysql',
        'db_user'  => 'pack_test',
        'db_pwd'   => 'Packtest123',
        'db_host'  => 'rm-bp18q40nhutq5ul51.mysql.rds.aliyuncs.com',
        'db_port'  => '3306',
        'db_name'  => 'pack_db_test3',
        'db_charset' =>'utf8',
    );
    protected $tablePrefix = "lbpa_";


    protected $_validate=array(

        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        /*
        验证条件 （可选）
        self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
        self::MUST_VALIDATE 或者1 必须验证
        self::VALUE_VALIDATE或者2 值不为空的时候验证
        附加规则 （可选）
        function 	函数验证，定义的验证规则是一个函数名
        confirm 	验证表单中的两个字段是否相同，定义的验证规则是一个字段名
        unique 	验证是否唯一，系统会根据字段目前的值查询数据库来判断是否存在相同的值，当表单数据中包含主键字段时unique不可用于判断主键字段本身
        验证时间
        self::MODEL_INSERT或者1新增数据时候验证
        self::MODEL_UPDATE或者2编辑数据时候验证
        self::MODEL_BOTH或者3全部情况下验证（默认）
        */
        /*
        //array('cname','require','用户名必填写',1),
        //array('cname','','用户已存在',0,'unique','add'),
        //array('email','email','邮箱格式不正确',2),
        array('cname','require','用户名必须',1,'',3),
        array('cname','','用户已存在',1,'unique',3),
        array('old_pw','old_pw2','请输入正确的旧密码',1,'confirm',3),
        array('cpw','require','密码必须',1,'',3),
        array('cpw2','require','密码必须',1,'',3),
        array('cpw','cpw2','密码不一致',1,'confirm',3),
        */


    );
    protected $_auto= array(
        // array(完成字段1,完成规则,[完成时间,附加规则])
        /*
        完成时间
        self::MODEL_INSERT或者1 	新增数据的时候处理（默认）
        self::MODEL_UPDATE或者2 	更新数据的时候处理
        self::MODEL_BOTH或者3 	所有情况都进行处理
        附加规则
        function 	使用函数，表示填充的内容是一个函数名
        callback 	回调方法 ，表示填充的内容是一个当前模型的方法
        field 	用其它字段填充，表示填充的内容是一个其他字段的值
        string 	字符串（默认方式）
        ignore 	为空则忽略（3.1.2新增）
        */
        /*
        array('addtime','time',self::MODEL_INSERT,'function'),
        array('path','info_cat_add',self::MODEL_INSERT,'callback'),
        */
    );
    function info_cat_add()
    {
        $belong=isset($_REQUEST['belong'])?(int)$_REQUEST['belong']:0;
        if($belong>0)
        {
            $list=$this->where('id='.$belong)->find();
            $data=$list['path'].$list['id'].",";
        }
        else
        {
            $data=",0,";
        }
        return $data;
    }
}
?>