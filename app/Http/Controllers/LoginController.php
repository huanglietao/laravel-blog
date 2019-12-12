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

//这里只负责数据的组织跟输出

class LoginController extends Controller
{
    public function __construct()
    {
        $this->re_user = new UsersRepository();
        $this->se_user = new UsersService();
    }

    public function index()
    {
        //登录验证判断
        $is_login = $this->se_user->isLogin();
        if ($is_login){
            //已登录
            $user_id_arr = session('user_info');
            $user_info =  $this->re_user->getUserInfo(['id' => $user_id_arr['id']]);
            return view("user.index", [
                'user_info' => $user_info[0],
            ]);
        }else{
            //未登录
            return view('login.index');
        }


    }

    public function login(LoginRequest $request,UsersService $user)
    {

        $post = $request->post();

        $res = $user->login($post);

        if ($res['code']==0){
            return back()->withErrors($res['msg']);
        }else{
            return redirect('/user');
        }
    }

    //退出登录
    public function loginOut(Request $request)
    {
        if (session('user_info')) {
            $request->session()->forget('user_info');
        }
        return redirect('/');
    }



}