<?php

namespace App;

use Vdocipher\Playback;

require_once __DIR__. '/../vdocipher/Playback.php';

# Sample Data
$time            = time();
$apiKeyId        = 'VhSV6gDoAdGRbSIv';
$policyId        = 'policy-id';
$videoId         = '31e91b303da14a93847b875a5a9e94db';
$userId          = 'a1b2c3d4e5-a1b2c3d4e5-a1b2c3d4e5';
$watermarkValues = ['shubham', 'copyright protected'];
$ip              = '182.76.41.59';
$iat = $time;
# End Of Sample Data

# Sample Payload Array
$data = [
    'apiKeyId'        => $apiKeyId,
    'videoId'         => $policyId,
    'policyId'        => $videoId,
    'userId'          => $userId,
    'ip'              => $ip,
    'watermarkValues' => $watermarkValues,
    'iat'             => $iat,
];

# Function for reading API Key
function getKey() {
    $keyPath = __DIR__ . "/key";
    $file = fopen($keyPath, "r") or die("Unable to read signing key.");
    $key = fread($file,filesize($keyPath));
    fclose($file);
    return $key;
}

# Generate Token
echo "<pre>";
$vdocipher = new Playback();
$vdocipher->setKey(getKey());
$vdocipher->setPayload($data);
echo "\nMethod 1 Token: ".$token = $vdocipher->getToken();

$vdocipher = new Playback(getKey(), $data); // mass assignment
echo "\nMethod 2 Token: ".$token = $vdocipher->getToken();
echo "</pre>";

### HOW TO RUN - execute following command
// cd /path/to/repo
// php -S localhost:8888 ./App/sample.php
