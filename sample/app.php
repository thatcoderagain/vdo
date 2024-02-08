<?php

namespace Sample;

require_once __DIR__.'/../vendor/autoload.php';

function renderVideo($apiKey, $videoId, $data) {
    $vdocipher = new \Vdocipher\Playback($apiKey, $data);
    $token = $vdocipher->getToken();
    $url = "https://player.vdocipher.com/v2/?token=$token&videoId=$videoId";
    $uniq = 'u' . rand();
    $width = '1280px';
    $height = '720px';
    $iframe = '<iframe
          src="'.$url.'"
          id="'.$uniq.'"
          style="height:'.$height.';width:'.$width.';max-width:100%;border:0;display: block;"
          allow="encrypted-media"
          allowfullscreen
        ></iframe>';
    return [$token, $iframe];
}


# Sample Payload Array
$key = 'HOJmGTj4sy5MJt2EC5FVtJ3jpUq5KiGWLW2EXcJRC9xbNagoykOFaudsHKaq0CVY';
$videoId         = '0989fbb847ed4cb195788df42f608db4';


echo renderVideo($key, $videoId, [
    'apiKeyId'        => substr($key, 0, 16),
    'videoId'         => $videoId,
    //    'policyId'        => $policyId, // optional
    //    'ip'              => $ip, // optional
    //    'userId'          => $userId, // optional
    //    'watermarkValues' => [], // optional
    'iat'             => time(),
])[1];