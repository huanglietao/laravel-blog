<?php
namespace App\Services;
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/7
 */

use App\Repositories\UsersRepository;

//这里负责业务逻辑处理

class UsersService
{
    protected $re_tags = null;

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
        //添加会员

        $res = $this->re_user->memberRegister($data);
        return $res;
    }

    //修改用户信息
    public function updateUserInfo($data)
    {
        //去除会员数组中的token字段
        unset($data['_token']);

        //获取user_id
        $user_id = $data['user_id'];
        unset($data['user_id']);
        //修改会员信息
        $res = $this->re_user->updateUserInfo($user_id,$data);
        return $res;
    }
}