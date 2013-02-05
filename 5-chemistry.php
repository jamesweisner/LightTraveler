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
	'op C noun nouns set 1 elements',
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
	
	// Introduce electron orbitals in each element.
	'op C noun types set 1 orbital',
	'op C element 1 set 1 orbital 1',
	// TODO
	
	// Introduce isotopes of each chemical element.
	'op C element 1 set 2 isotope 0 isotope 1',
	'op C element 2 set 2 isotope 1 isotope 2',
	// TODO

); ?>
