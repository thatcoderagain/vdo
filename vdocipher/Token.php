<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: Token.proto

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Token</code>
 */
class Token extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string apiKeyId = 1;</code>
     */
    protected $apiKeyId = '';
    /**
     * Generated from protobuf field <code>bytes videoId = 2;</code>
     */
    protected $videoId = '';
    /**
     * Generated from protobuf field <code>bytes policyId = 3;</code>
     */
    protected $policyId = '';
    /**
     * Generated from protobuf field <code>string ip = 4;</code>
     */
    protected $ip = '';
    /**
     * Generated from protobuf field <code>string userId = 5;</code>
     */
    protected $userId = '';
    /**
     * Generated from protobuf field <code>repeated string watermarkValues = 6;</code>
     */
    private $watermarkValues;
    /**
     * Generated from protobuf field <code>uint32 iat = 7;</code>
     */
    protected $iat = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $apiKeyId
     *     @type string $videoId
     *     @type string $policyId
     *     @type string $ip
     *     @type string $userId
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $watermarkValues
     *     @type int $iat
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Token::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string apiKeyId = 1;</code>
     * @return string
     */
    public function getApiKeyId()
    {
        return $this->apiKeyId;
    }

    /**
     * Generated from protobuf field <code>string apiKeyId = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setApiKeyId($var)
    {
        GPBUtil::checkString($var, True);
        $this->apiKeyId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes videoId = 2;</code>
     * @return string
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Generated from protobuf field <code>bytes videoId = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setVideoId($var)
    {
        GPBUtil::checkString($var, False);
        $this->videoId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes policyId = 3;</code>
     * @return string
     */
    public function getPolicyId()
    {
        return $this->policyId;
    }

    /**
     * Generated from protobuf field <code>bytes policyId = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setPolicyId($var)
    {
        GPBUtil::checkString($var, False);
        $this->policyId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string ip = 4;</code>
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Generated from protobuf field <code>string ip = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setIp($var)
    {
        GPBUtil::checkString($var, True);
        $this->ip = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string userId = 5;</code>
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Generated from protobuf field <code>string userId = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setUserId($var)
    {
        GPBUtil::checkString($var, True);
        $this->userId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated string watermarkValues = 6;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getWatermarkValues()
    {
        return $this->watermarkValues;
    }

    /**
     * Generated from protobuf field <code>repeated string watermarkValues = 6;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setWatermarkValues($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->watermarkValues = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 iat = 7;</code>
     * @return int
     */
    public function getIat()
    {
        return $this->iat;
    }

    /**
     * Generated from protobuf field <code>uint32 iat = 7;</code>
     * @param int $var
     * @return $this
     */
    public function setIat($var)
    {
        GPBUtil::checkUint32($var);
        $this->iat = $var;

        return $this;
    }

}

