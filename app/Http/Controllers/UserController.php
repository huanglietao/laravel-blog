<?php
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/11
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Repositories\UsersRepository;
use App\Services\UsersService;
use App\Http\Requests\UserRequest;

//这里只负责数据的组织跟输出

class UserController extends Controller
{

    public function __construct()
    {
        $this->re_user = new UsersRepository();
        $this->se_user = new UsersService();
    }

    //会员信息页面
    public function index(Request $request)
    {
        $user_info = session('user_info');

       //登录验证判断
        $is_login = $this->se_user->isLogin();
        if ($is_login){
            //已登录
            return view("user.index", [
                'user_info' => session('user_info'),
            ]);
        }else{
            //未登录
            return redirect('/');
        }

    }

    //用户信息界面（编辑界面）
    public function detail(Request $request)
    {
        $get = $request->route("user_id");

        //获取用户信息
        $user_info = $this->re_user->getUserInfo(['id' => $get]);

        return view("user.edit", [
            'user_info' => $user_info,
        ]);



    }



    //修改用户信息（操作）
    public function userEdit(UserRequest $request)
    {

        $post = $request->post();


        //修改用户信息
        $this->se_user->updateUserInfo($post);

        $data = [
            'code' => 1,
            'msg'  => 'ok',
        ];
        return $data;
    }

    //获取用户下级会员信息
    public function getChild(Request $request)
    {
        $get = $request->query();

        //获取会员信息
        $user_info = $this->se_user->getChild($get);

        $data = [
            'code' => 0,
            'data' => $user_info,
        ];
        return $data;

    }

    //删除用户信息
    public function userDel(Request $request)
    {
        $post = $request->post();
        $this->re_user->delUser($post['ids']);
        $data = [
            'code' => 1,
            'msg'  => 'ok'
        ];
        return $data;
    }






}