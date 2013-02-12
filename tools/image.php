<?php

function image_init()
{
	global $image, $white, $black, $empty, $count;
	$image = imagecreatetruecolor(1024, 8 * 32);
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image,   0,   0,   0);
	$empty = imagecolorallocate($image, 128, 128, 128);
	imagefill($image, 0, 0, $empty);
	$count = 0;
}

function image_break()
{
	global $image, $black;
	for($i = 0; $i < 32; $i++)
	{
		list($x, $y) = image_next_location();
		imagesetpixel($image, $x, $y, $black);
	}
}

function image_symbol($symbol)
{
	global $image, $black, $white;
	for($i = 15; $i >= 0; $i--)
	{
		$color = ($symbol & (1 << $i)) ? $black : $white;
		list($x, $y) = image_next_location();
		imagesetpixel($image, $x, $y, $color);
	}
}

function image_next_location()
{
	global $count;
	$y = $count % 32;
	$x = floor($count / 32);
	$y += floor($x / 1024) * 48;
	$x %= 1024;
	$count++;
	return array($x, $y);
}

?>
