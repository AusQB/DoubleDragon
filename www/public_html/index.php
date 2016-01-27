<?php

$ch = curl_init();

$adj_url  = 'https://wordsapiv1.p.mashape.com/words/?random=true&letterPattern=^d\S{2,}$&partOfSpeech=adjective';
$noun_url = 'https://wordsapiv1.p.mashape.com/words/?random=true&letterPattern=^d\S{2,}$&partOfSpeech=noun';

$options = array(
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HEADER => false,
	CURLOPT_HTTPHEADER => array(
		'X-Mashape-Key: hhlu62X7o7mshEDyM5KMzgykXIwEp1QqnaAjsnBfIuovsADuoY',
		'Accept: application/json'
	)
);

curl_setopt_array($ch, $options);

curl_setopt($ch, CURLOPT_URL, $adj_url);

$adjective = json_decode(curl_exec($ch));

curl_setopt($ch, CURLOPT_URL, $noun_url);

$noun = json_decode(curl_exec($ch));

curl_close($ch);

?>

<!DOCTYPE html>
<html>
<head>

<style type="text/css">

html, body {
	height: 100%;
	width: 100%;
}

body {
	color: #fff;
	margin: 0;
	text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
}

h1 {
	margin: 0;
}
	
#wrap {
    font-family: sans-serif;
	position: relative;
	text-align: center;
    top: 50%;
    transform: translateY(-50%);
}

#words {
	display: inline-block;
    padding: 1rem;
    font-size: 2.4rem;
    font-weight: bold;
    text-transform: uppercase;
}

#copyright {
	position: absolute;
	bottom: 0;
	right: 0;
}

</style>

</head>
<body>

<div id="wrap">

	<h1>Welcome back to Team</h1>

	<div id="words"><?= $adjective->word . ' ' . $noun->word ?></div>

	<!-- <button>Generate</button> -->

</div>

<div id="copyright">
	Copyright &copy; Robert Gillman <?= date('Y') ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script>

$(function() {

	// var url = 'https://wordsapiv1.p.mashape.com/words/?random=true&letterPattern=^d\S{3,}$&partOfSpeech=adjective';
	// var data = {'X-Mashape-Key': 'hhlu62X7o7mshEDyM5KMzgykXIwEp1QqnaAjsnBfIuovsADuoY', 'Accept': 'application/json'};

	// $('button').click(function() {

	// 	$.ajax(url, {
	// 		beforeSend: function(xhr) {
	// 			xhr.setRequestHeader('X-Mashape-Key', 'hhlu62X7o7mshEDyM5KMzgykXIwEp1QqnaAjsnBfIuovsADuoY');
	// 		},
	// 		success: function(data) {
	// 			console.log(data);
	// 		}
	// 	});

	// });

	var r, g, b;

	function randomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	function randomColor(callback) {

		r = randomInt(63, 191)
		g = randomInt(63, 191)
		b = randomInt(63, 191)

		var color = 'rgb('+r+','+g+','+b+')';

		$('body').css('background-color', color);

		if (callback && typeof(callback) === 'function') {
			callback();
		}

	}

	randomColor(function() {
		setTimeout(function() {
			$('body').css('transition', 'background-color 2s linear');
		}, 2000);
	});

	setInterval(randomColor, 2000);

});

</script>

</body>
</html>