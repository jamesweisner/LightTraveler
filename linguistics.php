<?php

$symbols = array(

	// Linguistic data types.
	'noun',
	
	// Linguistic operators.
	'type_of',
	
	// Parts of the language.
	'types',           // Set of basic types of this language.
	'math_operators',  // Set of math operators of this language.
	'bool_operators',  // Set of boolean operators of the language.
	'bit_operators',   // Set of bitwise operators of this language.
	'set_operators',   // Set of operators of this language that act on sets.
	'operators',       // Set of all operators in the language.
	'scalars',         // Set of special scalar values in the language.
	'symbols',         // Set of all of the symbols in the entire language!

);

$lines = array(

	// List all basic data types.
	'noun pulse',
	'noun bin',
	'noun neg',
	'noun scalar',
	'noun op',
	'noun set',
	'noun noun',
	'',
	
	// By example, introduce the operator to get the type of a thing.
	'op = op type_of pulse   0 noun pulse',
	'op = op type_of bin     0 noun bin',
	'op = op type_of neg     0 noun neg',
	'op = op type_of scalar  0 noun scalar',
	'op = op type_of set     0 noun set',
	'op = op type_of op      0 noun op',
	'op = op type_of noun    0 noun noun', // Self-reference!
	'op = op type_of noun    0 noun noun', // Very important!
	'',
	
	// Define set of all data types, list those encountered so far.
	// Hint at more to come.
	'op C noun types set 8
		noun pulse
		noun bin
		noun neg
		noun scalar
		noun op
		noun set
		noun noun
	',
	'op > op # types bin 8',
	'',
	
	// Define the different types of operators.
	'op = noun math_operators set 8
		noun =
		noun +
		noun -
		noun *
		noun /
		noun %
		noun <
		noun >
	',
	'op = noun bool_operators set 4
		noun test
		noun and
		noun or
		noun not
	',
	'op = noun bit_operators set 3
		noun !
		noun &
		noun |
	',
	'op = noun set_operators set 4
		noun #
		noun U
		noun I
		noun C
	',
	'',
	
	// Define set of all operators, list those encountered so far.
	// Hint at more to come.
	'op C noun operators op U op U op U op U
		noun math_operators
		noun bool_operators
		noun bit_operators
		noun set_operators
		set 1 noun type_of
	',
	'op > op # noun operators bin 20',
	'',
	
	// Define the set of all scalars.
	'op = noun scalars set 6
		noun def
		noun undef
		noun inf
		noun ninf
		noun true
		noun false
	',
	'',
	
	// Define set of all the symbols in the language!
	// Self as member of a set!
	'op C noun symbols op U op U op U
		noun types
		noun operators
		noun scalars
		set 1 noun symbols
	',
	'op C noun symbols set 1 noun symbols',
	'op C noun symbols set 1 noun symbols',
	'',

	// There can be no more than 65535 symbols in this language.
	'op < op # symbols bin 65535',
	'',

); ?>
