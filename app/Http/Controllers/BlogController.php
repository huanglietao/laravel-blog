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


        $tagService = new Tags();

        //获取页面设置信息
        $data = $tagService->getTag();


        return view("welcome", $data);
    }

    //注册会员
    public function sendContactInfo(Request $request)
    {

        $tagService = new Tags();
        $post = $request->post();

        //注册会员
        $m_register = $tagService->register($post);

        var_dump($post);
        die;


    }
}