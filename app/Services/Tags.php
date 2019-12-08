<?php
namespace App\Services;
/**
 * 测试逻辑层
 *
 */

use App\Repositories\TagsRepository;

class Tags
{
    protected $re_tags = null;

    public function __construct()
    {
        $re_tags = new TagsRepository();
        $this->re_tags = $re_tags;
    }

    //获取页面信息
    public function getTag()
    {

        //do something
        $data = $this->re_tags->getTag();

        $re_data = $data[0];
        return $re_data;
    }

    //注册会员
    public function memberRegister($data)
    {
        $res = $this->re_tags->memberRegister($data);
        return $res;
    }
}