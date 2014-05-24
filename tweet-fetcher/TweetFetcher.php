<?php

// Visit http://developers.engagor.com/ for documentation.
require_once 'Engagor.php';
require_once 'Configuration.php';

// Fill in these values.
$accessToken = Configuration::ACCESS_TOKEN;
$accountId = Configuration::ACCOUNT_ID;
$topicId = null;

try {
  var_dump($accessToken);
  $engagor = new Engagor($accessToken);
  // Basic call to get current user.
  $response = $engagor->api('/me');
  $response = $engagor->processResponse($response);
  if (!empty($response['meta']) && $response['meta']['code'] == 200) {
      var_dump($response['response']);
  }
  var_dump($response);
} catch(Exception $e) {
  var_dump($e->getMessage());
}