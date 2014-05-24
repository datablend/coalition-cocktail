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
  $nextUrl = 'https://api.engagor.com/api/14083/inbox/mentions?access_token=5e301cf7cad5ed3aaadeda9823096bf2&date_from=&date_to=&filter=%28source%3Atwitter%29&limit=100&page_token=YToyOntpOjA7aToyMjkwMDtpOjE7YTowOnt9fQ%3D%3D&topic_ids%5B0%5D=25558&topic_ids%5B1%5D=25559&topic_ids%5B2%5D=25560&topic_ids%5B3%5D=25561&topic_ids%5B4%5D=25570&topic_ids%5B5%5D=25562&topic_ids%5B6%5D=25563&topic_ids%5B7%5D=25571&topic_ids%5B8%5D=25565&topic_ids%5B9%5D=25566&topic_ids%5B10%5D=25567&topic_ids%5B11%5D=25568&topic_ids%5B12%5D=25569&topic_ids%5B13%5D=26758&topic_ids%5B14%5D=25545&topic_ids%5B15%5D=25546&topic_ids%5B16%5D=26735&topic_ids%5B17%5D=25547&topic_ids%5B18%5D=25548&topic_ids%5B19%5D=25549&topic_ids%5B20%5D=26756&topic_ids%5B21%5D=25550&topic_ids%5B22%5D=25551&topic_ids%5B23%5D=25552&topic_ids%5B24%5D=26731&topic_ids%5B25%5D=25553&topic_ids%5B26%5D=25554&topic_ids%5B27%5D=25555&topic_ids%5B28%5D=25556&topic_ids%5B29%5D=25557';
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