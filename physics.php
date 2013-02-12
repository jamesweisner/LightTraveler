<?php

require_once 'tools/math.php';

// http://en.wikipedia.org/wiki/List_of_particles
// http://en.wikipedia.org/wiki/File:Standard_Model_of_Elementary_Particles.svg

$mass_planck = 1.221e22; // MeV.

$symbols = array(

	// Names.
	'particles',
	'quarks',
	'leptons',
	'bosons',
	'left_handed',
	'right_handed',
	'matter',
	'antimatter',
	
	// Types.
	'particle',
	'isospin',
	'e_charge',
	'w_charge',
	'l_charge',
	'mass',

);

$lines = array(

	// Introduce particles.
	'op = op # noun particles bin 53',
	'op C noun particles op U op U
		noun quarks
		noun leptons
		noun bosons
	',
	
	// u, c, t, u_, c_, t_, d, s, b, d_, s_, b_ (12 left-handed, 12 right-handed)
	'op C noun quarks op R particle 1 particle 24',
	
	// Left-handed:  e-, u-, t-, e+, u+, t+, ve,  vu,  vt, (9)
	// Right-handed: e-, u-, t-, e+, u+, t+, ve_, vu_, vt_ (9)
	'op C noun leptons op R particle 25 particle 42',
	
	// Left-handed:  W+, W-, Z, (3)
	// No-handed:    g, y, G, H (4)
	// Right-handed: W+, W-, Z (3)
	'op C noun bosons op R particle 43 particle 52',
	'',
	
	// Introduce chirality.
	'op = noun left_handed op U op U
		op R particle  1 particle 12
		op R particle 25 particle 33
		op R particle 43 particle 45
	',
	'op = noun right_handed op U
		op I op U noun quarks noun leptons noun left_handed
		op R particle 50 particle 52',
	'',
	
	// Introduce antimatter.
	'op = noun antimatter op I noun particles noun matter',
	'op = noun     matter op U op U op U op U op U op U
		op R particle  1 particle  3
		op R particle  7 particle  9
		op R particle 13 particle 15
		op R particle 19 particle 21
		op R particle 25 particle 27
		op R particle 31 particle 37
		op I op R noun bosons set 2 particle 44 particle 51
	',
	'',
	
	// Introduce isospin.
	'op = op isospin op U noun quarks noun leptons op / bin 1 bin 2',       // 1/2
	'op = op isospin op I noun bosons set 2 particle 48 particle 49 bin 1', // 1
	'op = op isospin set 2 particle 48 bin 2',                              // 2 G
	'op = op isospin set 2 particle 49 bin 0',                              // 0 H
	'',
	
	// Introduce electric charge.
	'op = op e_charge op R particle  1 particle  3 op / bin 2 bin 3', // +2/3
	'op = op e_charge op R particle  4 particle  6 op / neg 2 bin 3', // -2/3
	'op = op e_charge op R particle  7 particle  9 op / bin 1 bin 3', // +1/3
	'op = op e_charge op R particle 10 particle 12 op / neg 1 bin 3', // -1/3
	'op = op e_charge op R particle 13 particle 18 bin 0',            //   0
	'op = op e_charge op R particle 19 particle 24 neg 1',            //  -1
	'op = op e_charge op R particle 27 particle 31 bin 0',            //   0
	'op = op e_charge set 1 particle 25 bin 1',                       //  +1
	'op = op e_charge set 1 particle 26 neg 1',                       //  -1
	'',
	
	// Introduce weak isospin. Damn.
	// http://en.wikipedia.org/wiki/File:Standard_Model.svg
	// http://en.wikipedia.org/wiki/Weak_isospin#Weak_isospin_and_the_W_bosons
	
	// +1/2 (Left: u, c, t, ve, vu, vt. Right: d_, s_, b_, e+, u+, t+.) 
	'op = op w_charge op U
		op R particle  1 particle  3
		op R particle 22 particle 24
		op R particle 31 particle 33
		op R particle 37 particle 39
	op / bin 1 bin 2',
	
	// -1/2 (Left: d, s, b, e-, u-, t-. Right: u_, c_, t_, ve_, vu_, vt_.)
	'op = op w_charge op U
		op R particle  7 particle  9
		op R particle 16 particle 18
		op R particle 25 particle 27
		op R particle 40 particle 42
	op / neg 1 bin 2',
	
	// +1, -1 (W+, W-).
	'op = op w_charge set 2 particle 43 particle 50 bin 1',
	'op = op w_charge set 2 particle 44 particle 51 neg 1',
	
	// 0 (Everything else!)
	'op = op w_charge op U op U op U op U op U op U
		op R particle  4 particle  6
		op R particle 10 particle 15
		op R particle 19 particle 21
		op R particle 28 particle 30
		op R particle 34 particle 36
		op R particle 45 particle 49
		set 1 particle 52
	bin 0',
	'',
	
	// Introduce lepton number.
	'op = op l_charge op I noun leptons noun     matter bin 1',
	'op = op l_charge op I noun leptons noun antimatter neg 1',
	
	// Introduce particle masses!
	'op = op mass set 2 particle 46 particle 48 bin 0', // Zero rest mass for g, y, and G.
	'op = op mass set 4 particle  1 particle  4 particle 13 particle 16 ' . scientific_notation(     2.011 / $mass_planck), //  u =  2.01 MeV
	'op = op mass set 4 particle  2 particle  5 particle 14 particle 17 ' . scientific_notation(  1292.216 / $mass_planck), //  c =  1.29 GeV
	'op = op mass set 4 particle  3 particle  6 particle 15 particle 18 ' . scientific_notation(172939.827 / $mass_planck), //  t = 172.9 GeV
	'op = op mass set 4 particle  7 particle 10 particle 19 particle 22 ' . scientific_notation(     4.793 / $mass_planck), //  d =  4.79 MeV
	'op = op mass set 4 particle  8 particle 11 particle 20 particle 23 ' . scientific_notation(  4180.154 / $mass_planck), //  b =  4.18 GeV
	'op = op mass set 4 particle  9 particle 12 particle 21 particle 24 ' . scientific_notation(    95.028 / $mass_planck), //  s =    95 MeV
	'op = op mass set 4 particle 25 particle 28 particle 34 particle 37 ' . scientific_notation(     0.511 / $mass_planck), // e- = 0.511 MeV
	'op = op mass set 4 particle 26 particle 29 particle 35 particle 38 ' . scientific_notation(   105.774 / $mass_planck), // u- = 105.7 MeV
	'op = op mass set 4 particle 27 particle 30 particle 36 particle 39 ' . scientific_notation(  1777.172 / $mass_planck), // t- = 1.777 GeV
	'op = op mass set 2 particle 31 particle 40 '                         . scientific_notation(1.48981e-6 / $mass_planck), // ve = ~1.49 eV (fictional)
	'op = op mass set 2 particle 32 particle 41 '                         . scientific_notation(1.43107e-6 / $mass_planck), // vu = ~1.43 eV (fictional)
	'op = op mass set 2 particle 33 particle 42 '                         . scientific_notation(1.44876e-6 / $mass_planck), // vt = ~1.45 eV (fictional)
	'op = op mass set 4 particle 43 particle 44 particle 50 particle 51 ' . scientific_notation( 80385.198 / $mass_planck), //  W =  80.385  GeV
	'op = op mass set 2 particle 45 particle 52 '                         . scientific_notation( 91187.625 / $mass_planck), //  Z =  91.1876 GeV
	'op = op mass set 1 particle 49 '                                     . scientific_notation(125309.392 / $mass_planck), //  H = 125.3    GeV

);

?>
