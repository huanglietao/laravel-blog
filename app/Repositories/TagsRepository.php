<?php
namespace App\Repositories;

use App\Models\Tags;
use App\Models\Users;
use App\Services\Helper;
use App\User;

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
        $this->user = new User();
    }

    //获取页面信息数据
    public function getTag()
    {

        $list = collect($this->tags->get())->toArray();

        if (empty($list)){
            $this->tags->insert([
                [
                    'tag' => "humanyr",
                    'title' => "humanyr",
                    'subtitle' => "humanyr",
                    'page_image' => "humanyr",
                    'meta_description' => "humanyr",
                    'layout' => "humanyr",
                    'reverse_direction' => 1,
                ]
            ]);
            $list = collect($this->tags->get())->toArray();
        }
        return $list;
    }

    //注册会员
    public function memberRegister($data)
    {
        $ins_res = $this->tags->insert($data);
        var_dump($ins_res);
        die;

    }





}