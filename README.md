# Token Creator SKD | Vdocipher Plugin
 
The following package provides functionality to generate tokens for video playback. You  can read more about the vdocipher tokens [here](https://vdocipher.com/docs/playbackauth/token/home).

#### Install package
 
> `composer require vdocipher/token-creator`

#### Sample code
```php
<?php

require_once __DIR__.'/vendor/autoload.php'; // Path to vendor/autoload.php

# Sample Payload
$apiKey   = 'abcdef1234567890xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'; // API Key
$videoId  = '0989fbb847ed4cb1xxxxxxxxxxxxxxxx';     // video id
$policyId = 'b703f02b-xxxx-xxxx-xxxx-xxxxxxxxxxxx'; // policy id
$payload  = [
       'apiKeyId'        => substr($apiKey, 0, 16),   // only first 16 char of API key
       'videoId'         => $videoId,                 // video id
   //  'policyId'        => $policyId,                // optional parameter
   //  'ip'              => $ip,                      // optional parameter
   //  'userId'          => $userId,                  // optional parameter
   //  'watermarkValues' => ['John', 'john@xyz.com'], // optional parameter
       'iat'             => time(),
];

// Important!!! PASS THE FULL API KEY HERE ALONG WITH THE PAYLOAD
$vdocipher  = new \Vdocipher\Playback($apiKey, $payload); 
$token      = $vdocipher->getToken(); // playback token

$uniqueId   = 'u'.rand();
$paybackUrl = "https://player.vdocipher.com/v2/?token=$token&videoId=$videoId";
$iframe     = '<iframe 
                id="'.$uniqueId.'" 
                src="'.$paybackUrl.'"
                allowfullscreen allow="encrypted-media"
                style="height:1280px;width:720px;max-width:100%;border:0;display:block;"
                ></iframe>'; // iframe
                
echo $iframe;
```

_happy coding ..._
