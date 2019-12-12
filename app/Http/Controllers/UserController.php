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
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;
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

       //登录验证判断
        $is_login = $this->se_user->isLogin();
        if ($is_login){
            //获取会员信息
            $user_id_arr = session('user_info');
            $user_info =  $this->re_user->getUserInfo(['id' => $user_id_arr['id']]);
            //已登录
            return view("user.index", [
                'user_info' => $user_info[0],
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


        if ($request->route("is_master")){
            //属于主会员信息详情
            $is_master = 1;
        }else{
            $is_master = 0;
        }

        //获取用户信息
        $user_info = $this->re_user->getUserInfo(['id' => $get]);

        return view("user.edit", [
            'user_info' => $user_info,
            'is_master' => $is_master

        ]);



    }



    //修改用户信息（操作）
    public function userEdit(Request $request)
    {

       $post = $request->post();
            //手动验证
        $rules = [
            'name'=>'required'
        ];
        $messages = [
            'name.required'=>'请填写帐户名',
        ];

        $validator = Validator::make($post,$rules,$messages,[
            'name'=>'帐户名',
        ]);

        if ($validator->fails()) {
            $error_arr = json_decode($validator->errors(),true);
            $error = [];
            foreach ($error_arr as $k => $v)
            {
                foreach ($v as $kk=>$vv){
                    $error[] = $vv;
                }
            }
            $data = [
                'code' => 0,
                'error' => $error
            ];
            return $data;
        }

            //修改用户信息
            $res = $this->se_user->updateUserInfo($post);

            if ($res['code'] == 1){
                $data = [
                    'code' => 1,
                    'msg'  => 'ok',
                ];


                return $data;
            }else{
                $data = [
                    'code' => 0,
                    'error' => [$res['msg']]
                ];
                return $data;
            }




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

    //添加下级会员(界面)
    public function addUser()
    {
        //获取会员id
        $user_info = session('user_info');
        $user_id = $user_info['id'];


        return view("user.add", [
            'user_id' => $user_id,

        ]);
    }
    //添加下级会员（操作）
    public function add(Request $request)
    {
        $post = $request->post();

        //手动验证
        $rules = [
            'name'       => 'required|unique:users',
            'password'   => 'required',
            'repassword' => 'required',
        ];
        $messages = [
            'name.required'        => '请填写姓名',
            'password.required'    => '请填写密码',
            'repassword.required'  => '请确认密码',
            'name.unique'          => '该账号已存在',
        ];

        $validator = Validator::make($post,$rules,$messages,[
            'name'=>'帐户名',
        ]);

        if ($validator->fails()) {
            $error_arr = json_decode($validator->errors(),true);

            $error = [];
            foreach ($error_arr as $k => $v)
            {
                foreach ($v as $kk=>$vv){
                    $error[] = $vv;
                }
            }
            $data = [
                'code' => 0,
                'error' => $error
            ];
            return $data;
        }



        //注册会员
        $m_register = $this->se_user->memberRegister($post);

        if (isset($m_register['code'])&&$m_register['code']==0) {
            $data = [
                'code' => 0,
                'error' => [$m_register['msg']]
            ];
            return $data;
        } else{
            $data = [
                'code' => 1,
                'msg'  => 'ok',
            ];


            return $data;
        }
    }



}