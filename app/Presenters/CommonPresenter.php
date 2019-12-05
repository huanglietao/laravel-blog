<?php
namespace App\Presenters;
/**
 * 公共模板状态处理类
 *
 * 处理view层相应转换逻辑
 * @author: yanxs <541139655@qq.com>
 * @version: 1.0
 * @date: 2019/8/14
 */
class CommonPresenter
{
    /**
     * 获取是与否的值
     * @param int $status 状态值 0否 1是
     * @return string
     */
    public function getYesOrNo($status)
    {
        $text = !empty($status) ? __("common.yes") : __("common.no");
        return $text;
    }

    /**
     * 获取 正常 或 隐藏状态
     * @param string $string 状态值 hidden隐藏 normal正常
     * @return string
     */
    public function getNormalOrHidden($string)
    {
        if ($string == "normal") {
            return __("common.normal");
        } elseif($string == "hidden") {
            return __("common.hidden");
        }

        return __("common.normal");
    }
}