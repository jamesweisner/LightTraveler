<?php

$symbols = array(

	// Basic types.
	'pulse',  // Number represented by an unbroken sequence of discrete pulses.
	          // Being the zeroth type allows it to serve an obvious separator.
	          // Data is unsigned, ranging from 0 to 15.
	'bin',    // Numbers represented in binary.
	          // Data is unsigned, ranging from 0 to 65535.
	'neg',    // Same as above, but representing negative quantities.
	'scalar', // A class of scalar numbers.
	'op',     // Mathematical operators, in Polish Notation.
	
	// Scalar classes.
	'def',   // Defined
	'undef', // Undefined
	'inf',   // +Infinity
	'ninf',  // -Infinity
	'true',  // True
	'false', // False
	'i',     // Imaginary
	
	// Math operators.
	'=', // Equals
	'+', // Plus
	'-', // Minus
	'*', // Multiply
	'/', // Divide
	'%', // Modulo
	'>', // Greater than
	'<', // Less than
	'^', // Power
	
	// Logical operators.
	'test', // Test for truth
	'and',  // And
	'or',   // Or
	'not',  // Not

);

$lines = array(

	// Introduce natural numbers by counting pulses.
	'pulse     1', // 1
	'pulse     3', // 2
	'pulse     7', // 3
	'pulse    15', // 4
	'pulse    31', // 5
	'pulse    63', // 6
	'pulse   127', // 7
	'pulse   255', // 8
	'pulse   511', // 9
	'pulse  1023', // 10
	'pulse  2047', // 11
	'pulse  4095', // 12
	'pulse  8191', // 13
	'pulse 16383', // 14
	'pulse 32767', // 15
	'pulse 65535', // 16
	'',
	
	// Introduce binary numbers.
	'bin 1', 'bin  2', 'bin  3', 'bin  4', 'bin  5', 'bin  6', 'bin  7', 'bin 8',
	'bin 9', 'bin 10', 'bin 11', 'bin 12', 'bin 13', 'bin 14', 'bin 15', 'bin 16',
	'',
	
	// Introduce equality and binary.
	'op = pulse     1 bin     1', //  1 pulse  = 1 (Conversion of types.)
	'op = pulse     3 bin     2', //  2 pulses = 2
	'op = pulse     7 bin     3', //  3 pulses = 3
	'op = pulse    15 bin     4', //  4 pulses = 4
	'op = pulse    31 bin     5', //  5 pulses = 5
	'op = pulse    63 bin     6', //  6 pulses = 6
	'op = pulse   127 bin     7', //  7 pulses = 7
	'op = pulse   255 bin     8', //  8 pulses = 8
	'op = pulse 65535 bin    16', // 16 pulses = 16
	'op = pulse     1 pulse   1', //  1 pulse  = 1 pulse (Same type equality.)
	'op = bin      17 bin    17', //        17 = 17      (New binary number.)
	'op = bin   65535 bin 65535', //     65535 = 65535   (Largest binary number.)
	'op = pulse     0 bin     0', //  0 pulses = 0       (Concept of zero.)
	'',
	
	// Introduce addition.
	'op = op + bin     1 bin 1 bin     2',  //     1 + 1 = 2
	'op = op + bin     1 bin 2 bin     3',  //     1 + 2 = 3
	'op = op + bin     1 bin 3 bin     4',  //     1 + 3 = 4
	'op = op + bin     1 bin 4 bin     5',  //     1 + 4 = 5
	'op = op + bin     1 bin 5 bin     6',  //     1 + 5 = 6
	'op = op + bin     1 bin 6 bin     7',  //     1 + 6 = 7
	'op = op + bin     1 bin 7 bin     8',  //     1 + 7 = 8
	'op = op + bin     1 bin 8 bin     9',  //     1 + 8 = 9
	'op = bin 2 op + bin 1 bin 1',          //     2 = 1 + 1 (= is transitive.)
	'op = op + bin     2 bin 1 bin     3',  //     2 + 1 = 3 (+ is transitive.)
	'op = op + bin 32767 bin 1 bin 32768',  // 32767 + 1 = 32768 (Carrying.)
	'',
	
	// Introduce subtraction and negative numbers.
	'op = op - bin     2 bin 1 bin     1',   //     2 - 1 = 1
	'op = op - bin     5 bin 3 bin     2',   //     5 - 3 = 2
	'op = op - bin     5 bin 2 bin     3',   //     5 - 2 = 3 (- is intransitive.)
	'op = op - bin 32768 bin 1 bin 32767',   // 32768 - 1 = 32767 (Borrowing.)
	'op = op - bin     0 bin 1 neg     1',   //     0 - 1 = -1 (Negative numbers.)
	'op = op - bin     1 bin 2 neg     1',   //     1 - 2 = -1
	'op = op - bin 1 bin 32768 neg 32767',   // 1 - 32768 = -32767
	'op = op + neg     1 neg 1 neg     2',   //   -1 + -1 = -2 (Adding negative.)
	'op = op - neg     1 bin 1 neg     2',   //   -1 -  1 = -2 (Subtracting pos.)
	'op = bin 0 neg 0',                      //        -0 = 0  (Negative zero.)
	'',
	
	// Introduce multiplication and chained operations.
	'op = op * bin 2 bin 3 bin 6',  // 2 * 3 = 6
	'op = op * bin 3 bin 2 bin 6',  // 3 * 2 = 6 (* is transitive.)
	'op = op * bin 3 bin 5 bin 15', // 3 * 5 = 15
	'op = op * op * bin 15 bin 17 bin 257 bin 65535', // (15 * 17) * 257 = 65535
	'op = op * bin 2 neg 3 neg 6', //  2 * -3 = -6 (Negative multiplication.)
	'op = op * neg 2 neg 3 bin 6', // -2 * -3 =  6 (Minus signs cancel.)
	'',
	
	// Introduce division and undefined.
	'op = op / bin 6 bin 3 bin 2', // 6 / 3 = 2
	'op = op / bin 6 bin 2 bin 3', // 6 / 2 = 3
	'op = op / op / bin 65535 bin 257 bin 255 bin 1', // (65535 / 257) / 255 = 1
	'op = op / bin     0 bin 65535 bin 0',        //     0 / 65535 = 0
	'op = op / bin     0 bin     1 bin 0',        //     0 /     1 = 0
	'op = op / bin     0 bin     0 scalar undef', //     0 /     0 = undefined
	'op = op / bin     1 bin     0 scalar inf',   //     1 /     0 = infinity
	'op = op / bin 65535 bin     0 scalar inf',   // 65535 /     0 = infinity
	'op = op / neg 6 bin 2 neg 3', // -6 /  2 = -3 (Signed division.)
	'op = op / bin 6 neg 2 neg 3', //  6 / -2 = -3
	'op = op / neg 6 neg 2 bin 3', // -6 / -2 =  3
	'op = op / neg 1 bin 0 scalar ninf', // -1 / 0 = -infinity (Minus infinity.)
	'',
	
	// Playing with infinity.
	'op = op + scalar inf scalar inf scalar inf',   // inf + inf = inf
	'op = op - scalar inf scalar inf scalar undef', // inf - inf = undefined
	'op = op * scalar inf scalar inf scalar inf',   // inf * inf = inf
	'op = op / scalar inf scalar inf scalar undef', // inf / inf = undefined
	'',
	
	// Introduce modulo.
	'op = op % bin 2 bin 3 bin 2', // 2 % 3 = 1
	'op = op % bin 3 bin 2 bin 1', // 3 % 2 = 1
	'op = op % bin 6 bin 2 bin 0', // 6 % 2 = 0
	'op = op % bin 6 bin 3 bin 0', // 6 % 3 = 0
	'op = op % bin 7 bin 5 bin 2', // 7 % 5 = 2
	'',
	
	// Introduce greater than.
	'op > bin 2 bin 1', //  2 >  1
	'op > bin 1 bin 0', //  1 >  0
	'op > bin 0 neg 1', //  0 > -1
	'op > neg 1 neg 2', // -1 > -2
	'',
	
	// Introduce less than.
	'op < bin 2 bin 1', //  1 <  2
	'op < bin 1 bin 0', //  0 <  1
	'op < bin 0 neg 1', // -1 <  0
	'op < neg 1 neg 2', // -2 > -1
	'',
	
	// Introduce true and false.
	'op test op = bin 1 bin 1 scalar true',  // (1 = 1) is true
	'op test op = bin 2 bin 2 scalar true',  // (2 = 2) is true
	'op test op = bin 1 bin 2 scalar false', // (1 = 2) is false
	'op test op > bin 2 bin 1 scalar true',  // (1 > 2) is true
	'op test op < bin 2 bin 1 scalar false', // (1 < 2) is false
	'op test op > bin 1 bin 1 scalar false', // (1 > 1) is false
	'op test op < bin 1 bin 1 scalar false', // (1 < 1) is false
	'op test scalar true  scalar true',      // (true)  is true
	'op test scalar false scalar false',     // (false) is false
	
	// Introduce logical and.
	'op test op and scalar true  scalar true  scalar true',  // (t and t) is true
	'op test op and scalar true  scalar false scalar false', // (t and f) is false
	'op test op and scalar false scalar true  scalar false', // (f and t) is false
	'op test op and scalar false scalar false scalar false', // (f and f) is false
	'op test op and scalar true  scalar inf   scalar undef', // (t and i) is undef
	'op test op and scalar true  scalar undef scalar undef', // (t and i) is undef
	
	// Introduce logical or.
	'op test op or scalar true  scalar true  scalar true',  // (t or t) is true
	'op test op or scalar true  scalar false scalar false', // (t or f) is true
	'op test op or scalar false scalar true  scalar false', // (f or t) is true
	'op test op or scalar false scalar false scalar false', // (f or f) is false
	'op test op or scalar true  scalar inf   scalar undef', // (t or i) is undef
	'op test op or scalar true  scalar undef scalar undef', // (t or i) is undef
	
	// Introduce logical not and intuitive leap to the concept of "defined".
	'op test not scalar true  scalar false', // (not t) is false
	'op test not scalar false scalar true',  // (not f) is true
	'op test not scalar inf   scalar undef', // (not infinity) is undef
	'op test not scalar undef scalar def',   // (not undef) is defined! holy shit!
	'op test not scalar undef scalar def',   // Pay attention to this! Mind blown?
	'',
	
	// Introduce exponents.
	'op = op ^ bin 2 bin  0 bin 1',         // 2^0  = 1
	'op = op ^ bin 2 bin  1 bin 2',         // 2^1  = 2
	'op = op ^ bin 2 bin  2 bin 4',         // 2^2  = 4
	'op = op ^ bin 2 bin  3 bin 8',         // 2^3  = 8
	'op = op ^ bin 1 bin  3 bin 1',         // 1^3  = 1
	'op = op ^ bin 3 bin  3 bin 27',        // 3^3  = 27
	'op = op ^ bin 2 bin 15 bin 32768',     // 2^15 = 32768
	'op = op ^ bin 0 bin  7 bin 0',         // 0^7  = 0
	'op = op ^ bin 0 bin  0 bin 1',         // 0^0  = 1
	'op < op ^ 65535 bin 65535 scalar inf', // 65535^65535 < inf

	// Introduce complex numbers.
	'op = op ^ bin 4 op / bin 1 bin 2 bin 2',    // 4^(1/2) = sqrt(4) = 2
	'op = op ^ bin 5 neg 2 op / bin 2 bin 25',   // 5^-2 = 1 / 25
	'op = op ^ neg 1 bin 2 bin 1',               // (-1)^2 =  1
	'op = op ^ neg 1 bin 3 neg 1',               // (-1)^3 = -1
	'op = op ^ neg 1 op / bin 1 bin 2 scalar i', // sqrt(-1) = i
	'op = op * scalar i scalar i neg 1',         // i^2 = -1

); ?>
