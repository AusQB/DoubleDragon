<?php

$adjectives = file('adjectives.txt');
$nouns = file('nouns.txt');

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
    font-family: sans-serif;
	margin: 0;
}

h1 {
	margin: 0;
}
	
#wrap {
	position: relative;
	text-align: center;
	text-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
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

button {
	background: #fff;
	border: none;
	border-radius: 5px;
	color: rgba(0, 0, 0, 0.5);
	cursor: pointer;
	display: block;
    font-size: 1.4em;
	font-weight: bold;
	margin: 1rem auto;
	outline: none;
	padding: 1rem;
	text-transform: uppercase;
	-webkit-appearance: none;
}

#copyright {
	bottom: 10px;
	color: rgba(255, 255, 255, 0.5);
	font-size: 12px;
	position: absolute;
	right: 10px;
}

</style>

</head>
<body>

<div id="wrap">

	<h1>Welcome back to Team</h1>

	<div id="words"><?// $adjective->word . ' ' . $noun->word ?></div>

	<button>Generate</button>

</div>

<div id="copyright">
	Copyright &copy; Robert Gillman <?= date('Y') ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script>

$(function() {

	var adjectives  = <?= json_encode($adjectives) ?>;
	var nouns		= <?= json_encode($nouns) ?>;

	genWords();

	function genWords() {

		var adjective = adjectives[Math.floor(Math.random()*adjectives.length)];

		var noun = nouns[Math.floor(Math.random()*nouns.length)];

		$('#words').text(adjective + ' ' + noun);

	}

	$('button').click(function() {

		genWords();

	});

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
		$('button').css('color', color);

		if (callback && typeof(callback) === 'function') {
			callback();
		}

	}

	randomColor(function() {
		setTimeout(function() {
			$('body').css('transition', 'background-color 2s linear');
			$('button').css('transition', 'color 2s linear');
		}, 2000);
	});

	setInterval(randomColor, 2000);

});

</script>

</body>
</html>