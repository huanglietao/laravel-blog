<?php

namespace App\Http\Controllers;


use App\Services\Tags;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Http\Requests\ContactMeRequest;
use Illuminate\Support\Facades\Mail;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        //这里只负责数据的组织与输出
        $tagService = new Tags();


        $data = $tagService->getTag();

        return view("welcome", $data);
    }

    public function sendContactInfo(Request $request){

        $post = $request->post();



        if (isset($post['mail'])){
            $res = Mail::to($post['email'])->queue(new ContactMail($post));
            var_dump($res);
        }else{
            $post['name'] = "humanyr";
            $post['title'] = "测试邮件";
            $post['phone'] = "13265961649";

            $res = Mail::to('1013488674@qq.com')->queue(new ContactMail($post));
            var_dump($res);
        }

        die;
        $data = $c_request->only('name', 'email', 'phone');
        var_dump($data);
        die;
        $data['messageLines'] = explode("\n", $request->get('message'));
        var_dump($data);
        die;
    }
}