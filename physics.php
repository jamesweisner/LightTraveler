<?php

$symbols = array(

	// Operators.
	'lifetime_of',

);

// Introduce the operation to get the lifetime of a given isotope.
$lines = array(
	'op = lifetime_of element 1 isotope 0 scalar inf',
	'op = lifetime_of element 2 isotope 2 scalar inf',
);

// List lifetime of most naturally occurring radioactive isotopes.
include 'tools/lifetimes.php';
$lines = array_merge($lines, compile_lifetimes());

?>
