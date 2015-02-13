<?php

// use composer's autoload
require 'vendor/autoload.php';

// import our classes
use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a new client
$client = new Client();

// get some emoji
$response = $client->get('https://api.github.com/emojis');
$emojis = json_decode($response->getBody());

// shove it into a file
$html = "<html><head><body>";
foreach ($emojis as $emoji => $image) {
	$html .= "<img src='{$image}'>\n";
}
$html .="</body></head></html>";

file_put_contents("emoji.html", $html);


// create a logger
$log = new Logger('test');
$log->pushHandler(new StreamHandler('test.log', Logger::WARNING));

// log something
$log->addWarning("BROKEN");
$log->addError("BUSTED");