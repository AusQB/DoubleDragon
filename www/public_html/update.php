<?php

$ch = curl_init();

$adj_url  = 'https://wordsapiv1.p.mashape.com/words/?letterPattern=^d\S{2,}$&partOfSpeech=adjective';
$noun_url = 'https://wordsapiv1.p.mashape.com/words/?letterPattern=^d\S{2,}$&partOfSpeech=noun';

$options = array(
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HEADER => false,
	CURLOPT_HTTPHEADER => array(
		'X-Mashape-Key: hhlu62X7o7mshEDyM5KMzgykXIwEp1QqnaAjsnBfIuovsADuoY',
		'Accept: application/json'
	)
);

curl_setopt_array($ch, $options);

$adjectives = array();
$nouns = array();
$num_adjectives = 0;
$num_nouns = 0;

$page = 1;

do {
	curl_setopt($ch, CURLOPT_URL, $adj_url.'&page='.$page);
	$res = json_decode(curl_exec($ch));
	$adjectives = array_merge($adjectives, $res->results->data);
	$num_adjectives += count($res->results->data);
	$page++;
} while($res->results->total > $num_adjectives);

file_put_contents('adjectives.txt', implode(PHP_EOL, $adjectives));

$page = 1;

do {
	curl_setopt($ch, CURLOPT_URL, $noun_url.'&page='.$page);
	$res = json_decode(curl_exec($ch));
	$nouns = array_merge($nouns, $res->results->data);
	$num_nouns += count($res->results->data);
	$page++;
} while($res->results->total > $num_nouns);

file_put_contents('nouns.txt', implode(PHP_EOL, $nouns));

curl_close($ch);

?>