<?php

/**
 * Class SnsMobilePush
 */
class SnsMobilePush
{
    private $sns;

    /**
     * コンストラクタ
     *
     * @param $key
     * @param $secret
     * @param $region
     */
    public function __construct($key, $secret, $region)
    {
        $this->sns = \Aws\Sns\SnsClient::factory(array(
            'key'       => $key,
            'secret'    => $secret,
            'region'    => $region,
        ));
    }

    /**
     * EndpointArn を取得
     *
     * @param $PlatformApplicationArn
     * @param $Token
     * @return mixed
     */
    public function getEndpointArn($PlatformApplicationArn, $Token)
    {
        $res = $this->sns->createPlatformEndpoint(array(
            'PlatformApplicationArn' => $PlatformApplicationArn,
            'Token' => $Token
        ))->toArray();
        return $res['EndpointArn'];
    }

    /**
     * メッセージを送信
     *
     * @param $Message
     * @param $TargetArn
     */
    public function publish($Message, $TargetArn)
    {
        $this->sns->publish(array(
            'Message' => $Message,
            'TargetArn' => $TargetArn
        ));
    }
}