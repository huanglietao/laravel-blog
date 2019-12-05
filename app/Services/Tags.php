<?php
namespace App\Services;
/**
 * 测试逻辑层
 *
 */

use App\Repositories\TagsRepository;

class Tags
{
    //这里只负责数据的逻辑处理
    protected $re_tags = null;

    public function __construct()
    {
        $re_tags = new TagsRepository();
        $this->re_tags = $re_tags;
    }

    public function getTag()
    {

        //do something

        $data = $this->re_tags->getTag();

        $re_data = $data[0];
        return $re_data;
    }
}