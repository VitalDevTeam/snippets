<?php

require "twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth; //download at https://github.com/abraham/twitteroauth

//set to true for debugging - yep
$debug = true;
//60 * 60 is one hour.  modify at will
$cache_limit = 60 * 60;

define('consumer_key', 'YOUR_CONSUMER_KEY');
define('consumer_secret', 'YOUR_CONSUMER_SECRET');
define('access_token', 'YOUR_ACCESS_TOKEN');
define('access_token_secret', 'YOUR_ACCESS_TOKEN_SECRET');

$toa = new TwitterOAuth(consumer_key, consumer_secret, access_token, access_token_secret);

$filePath = 'cache/'; //relative path to your tweet caching folder
$file = $filePath . "tweets.json"; //name of your cache file

$query = array(
    'q'             =>  '#hashtag',  //hashtag to search by
    'count'         =>  3           //how many tweets to grab
);

//check if cache is older than $cache_limit
if (time() - filemtime($file) > $cache_limit) {

    //if it is, request new tweets and recreate
    $results = $toa->get('search/tweets', $query);

    if (isset($results->errors[0]->code)) {
        //did it work? now?  Tell me the errors.
        echo "Error encountered: " . $results->errors[0]->message . " Response code:" . $results->errors[0]->code;
    }

    // file older than 1 hour
    $fh = fopen($file, 'w') or die("can't open file");
    fwrite($fh, json_encode($results));
    fclose($fh);

    if ($debug === true && file_exists($file)) {

        echo $file . " successfully written (" .round(filesize($file)/1024)."KB)";
        echo "$filename was last modified: " . date ("F d Y H:i:s.", filemtime($file));

    } elseif (!file_exists($file)) {

        echo "Error encountered. File could not be written.";
    }
}
