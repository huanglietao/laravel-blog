<?php
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/11
 */
use App\Repositories\UsersRepository;
use App\Services\UsersService;

class LoginService
{
    public function __construct()
    {
        $this->re_user = new UsersRepository();
        $this->se_user = new UsersService();
    }

    //验证账号密码
    public function login($account,$password)
    {
        //获取该账户信息
        $where = [
            'account' => $account
        ];
        $user_info = $this->re_user->getUserInfo($where);
    }


}