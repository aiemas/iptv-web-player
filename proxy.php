<?php
if (!isset($_GET['url'])) {
  http_response_code(400);
  echo "Missing URL";
  exit;
}

$url = $_GET['url'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Origin: https://xtreaweb.top",
  "Referer: https://xtreaweb.top/"
]);

$stream = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

if ($stream) {
  header("Content-Type: " . $contentType);
  echo $stream;
} else {
  http_response_code(500);
  echo "Failed to fetch stream";
}
