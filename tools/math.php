<?php

function scientific_notation($number)
{
	$power = 0;
	while($number > 65535)  { $number /= 2; $power++; }
	while($number < 32768)  { $number *= 2; $power--; } $number = round($number);
	while($number % 2 == 0) { $number /= 2; $power++; }
	$mantissa = ($number < 0 ? 'neg ' : 'bin ') . abs($number);
	$exponent = ($power  < 0 ? 'neg ' : 'bin ') . abs($power);
	return "op = op * op ^ $mantissa bin 2 $exponent"; // = number * 2^(power)
}

?>
