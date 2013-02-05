<?php

$symbols = array(

	// Linguistic data types.
	'noun',
	
	// Linguistic operators.
	'type_of',
	
	// Parts of the language.
	'types',           // Set of basic types of this language.
	'math_operators',  // Set of math operators of this language.
	'bit_operators',   // Set of bitwise operators of this language.
	'set_operators',   // Set of operators of this language that act on sets.
	'other_operators', // Set of special operators in the language.
	'operators',       // Set of all operators in the language.
	'scalars',         // Set of special scalar values in the language.
	'nouns',           // Set of all nouns in the language.
	'symbols',         // Set of all of the symbols in the entire language!
	'scalar_types',    // Set of data types used in math and logic functions.

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
	'op = op type_of pulse      0 noun pulse',
	'op = op type_of bin        0 noun bin',
	'op = op type_of neg        0 noun neg',
	'op = op type_of scalar   def noun scalar',
	'op = op type_of set        0 noun set',
	'op = op type_of op         = noun op',
	'op = op type_of noun    noun noun noun', // Self-reference!
	'op = op type_of noun    noun noun noun', // Very important!
	'',
	
	// Define a noun using a set.
	// Show that set operators can be applied to nouns that are sets.
	'op = noun types set 8
		noun pulse
		noun bin
		noun neg
		noun scalar
		noun op
		noun set
		noun noun
	',
	'op C noun types set 1 noun pulse',
	'',
	
	// Define nouns for the types of operators.
	'op = noun math_operators set 7
		noun +
		noun -
		noun *
		noun /
		noun %
		noun <
		noun >
	',
	'op = noun bit_operators set 4
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
	
	// Set of all operators.
	// Hint at cardinality of this large set.
	'op = noun operators op U op U op U
		noun math_operators
		noun bit_operators
		noun set_operators
		noun set 1 noun type_of
	',
	'op = op # noun operators bin 17',
	'',
	
	// Set of all scalars.
	'op = noun scalars set 5
		noun def
		noun undef
		noun inf
		noun ninf
		noun true
		noun false
	',
	
	// Set of all nouns, partially defined here.
	// Self as member of a set!
	'op C noun nouns set 6
		noun pulse
		noun noun
		noun type_of
		noun math_operators
		noun operators
		noun nouns
		noun symbols
	',
	'op C nouns set 1 noun nouns',
	
	// All the symbols in the language!
	// Self as member of a set.
	'op C noun symbols op U op U op U op U
		noun types
		noun operators
		noun scalars
		noun nouns
	',
	'op C noun symbols set 1 noun symbols',
	'',

); ?>
