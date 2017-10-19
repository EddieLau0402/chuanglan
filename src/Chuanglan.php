<?php


namespace Eddie\Chuanglan;


class Chuanglan implements SmsInterface
{
    use helper;


    ### 创蓝发送短信接口URL : http://vsms.253.com/msg/send/json
    const SERVICE_SEND_SMS = '/send/json';

    ### 创蓝变量短信接口URL : http://vsms.253.com/msg/variable/json
    const SERVICE_SEND_VAR_SMS = '/variable/json';

    ### 创蓝短信余额查询接口URL : http://vsms.253.com/msg/balance/json
    const SERVICE_QUERY_BALANCE = '/balance/json';


    /**
     * 创蓝API接口地址
     *
     * @var mixed
     */
    private $domain;

    /**
     * 创蓝账号
     *
     * @var
     */
    private $un;

    /**
     * 创蓝密码
     *
     * @var
     */
    private $pw;


    /**
     * Chuanglan constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->domain = env('CHUANGLAN_DOMAIN', 'http://vsms.253.com/msg');

        $this->un = env('CHUANGLAN_UN');
        if (!$this->un) {
            throw new \Exception('缺少配置项un', 500);
        }

        $this->pw = env('CHUANGLAN_PW');
        if (!$this->pw) {
            throw new \Exception('缺少配置项pw', 500);
        }
    }

    /**
     * 发送短信
     *
     * @author Eddie
     *
     * @param $mobile
     * @param $message
     * @param array $option
     * @return array
     */
    public function send($mobile, $message, $option = [])
    {
        $result = self::curlPost($this->domain . self::SERVICE_SEND_SMS, [
            'account'  =>  $this->un,
            'password' => $this->pw,
            'msg'      => urlencode($message),
            'phone'    => $mobile,
            'report'   => true
        ]);

        dd($result);

        return $this->transform($result);
    }

    /**
     * 发送变量短信
     *
     * @author Eddie
     *
     * @param $message
     * @param $params
     * @return array
     */
    public function sendVariableSMS($message, $params)
    {
        $result = self::curlPost($this->domain . self::SERVICE_SEND_VAR_SMS, [
            'account'  => $this->un,
            'password' => $this->pw,
            'msg'      => $message,
            'params'   => $params,
            'report'   => true
        ]);

        return $this->transform($result);
    }

    /**
     * 短信余额查询
     *
     * @author Eddie
     *
     * @return array
     */
    public function queryBalance()
    {
        $result = self::curlPost($this->domain . self::SERVICE_QUERY_BALANCE, [
            'account'  => $this->un,
            'password' => $this->pw,
        ]);

        return $this->transform($result);
    }

    /**
     * 格式化返回结果
     *
     * @author Eddie
     *
     * @param $result
     * @return array
     */
    public function transform($result)
    {
        if ($result === false) {
            return [
                'status' => false,
                'message' => 'fail',
                'data' => [
                    'errorMsg' => '调用创蓝短信接口失败!'
                ]
            ];
        }

        return [
            'status' => true,
            'message' => 'success',
            'data' => json_decode($result, true)
        ];
    }
}