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

    public function index()
    {
           return view('login.index');
    }

    public function login(LoginRequest $request,UsersService $user)
    {

        $post = $request->post();

        $res = $user->login($post);

        if ($res['code']==0){
            return back()->withErrors($res['msg']);
        }else{
            return redirect('/user/'.$res['user_id']);
        }


    }



}