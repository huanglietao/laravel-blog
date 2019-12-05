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
class Tags extends Model
{
    //这里只负责定义表
    protected $table = 'tags';

    const UPDATED_AT = 'created_at';
    const CREATED_AT = 'updated_at';
    protected $dateFormat = 'U';

    protected $casts = [
        'created_at'   => 'date:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'tag', 'title', 'subtitle', 'page_image', 'meta_description','layout', 'reverse_direction'
    ];

}