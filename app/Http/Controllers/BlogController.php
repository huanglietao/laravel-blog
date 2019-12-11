<?php
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/7
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UsersRepository;
use App\Services\UsersService;

//这里只负责数据的组织跟输出

class BlogController extends Controller
{

    public function __construct()
    {
        $this->re_user = new UsersRepository();
        $this->se_user = new UsersService();
    }

    public function index(Request $request)
    {

        return view("register");
    }

    //注册会员
    public function Register(RegisterRequest $request)
    {
        $post = $request->post();


        //注册会员
        $m_register = $this->se_user->memberRegister($post);

        if (isset($m_register['code'])&&$m_register['code']==0) {
            return back()->withErrors($m_register['msg']);
        } else{
            return redirect('/user/'.$m_register);
        }
    }

    //会员信息页面
    public function user(Request $request)
    {
        $user_id = $request->route('user_id');

        $where = [
            'id' => $user_id,
        ];
        //获取该用户的信息
        $user_info = $this->re_user->getUserInfo($where);

        return view("user", [
            'user_info' => $user_info,
        ]);
    }

    //修改用户信息
    public function userEdit(Request $request)
    {
        $post = $request->post();

        //修改用户信息
        $this->se_user->updateUserInfo($post);

        return view('suc',[
            'message'  => "修改成功",
            'jumpTime' => "3",
            'url'      => "user/".$post['user_id'],
        ]);
    }


    //登录验证
}