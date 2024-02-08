<?php

namespace Vdocipher;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/GPBMetadata/Token.php';
require_once __DIR__.'/Token.php';

class Playback {
    private $key = null;

    private $token = null;

    const PAYLOAD_KEYS = ['apiKeyId', 'videoId', 'policyId', 'ip', 'userId', 'watermarkValues', 'iat'];

    const MANDATORY_FIELDS = [true, true, false, false, false, false, true];

    /**
     * @throws \Exception
     */
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
     * @throws \Exception
     */
    public function setPayload(array $data = NULL)
    {
        if ($data) {
            foreach (static::PAYLOAD_KEYS as $index => $key) {
                if (!isset($data[$key]) && static::MANDATORY_FIELDS[$index]) {
                    throw new \Exception("Missing key '$key' in data");
                }
            }
            $data[static::PAYLOAD_KEYS[0]] = substr($data[static::PAYLOAD_KEYS[0]], 0, 16);
            $data[static::PAYLOAD_KEYS[1]] = $this->stringToBytesArray($data[static::PAYLOAD_KEYS[1]]);
            if (isset($data[static::PAYLOAD_KEYS[2]])) {
                $data[static::PAYLOAD_KEYS[2]] = $this->stringToBytesArray($data[static::PAYLOAD_KEYS[2]]);
            }
            $this->token = new \Token($data);
        } else {
            $this->token = new \Token(NULL);
        }
    }

    /**
     * @throws \Exception
     */
    public function getToken()
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
        return hex2bin($string);// unpack("H*",bin2hex($string))[1];
    }
}
