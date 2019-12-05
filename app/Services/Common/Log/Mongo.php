<?php
/**
 * mongodb记录日志
 *
 * 功能详细说明
 * @author: yanxs <541139655@qq.com>
 * @version: 1.0
 * @date: 2019/8/22
 */

namespace App\Services\Common\Log;


class Mongo implements LogInterface
{
    protected $table = 'ty_logs';

    /**
     * 记录日志到Mongodb数据库
     * @param $data
     */
    public function record($data)
    {
        // TODO: Implement record() method.
        $connection = app(\App\Services\Common\Mongo::class)->connectionMongodb($this->table);
        $connection->insert($data);
    }
}