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

        var_dump($post);
        die;
        //注册会员
        $m_register = $this->se_user->memberRegister($post);


        if (isset($m_register['code'])&&$m_register['code']==0) {
            return back()->withErrors($m_register['msg']);
        } else{
            return view('suc',[
                'message'  => "注册成功",
                'jumpTime' => "3",
                'url'      => "/",
            ]);
        }
    }




    //登录验证
}