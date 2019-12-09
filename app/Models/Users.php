<?php
/**
 * Created by PhpStorm.
 * Name: lietao<1013488674@qq.com>
 * Date: 2019/12/7
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//这里只负责定义表

class Users extends Model
{

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'message', 'phone'
    ];

}