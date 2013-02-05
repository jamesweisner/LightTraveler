<?php

$modules = array(
	'1-basic-math.php',
	'2-set-theory.php',
	'3-binary-math.php',
	'4-linguistics.php',
	'5-chemistry.php',
	// TODO Operational dynamics.
	// TODO Calculus?
	// TODO Introduce checksum?
	// TODO Music, images, etc.
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

// Modes:
//   0 Original symbols.
//   1 Decimal values.
//   2 Formatted binary. (Default)
//   3 Hex string.
//   4 Binary file.
$mode = isset($_GET['mode']) ? (int) $_GET['mode'] : 2;

if($mode == 4) header('Content-disposition: attachment; filename="message.dat"');
else           header('Content-type: text/plain');

foreach(preg_split('/\s+/', trim(join(' break ', $message))) as $token)
{
	if($token == 'break')
	{
		switch($mode)
		{
			case 3:  echo            "ffffffff"; break;
			case 4:  echo pack('N', 0xFFFFFFFF); break;
			default: echo "\n";                  break;
		}
		continue;
	}
	
	// Encode symbols.
	if(is_numeric($token))
		$symbol = (int) $token;
	else if(isset($symbols[$token]))
		$symbol = $symbols[$token];
	else
		die("Token [$token] not found: " . implode(' ', array_keys($symbols)));
	
	switch($mode)
	{
		case 0: echo $token; break;
		case 1: echo $symbol; break;
		case 2: echo str_pad(decbin($symbol), 16, '0', STR_PAD_LEFT); break;
		case 3: echo str_pad(dechex($symbol),  4, '0', STR_PAD_LEFT); break;
		case 4: echo pack('n', $symbol);                              break;
	}
	
	if($mode < 3) echo ' ';
}
