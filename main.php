<?php

require_once __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setScopes([
    'https://www.googleapis.com/auth/youtube.force-ssl',
]);
$client->setAuthConfig('./client_secret.json');
$client->setAccessType('offline');
// Request authorization from the user.
$authUrl = $client->createAuthUrl();
printf("Open this link in your browser:\n%s\n", $authUrl);
print('Enter verification code: ');
$authCode = trim(fgets(STDIN));
// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);
// Define service object for making API requests.
$service = new Google_Service_YouTube($client);
$queryParams = [
    'channelId' => 'UCiBfuUreTbKvBKtQbb6SIWQ',
    'maxResults' => 2,
    'order' => 'date',
    'type' => 'video'
];
$response = $service->search->listSearch('snippet', $queryParams);
// File json 
$file = "main.json";
//  get file json
$mainjson = file_get_contents($file);
// decode
$data = json_decode($mainjson, true);
// encode
$jsonfile = json_encode($response, JSON_PRETTY_PRINT);
// save
$save = file_put_contents($file, $jsonfile);

