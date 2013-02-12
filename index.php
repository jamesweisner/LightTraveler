<?php

$modules = array(
	'basic-math.php',
	'set-theory.php',
	'binary-math.php',
	'linguistics.php',
	'periodic-table.php',
	'algebra.php',
	'computation.php',
	'trigonometry.php',
	'physics.php',
	'calculus.php',
	'chemistry.php',
	'images.php',
	'music.php',
	'biology.php',
);

// Array of lines in the message.
$message = array();

// Global symbol list.
$globals = array();

foreach($modules as $module)
{
	$symbols = array(); // Clean symbol table local to the module.
	$lines   = array(); // Clean list of message lines in the module.
	
	include $module;
	
	// Add module symbols to the global symbol list.
	foreach($symbols as $symbol)
	{
		if(in_array($symbol, $globals))
			die("Duplicate declaration of the symbol [$symbol]!\n");
		$globals[] = $symbol;
	}
	
	// Append module lines to the message.
	$message = array_merge($message, $lines);
}

// Format symbol lookup table by assigning values to the global symbols.
$symbols = array_flip($globals);

// Will look for unused symbols.
$globals = $symbols;

// Modes:
//   0 Original symbols.
//   1 Decimal values.
//   2 Formatted binary. (Default)
//   3 Hex string.
//   4 Binary file.
$mode = isset($_GET['mode']) ? (int) $_GET['mode'] : 2;

switch($mode)
{
	case 4:
		header('Content-disposition: attachment; filename="message.dat"');
		break;
	case 5:
		header('Content-type: image/png');
		include 'tools/image.php';
		image_init();
		break;
	default:
		header('Content-type: text/plain');
		break;
}

foreach(preg_split('/\s+/', trim(join(' break ', $message))) as $token)
{
	if($token == 'break')
	{
		if($length % 2) die("Word misalignment!\n");
		switch($mode)
		{
			case 3:  echo            "ffffffff"; break;
			case 4:  echo pack('N', 0xFFFFFFFF); break;
			case 5:  image_break();              break;
			default: echo "\n";                  break;
		}
		$length += 2;
		continue;
	}
	
	// Encode symbols.
	unset($globals[$token]);
	if(is_numeric($token))
		$symbol = (int) $token;
	else if(isset($symbols[$token]))
		$symbol = $symbols[$token];
	else
		die("Token [$token] not found: " . implode(' ', array_keys($symbols)));
	
	switch($mode)
	{
		case 0: echo $token;                                          break;
		case 1: echo $symbol;                                         break;
		case 2: echo str_pad(decbin($symbol), 16, '0', STR_PAD_LEFT); break;
		case 3: echo str_pad(dechex($symbol),  4, '0', STR_PAD_LEFT); break;
		case 4: echo pack('n', $symbol);                              break;
		case 5: image_symbol($symbol);                                break;
	}
	$length++;
	
	if($mode < 3) echo ' ';
}

if($globals) echo "Unused symbols: " . implode(', ', array_keys($globals)) . "\n";

if($mode == 5) imagepng($image);
