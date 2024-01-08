<?php

namespace Vdocipher;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/GPBMetadata/Token.php';
require_once __DIR__.'/Token.php';

use Firebase\JWT\JWT;

class Playback {
    private ?string $key = null;

    private ?\Token $token = null;

    const array PAYLOAD_KEYS = ['apiKeyId', 'videoId', 'policyId', 'ip', 'userId', 'watermarkValues', 'iat'];

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
    public function setKey(string $key = NULL): void
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
    public function setPayload(array $data = NULL): void
    {
        if ($data) {
            foreach (static::PAYLOAD_KEYS as $index => $key) {
                if (!isset($data[$key])) {
                    throw new \Exception("Missing key '$key' in data");
                }
            }
            $this->token = new \Token($data);
        } else {
            $this->token = new \Token();
        }
    }

    /**
     * @param string $token
     * @return string
     * @throws \Exception
     */
    private function signToken(string $token): string
    {
        if ($this->key === null) {
            throw new \Exception('You must provide Encryption key.');
        }

        return JWT::encode(['token' => $token], $this->key, 'HS256');
    }

    /**
     * @throws \Exception
     */
    public function getToken(): string
    {
        if ($this->token === NULL) {
            throw new \Exception('Missing Token payload.');
        }

        return $this->signToken(base64_encode($this->token->serializeToString()));
    }
}
