<?php
namespace App\Repositories;

use App\Models\Tags;
use App\Services\Helper;

/**
 * 测试数据仓库
 *
 * 所有需要从数据库里获取的数据都通过这一层出来
 *
 * @author: hlt <1013488674@qq.com>
 * @version: 1.0
 * @date: 2019/12/5
 */
//这里负责对数据库的数据提取
class TagsRepository extends BaseRepository
{

    protected $tags;

    public function __construct()
    {

        $this->tags = new Tags();
    }

    /**
     * 获取tags模型的列表
     * @param mixed $where 查询条件
     * @param mixed $order 排序
     * @return array
     */
    public function getTag($where=null, $order=null)
    {

        $list = collect($this->tags->get())->toArray();
        return $list;
    }





}