<?php

use VK\Client\VKApiClient;
require('vendor/autoload.php');
require('Helper.php');


$token = 'xxxx';            # Ваш токен с правами: photos
$album_id = 111111111;      # ID альбома в который будем лить фотки.
$vk = new VKApiClient();

$files = [
    'images/telka.jpg',
    'images/telka.jpg',
    'images/telka.jpg',
    'images/telka.jpg',
    'images/telka.jpg'
];
$scount = 0;
while (true)
{
    $upload_server = $vk->photos()->getUploadServer($token, [
        'album_id' => $album_id,
    ]);
    $send_result = Helper::sendFiles($upload_server['upload_url'], $files);
    $save = $vk->photos()->save($token, [
        'album_id' => $album_id,
        'server' => $send_result->server,
        'photos_list' => $send_result->photos_list,
        'hash' => $send_result->hash,
        'latitude' => '59.68567064444257',
        'longitude' => '38.53079635740064',
        'caption' => '@cr1gger',
        'aid' => $send_result->aid
    ]);
    if ($save) $scount++;
    echo "\rSaved: $scount";

}
