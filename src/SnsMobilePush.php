<?php

/**
 * Class SnsMobilePush
 */
namespace Yutaf\Aws;
use Aws\Sns;

class SnsMobilePush
{
    private $sns;

    /**
     * コンストラクタ
     *
     * @param \Aws\Sns\SnsClient $sns
     */
    public function __construct(Sns\SnsClient $sns)
    {
        $this->sns = $sns;
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