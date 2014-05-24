<?php

// Visit http://developers.engagor.com/ for documentation.
require_once 'Engagor.php';
require_once 'Configuration.php';

// Fill in these values.
$accessToken = Configuration::ACCESS_TOKEN;
$accountId = Configuration::ACCOUNT_ID;
$topicId = null;


try {
  $fp = fopen('tweets.csv', 'w');

  $engagor = new Engagor($accessToken);

  $tweets_count = 0;
  do{
    if($nextUrl){
      $response = $engagor->api($nextUrl, array(), true);
    } else {
      $response = $engagor->api(
        $accountId.'/inbox/mentions',
        array(
          'filter' => '(source:twitter)',
          'topic_ids' => array_keys(Configuration::$topicIds),
          'limit' => 100
        ));
    }

    $response = $engagor->processResponse($response);
    if (!empty($response['meta']) && $response['meta']['code'] == 200) {
      $total = $response['response']['count'];
      //tweet storing logic
      foreach($response['response']['data'] as $data){
        preg_match_all(Configuration::TWITTER_USER_MENTION, $data['message']['content'], $mentions);
        $mentions_string = '';
        if(count($mentions) > 0){
          $mentions_string = join(';', $mentions[0]);
        }
        $fields = array(
          $data['author']['name'],
          $mentions_string,
          $data['message']['content'],
          Configuration::$topicIds[$data['topic']['id']],
          $data['message']['type'],
          $data['date']['published'],
          $data['message']['sentiment'],
          $data['source']['id']
          );
        fputcsv($fp, $fields, chr(9));
        $tweets_count++;
      }
      print('tweets fetched: ' . $tweets_count . ' total: ' . $total );
      $nextUrl = $response['response']['paging']['next_url'];
      print(' next url: ' . $nextUrl . "\n");
    } else{
      var_dump($response);
    }
  } while($nextUrl != null) ;


} catch(Exception $e) {
  var_dump($e->getMessage());
}