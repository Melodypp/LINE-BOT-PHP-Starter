<?php
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:Yac5n1y3qAiNglC';
$access_token = 'oShK7OOuNFHR7etOIUcQyEMUZ6xHxS/LmH2QM5XfMJhEzVK4OISus0t33ZCRwRo2RQjlxaIJ1nQWXUSHcabSB1Bnc7HPwAoim2vKBLyGWZFtizH1PiEzRqgm5Z4r1XsJAFgqwnIbFkelunGE+E2a4gdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => "One Page\r\nhttps://www.set.or.th/set/factsheet.do?symbol=".$text."&ssoPageId=3&language=th&country=TH\r\nConsensus\r\nhttp://www.settrade.com/AnalystConsensus/C04_10_stock_saa_p1.jsp?txtSymbol=".$text."&selectPage=10&sortBy=-11\r\nIntraday\r\nhttps://marketdata.set.or.th/mkt/realtimestockchart?symbol=".$text."&type=AccValue"
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
