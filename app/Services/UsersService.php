<?php
namespace App\Services;
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/7
 */

use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

//这里负责业务逻辑处理

class UsersService
{

    public function __construct()
    {
        $re_user = new UsersRepository();
        $this->re_user = $re_user;
    }

    //注册会员
    public function memberRegister($data)
    {
        //去除会员数组中的token字段
        unset($data['_token']);
        //判断密码是否一致

        if($data['password']!=$data['repassword'])
        {
            $res['code'] = 0;
            $res['msg'] = trans("register.Two passwords are inconsistent");
            return $res;
        }
        //去除确认密码的字段
        unset($data['repassword']);
        //对密码进行加密
        $data['password'] = $this->passMd5($data['password']);
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $data['updated_at'] = date('Y-m-d H:i:s',time());
        //插入数据库
        $res = $this->re_user->memberRegister($data);
        if ($res){
            return $res;
        }else{
            $res['code'] = 0;
            $res['msg'] = trans("register.Register has failed");
            return $res;
        }

    }

    //修改用户信息
    public function updateUserInfo($data)
    {
        //去除会员数组中的token字段
        unset($data['_token']);

        //获取user_id
        $user_id = $data['user_id'];
        unset($data['user_id']);

        //判断此时的用户名有没有重复
        $old_user_info = $this->re_user->getUserInfo(['name' => $data['name']]);
        if ($old_user_info){
            if ($old_user_info[0]['id'] != $user_id){
                $return = [
                    'code' => 0,
                    'msg'  => "该用户名已存在"
                ];
                return $return;
            }
        }
        //修改会员信息
        $this->re_user->updateUserInfo($user_id,$data);

        $return = [
            'code' => 1,
            'msg'  => "ok"
        ];
        return $return;

    }

    //用户密码加密
    public function passMd5($password)
    {
        $password = md5($password);
        return $password;
    }

    //用户登录
    public function login($data)
    {
        //获取用户数据
        $userinfo =  $this->re_user->getUserInfo(['name' => $data['name']]);

        if (!empty($userinfo)){

            //验证密码
            if ($this->passMd5($data['password'])!=$userinfo[0]['password']){
                //密码错误
                $res=[
                    'code' => 0,
                    'msg'  => trans("login.The Password was wrong"),
                ];
                return $res;
            }
            //验证通过
            //将用户信息存入session
            session(['user_info' => $userinfo[0]]);
            //返回用户id
            $res = [
                'code'     => 1,
                'user_id'  => $userinfo[0]['id'],
                'msg'      => 'ok',
            ];
            return $res;
        }else{
            $res=[
                'code' => 0,
                'msg'  => trans("login.The Password was wrong"),
            ];
            return $res;
        }

    }


    //是否登录判断
    public function isLogin()
    {
        $is_login = session('user_info');

        if ($is_login){
            //已登录
            return true;
        }else{
            return false;
        }
    }

    //获取用户下级会员信息
    public function getChild($get)
    {
        $where = [];
        if (isset($get['search'])&&$get['search']['name'])
        {
            $where['name'] = $get['search']['name'];
        }
        //获取当前会员
        $user_arr = session('user_info');

        $user_id = $user_arr['id'];

        $where['pid'] = $user_id;

        //获取下级会员信息
        $user_info = $this->re_user->getChild($where,$get);

        return $user_info;

    }


}