<?php

namespace Eddie\Chuanglan;


trait helper
{
    /**
     * 通过CURL发送post HTTP请求
     *
     * @author Eddie
     *
     * @param $url
     * @param $params
     * @param array $header
     * @return bool|mixed
     */
    protected static function curlPost($url, $params, $header = [])
    {
        return self::curlRequest($url, $params, 'post', $header);
    }

    /**
     * 通过CURL发送HTTP请求
     *
     * @author Eddie
     *
     * @param $url
     * @param $params
     * @param string $method
     * @param array $header
     * @return bool|mixed
     */
    protected static function curlRequest($url, $params = [], $method = 'post', $header = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        if (strtolower($method) == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            $header = array_merge($header, ['Content-Type: application/json; charset=utf-8']);
        } else {
            $url .= (stristr($url, '?') ? '&' : '?') . http_build_query($params);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        try {
            $result = curl_exec($ch);
        } catch (\Exception $e) {
            $result = false;
        }
        curl_close($ch);

        return $result;
    }
}