<?php

namespace App\Http\Controllers;


use App\Services\Tags;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        //这里只负责数据的组织与输出
        $tagService = new Tags();


        $data = $tagService->getTag();

        return view("welcome", $data);
    }

    public function showForm(){

    }

    public function sendContactInfo(){

    }
}