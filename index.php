<?php
declare(strict_types = 1);

// Set up defaults
$pwPhrase = false;
$pwPhraseLength = 4;

$pwCharLength = 15;
$pwUpper = true;
$pwLower = true;
$pwNumbers = true;
$pwSymbols = false;

if(isset($_GET["l"]))
{
	$unsafe_pwLength = intval($_GET["l"]);
	if($unsafe_pwLength != 0)
	{
		$pwCharLength = $unsafe_pwLength;
		//var_dump($unsafe_pwLength);
	}
}

function GenerateRandomChars($pwLength, $pwLower, $pwUpper, $pwNumbers, $pwSymbols) : string
{
	$char_lowercase = "abcdefghijkmnpqrstuvwxyz";
	$char_uppercase = "ABCDEFGHJKLMNPQRSTUVWXYZ";
	$char_numbers = "123456789";
	$char_symbols = "#~@/$&*()^!+-%";

	// Build char list
	$chars = "";
	if($pwLower) { $chars .= $char_lowercase; }
	if($pwUpper) { $chars .= $char_uppercase; }
	if($pwNumbers) { $chars .= $char_numbers; }
	if($pwSymbols) { $chars .= $char_symbols; }

	$charLength = strlen($chars);

	$result = "";

	for ($i = 0; $i < $pwLength; $i++)
	{ 
		$index = random_int(0, $charLength - 1);
		$result .= substr($chars, $index, 1);
	}

	return $result;
}

function GenerateRandomPhrase($phraseLength) : string
{
	$words = ["correct", "horse", "battery", "staple", "bridge", "code", "table", "tractor", "phone"];

	$wordsLength = count($words);

	$result = "";

	for ($i = 0; $i < $phraseLength; $i++)
	{ 
		$index = random_int(0, $wordsLength - 1);
		$result .= $words[$index];
	}

	return $result;
}

if($pwPhrase)
{
	$result = GenerateRandomPhrase($pwPhraseLength);
}
else
{
	$result = str_shuffle(GenerateRandomChars($pwCharLength, $pwLower, $pwUpper, $pwNumbers, $pwSymbols));
}

echo $result;

//echo " (" . strlen($result) . ")";
