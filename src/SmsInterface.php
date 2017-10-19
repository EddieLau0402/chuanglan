<?php
/**
 * Created by PhpStorm.
 * User: eddie
 * Date: 2017/10/19
 * Time: 下午2:56
 */

namespace Eddie\Chuanglan;


interface SmsInterface
{
    /**
     * 发送短信方法
     *
     * @author Eddie
     *
     * @return mixed
     */
    public function send($mobile, $message, $option = []);

    /**
     * 格式化返回结果;
     * 若集成多个发送短信平台, 所有结果应该返回标准格式
     *
     * @author Eddie
     *
     * @param $data
     * @return mixed
     */
    public function transform($data);
}