<?php
namespace App\Services;
/**
 * 功能简介
 *
 * 功能详细说明
 * @author: yanxs <541139655@qq.com>
 * @version: 1.0
 * @date: 2019/8/8
 */
class Helper
{
    /**
     * 能用的随机数生成
     * @param string $type 类型 alpha/alnum/numeric/nozero/unique/md5/encrypt/sha1
     * @param int $len 长度
     * @return string
     */
    public static function build($type = 'alnum', $len = 8)
    {
        switch ($type)
        {
            case 'alpha':
            case 'alnum':
            case 'numeric':

            case 'nozero':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique':
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt':
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }

    /**
     * 生成签名
     * @param $params  生成签名的参数
     * @param string $secretKey 密钥
     * @return string
     */
    public static function getSign($params, $secretKey='')
    {
        $str = '';//待签名字符串
        //先将参数以其参数名的字典序升序进行排序
        ksort($params);
        //遍历排序后的参数数组中的每一个key/value对
        foreach($params as $k => $v){
            if ($v == '' || 'sign' == $k) {
                continue;
            }
            //为key/value对生成一个key=value格式的字符串，并拼接到待签名字符串后面
            $str .= "$k=$v";
        }
        //将签名密钥拼接到签名字符串最后面
        $str .= $secretKey;
        //通过md5算法为签名字符串生成一个md5签名，该签名就是我们要追加的sign参数值
        return md5($str);
    }

    /**
     * json正确返回
     * @param $params
     * @return string
     */
    public static function returnJsonSuccess($params)
    {
        $return['success'] = 'true';
        $return['result'] = $params;

        return $return;
    }

    /**
     * json错误返回
     * @param $params
     * @return string
     */
    public static function returnJsonFail($params)
    {
        $return['success'] = 'false';
        $return['err_code'] = isset($params['err_code']) ? $params['err_code']: '00001';
        $return['err_msg'] = isset($params['err_msg']) ? $params['err_msg']: __("common.sys_error");

        return $return;
    }
}