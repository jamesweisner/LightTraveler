<?php

$symbols = array(

	// Type definition for a set.
	// The value of a set is its cardinality.
	// Set are unordered lists of unique members.
	'set',
	
	// Set operators.
	'#', // Cardinality
	'U', // Union
	'I', // Intersection
	'C', // Subset
	'R', // Range from A ... B

);

$lines = array(

	// Introduce basic sets.
	'set 0',                                                  // { } (Empty set.)
	'set 1 bin  1',                                           // {1}
	'set 2 bin  2 bin  3',                                    // {2,3}
	'set 3 bin  4 bin  5 bin  6',                             // {4,5,6}
	'set 4 bin  7 bin  8 bin  9 bin 10',                      // {7,8,9,10}
	'set 5 bin 11 bin 12 bin 13 bin 14 bin 15',               // {11,..,15}
	'set 6 bin 16 bin 17 bin 18 bin 19 bin 20 bin 21',        // {16,..,21}
	'set 7 bin 22 bin 23 bin 24 bin 25 bin 26 bin 27 bin 28', // {22,..,28}
	'',
	
	// Playing with sets.
	'set 1 bin 2',                                // { 2 } (Any value.)
	'set 1 bin 3',                                // { 3 }
	'set 1 bin 65535',                            // { 65535 }
	'set 1 scalar inf',                           // { inf } (Even scalars.)
	'set 1 scalar undef',                         // { undef }
	'set 1 set 0',                                // { {} } (Sets in sets.)
	'op = set 2 bin 1 bin 2 set 2 bin 2 bin 1',   // {1,2}={2,1} (No order.)
	'set 5 pulse 1 bin 2 neg 3 scalar inf set 0', // Mixed types.
	'',
	
	// Introduce set cardinality.
	'op = op # set 0 bin 0',              // |{ }|        = 0 (Cardinality.)
	'op = op # set 1 bin 1 bin 1',        // |{ 1 }|      = 1
	'op = op # set 2 bin 1 bin 2 bin 2',  // |{ 1, 2 }|   = 2
	'op = op # set 2 neg 1 neg 2 bin 2',  // |{ -1, -2 }| = 2
	'op = op # set 1 scalar undef bin 1', // |{ undef }|  = 1
	'op = op # set 1 set 0 bin 1',        // |{ {} }|     = 1 (Compound sets.)
	'',
	
	// Introduce union of sets.
	'op = op U set 1 bin 1 set 1 bin 2 set 2 bin 1 bin 2', // {1}U{2} = {1,2}
	'op = op U set 1 bin 2 set 1 bin 1 set 2 bin 1 bin 2', // {2}U{1} = {1,2}
	'op = op U set 1 bin 1 set 1 bin 1 set 1 bin 1',       // {1}U{1} = {1}
	'op = op U set 0 set 1 bin 1 set 1 bin 1',             // {}U{1}  = {1}
	'',
	
	// Introduce intersection of sets.
	'op = op I set 1 bin 1 set 1 bin 1 set 1 bin 1',       // {1}I{1}    = {1}
	'op = op I set 1 bin 1 set 1 bin 2 set 0',             // {1}I{2}    = {}
	'op = op I set 1 bin 2 set 1 bin 1 set 0',             // {2}I{1}    = {}
	'op = op I set 2 bin 1 bin 2 set 1 bin 1 set 1 bin 1', // {1,2}I{1}  = {1}
	'op = op I set 0 set 3 bin 1 bin 2 bin 3 set 0',       // {}I{1,2,3} = {}
	'',
	
	// Introduce subset.
	'op C set 1 bin 1             set 0',                   // {1}     C {}
	'op C set 1 bin 1             set 1 bin 1',             // {1}     C {1}
	'op C set 1 bin 1 bin 2       set 0',                   // {1,2}   C {}
	'op C set 2 bin 1 bin 2       set 1 bin 1',             // {1,2}   C {1}
	'op C set 2 bin 1 bin 2       set 1 bin 2',             // {1,2}   C {2}
	'op C set 2 bin 1 bin 2       set 2 bin 1 bin 2',       // {1,2}   C {1,2}
	'op C set 3 bin 1 bin 2 bin 3 set 0',                   // {1,2,3} C {}
	'op C set 3 bin 1 bin 2 bin 3 set 1 bin 1',             // {1,2,3} C {1}
	'op C set 3 bin 1 bin 2 bin 3 set 1 bin 2',             // {1,2,3} C {2}
	'op C set 3 bin 1 bin 2 bin 3 set 1 bin 3',             // {1,2,3} C {3}
	'op C set 3 bin 1 bin 2 bin 3 set 2 bin 1 bin 2',       // {1,2,3} C {1,2}
	'op C set 3 bin 1 bin 2 bin 3 set 2 bin 1 bin 3',       // {1,2,3} C {1,3}
	'op C set 3 bin 1 bin 2 bin 3 set 2 bin 2 bin 3',       // {1,2,3} C {2,3}
	'op C set 3 bin 1 bin 2 bin 3 set 3 bin 1 bin 2 bin 3', // {1,2,3} C {1,2,3}
	'',
	
	// Introduce range.
	'op = op R bin 0 bin 1 set 2 bin 0 bin 1',             //  0, ...  1
	'op = op R bin 1 bin 2 set 2 bin 1 bin 2',             //  1, ...  2
	'op = op R bin 2 bin 4 set 3 bin 2 bin 3 bin 4',       //  2, ...  4
	'op = op R bin 5 bin 8 set 4 bin 5 bin 6 bin 7 bin 8', //  4, ...  8
	'op = op R bin 1 bin 1 set 1 bin 1',                   //  1, ...  1
	'op = op R neg 1 bin 1 set 3 neg 1 bin 0 bin 1',       // -1, ...  1
	'op = op R neg 1 bin 3 set 3 neg 1 neg 2 neg 3',       // -1, ... -3
	'op = op # op R bin 1 scalar inf scalar inf', // Integers: an infinite set!

); ?>
