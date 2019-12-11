<?php
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/7
 */
namespace App\Repositories;


use App\Models\Users;
use App\User;

//这里负责对数据库的数据提取
class UsersRepository extends BaseRepository
{

    protected $tags;

    public function __construct()
    {

        $this->user = new Users();
    }

    //注册会员
    public function memberRegister($data)
    {
        //新增会员
        $ins_res = $this->user->insertGetId($data);
        return $ins_res;

    }

    //获取会员信息
    public function getUserInfo($where=null, $order=null)
    {
        //获取会员信息
        $user_info = collect($this->user->where($where)->get())->toArray();

        return $user_info;
    }

    //修改用户信息
    public function updateUserInfo($id,$data)
    {
        //获取会员信息
        $user_info = $this->user->where(['id'=>$id])->update($data);

        return $user_info;
    }




}