<?php

require_once 'tools/math.php';

// Lsit of the average lifetime of several radioactive isotopes.
// http://en.wikipedia.org/wiki/List_of_nuclides
// http://en.wikipedia.org/wiki/List_of_elements
function compile_lifetimes()
{
	$planck_time = 5.391e-44; // Seconds.

	$elements = array(
		'H', 'He', 'Li', 'Be', 'B', 'C', 'N', 'O', 'F', 'Ne', 'Na', 'Mg', 'Al',
		'Si', 'P', 'S', 'Cl', 'Ar', 'K', 'Ca', 'Sc', 'Ti', 'V', 'Cr', 'Mn', 'Fe',
		'Co', 'Ni', 'Cu', 'Zn', 'Ga', 'Ge', 'As', 'Se', 'Br', 'Kr', 'Rb', 'Sr',
		'Y', 'Zr', 'Nb', 'Mo', 'Tc', 'Ru', 'Rh', 'Pd', 'Ag', 'Cd', 'In', 'Sn',
		'Sb', 'Te', 'I', 'Xe', 'Cs', 'Ba', 'La', 'Ce', 'Pr', 'Nd', 'Pm', 'Sm',
		'Eu', 'Gd', 'Tb', 'Dy', 'Ho', 'Er', 'Tm', 'Yb', 'Lu', 'Hf', 'Ta', 'W',
		'Re', 'Os', 'Ir', 'Pt', 'Au', 'Hg', 'Tl', 'Pb', 'Bi', 'Po', 'At', 'Rn',
		'Fr', 'Ra', 'Ac', 'Th', 'Pa', 'U', 'Np', 'Pu', 'Am', 'Cm', 'Bk', 'Cf',
	);

	$examples = array(
		array(128, 'Te', 2.400e32),
		array(136, 'Xe', 6.660e28),
		array( 76, 'Ge', 5.642e28),
		array( 96, 'Zr', 6.300e26),
		array( 82, 'Se', 3.408e27),
		array(116, 'Cd', 9.783e26),
		array( 48, 'Ca', 7.258e26),
		array(209, 'Bi', 5.996e26),
		array(130, 'Te', 2.777e26),
		array(150, 'Nd', 2.493e26),
		array(100, 'Mo', 2.461e26),
		array(151, 'Eu', 1.578e26),
		array(180,  'W', 5.680e25),
		array( 50,  'V', 4.418e24),
		array(113, 'Cd', 2.430e23),
		array(148, 'Sm', 2.209e23),
		array(144, 'Nd', 7.227e22),
		array(186, 'Os', 6.312e22),
		array(174, 'Hf', 6.312e22),
		array(123, 'Te', 1.890e22),
		array(115, 'In', 1.392e22),
		array(130, 'Ba', 2.200e22),
		array(152, 'Gd', 3.408e21),
		array(190, 'Pt', 2.051e19),
		array(147, 'Sm', 3.345e18),
		array(138, 'La', 3.219e18),
		array( 87, 'Rb', 1.568e18),
		array(187, 'Re', 1.300e18),
		array(176, 'Lu', 1.187e18),
		array(232, 'Th', 4.434e17),
		array(238,  'U', 1.410e17),
		array( 40,  'K', 3.938e16),
		array(235,  'U', 2.222e16),
		array(146, 'Sm', 3.250e15),
		array(244, 'Pu', 2.525e15),
	);
	
	$lines = array();
	
	foreach($examples as $example)
	{
		list($nucleons, $symbol, $halflife) = $example;
		$lifetime = $halflife / log(2);    // Convert half-life to mean lifetime.
		$value = $lifetime / $planck_time; // Convert seconds to plank time units.
		$value = scientific_notation($value);
		if(!in_array($symbol, $elements))
			die("Failed to look up element symbol [$symbol]!\n");
		$element = array_search($symbol, $elements) + 1;
		$isotope = $nucleons - $element;
		$lines[] = "op = op lifetime_of element $element isotope $isotope $value";
	}
	
	$lines[] = ''; // End of section.
	
	return $lines;
}

?>
