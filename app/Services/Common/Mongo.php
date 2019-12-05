<?php
namespace App\Services\Common;

use DB;
/**
 * mongodb类
 *
 * mongodb初始化及连接
 * @author: yanxs <541139655@qq.com>
 * @version: 1.0
 * @date: 2019/9/3
 */
class Mongo
{
    /**
     *
     * @param $tables collection集合
     * @return mixed
     */
    public function connectionMongodb($tables)
    {
        return $users = DB::connection('mongodb')->collection($tables);
    }
}