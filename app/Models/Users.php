<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * 功能简介
 *
 * 功能详细说明
 * @author: yanxs <541139655@qq.com>
 * @version: 1.0
 * @date: 2019/8/1
 */
class Users extends Model
{
    //这里只负责定义表
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'description', 'password', 'phone'
    ];

}