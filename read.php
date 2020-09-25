<?php
// File json 
$file = "main.json";

// get file json
$mainjson = file_get_contents($file);

// decode 
$data = json_decode($mainjson, true);

// foreach to echo all the data
foreach ($data['items'] as $d) {
    print_r ($d['id']['videoId']." - ".$d['snippet']['channelId']."\n");

}
