<?php

$symbols = array(

	// Chemistry data types.
	'element', // And element on the Periodic Table.
	'isotope', // Number of neutrons in a stable isotope
	'orbital', // Number of electrons in an orbital.
	
	// Chemistry nouns.
	'elements', // The periodic table of elements.

);

$lines = array(

	// Introduce chemical elements by atomic number.
	'op C noun nouns set 1 noun elements',
	'op C noun types set 1 noun element',
	'op C elements set 5
		element 1
		element 2
		element 3
		element 98
	',
	
	// There are at least 98 chemical elements.
	'op > op # elements bin 97',
	'',
);

// Introduce electron orbitals for each element.
include 'tools/orbitals.php';
$orbitals = compile_orbitals();

// Introduce stable isotopes of each chemical element.
include 'tools/isotopes.php';
$isotopes = compile_isotopes();

$lines = array_merge($lines, $orbitals, $isotopes);

?>
