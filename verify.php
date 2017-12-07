<?php
$access_token = 'oShK7OOuNFHR7etOIUcQyEMUZ6xHxS/LmH2QM5XfMJhEzVK4OISus0t33ZCRwRo2RQjlxaIJ1nQWXUSHcabSB1Bnc7HPwAoim2vKBLyGWZFtizH1PiEzRqgm5Z4r1XsJAFgqwnIbFkelunGE+E2a4gdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
