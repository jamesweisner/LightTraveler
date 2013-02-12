<?php

$symbols = array(

	// Data types.
	'element', // And element on the Periodic Table.
	'isotope', // Number of neutrons in a stable isotope
	'orbital', // Number of electrons in an orbital.
	
	// Set names.
	'elements', // The periodic table of elements.
	
	// Operators.
	'lifetime_of',

);

$lines = array(

	// Introduce chemical elements by atomic number.
	'op C noun symbols set 1 noun elements',        // Explicitly name new set.
	'op C noun types   set 1 noun element',         // Explicitly name new type.
	'op C noun elements op R element 1 element 98', // The 98 natural elements.
	'op > op # noun elements bin 98',               // More than 98 elements.
	'',

);

// Introduce electron orbitals for each element.
include 'tools/orbitals.php';
$orbitals = compile_orbitals();

// Introduce stable isotopes of each chemical element.
include 'tools/isotopes.php';
$isotopes = compile_isotopes();

// Introduce the operation to get the lifetime of a given isotope.
$lifetimes = array(
	'op = op lifetime_of element 1 isotope 0 scalar inf',
	'op = op lifetime_of element 2 isotope 2 scalar inf',
);

// List lifetime of most naturally occurring radioactive isotopes.
include 'tools/lifetimes.php';
$lifetimes = array_merge($lifetimes, compile_lifetimes());

$lines = array_merge($lines, $orbitals, $isotopes, $lifetimes);

?>
