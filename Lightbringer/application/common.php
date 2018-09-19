<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 *
 * @param string $url get请求地址
 * @param int $httpCode 返回状态码
 * @return mixed
 */
function getCurl($url, &$httpCode = 0)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 不做证书校验
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function getRandChar($length)
{
    $randChar = '';
    $charSet = 'abcdefghijklmniopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < $length; $i++) {
        $randChar .= $charSet[mt_rand(0, strlen($charSet) - 1)];
    }
    return $randChar;
}