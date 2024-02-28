<?php

namespace Vdocipher;

require_once __DIR__.'/GPBMetadata/Token.php';
require_once __DIR__.'/Token.php';

class Playback {
    private $key = null;

    private $token = null;

    const MANDATORY_FIELDS = [
        'apiKeyId' => true,
        'videoId' => true,
        'policyId' => false,
        'ip' => false,
        'userId' => false,
        'watermarkValues' => false,
        'iat' => true
    ];

    public function __construct(string $apiKey = NULL, array $data = NULL)
    {
        $this->setKey($apiKey);
        $this->setPayload($data);
    }

    /**
     * @param string $key
     * @return void
     */
    public function setKey(string $key = NULL)
    {
        if ($key) {
            $this->key = $key;
        }
    }

    /**
     * @param array|NULL $data
     * @return void
     * @throws \UnexpectedValueException
     */
    public function setPayload(array $data = NULL): void
    {
        if ($data) {
            foreach (static::MANDATORY_FIELDS as $key => $isRequired) {
                if (!isset($data[$key]) && $isRequired) {
                    throw new \UnexpectedValueException("Missing key '$key' in data");
                }
            }
            if (!preg_match("/[0-9a-f]{32}/i", $data['videoId'])) {
                throw new \UnexpectedValueException('Vdocipher Error: Invalid video ID');
            }
            if (!empty($data['policyId']) && !preg_match("/[0-9a-f]{8}((-[0-9a-f]{4}){3})(-[0-9a-f]{12})/i", $data['policyId'])) {
                throw new \UnexpectedValueException('Vdocipher Error: Invalid policy ID');
            }
            $data['apiKeyId'] = substr($data['apiKeyId'], 0, 16);
            $data['videoId'] = $this->stringToBytesArray($data['videoId']);
            if (isset($data['policyId'])) {
                $data['policyId'] = $this->stringToBytesArray($data['policyId']);
            }
            $this->token = new \Token($data);
        } else {
            $this->token = new \Token(NULL);
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getToken(): string
    {
        if ($this->token === NULL) {
            throw new \Exception('Missing Token payload.');
        }

        if ($this->key === null) {
            throw new \Exception('You must provide Encryption key.');
        }

        $tokenString = $this->token->serializeToString();

        $hash = hash_hmac('sha256', $tokenString, $this->key, true);

        $token = $this->base64UrlSafe(base64_encode($tokenString)) . '.' . $this->base64UrlSafe(base64_encode($hash));

        return $token;

    }

    /**
     * @param $string
     * @return array|string|null
     */
    private function base64UrlSafe($string): array|string|null
    {
        return preg_replace(['/\//', '/\+/', '/=/'], ['_', '-', ''], $string);
    }

    private function stringToBytesArray($string)
    {
        return hex2bin($string);
    }
}
