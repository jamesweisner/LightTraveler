<?php

$symbols = array_flip(array(

	// Basic types.
	'pulse',  // Number represented by an unbroken sequence of discrete pulses.
			  // Being the zeroth type allows it to serve an obvious separator.
			  // Data is unsigned, ranging from 0 to 15.
	'bin',    // Numbers represented in binary.
			  // Data is unsigned, ranging from 0 to 65535.
	'neg',    // Same as above, but representing negative quantities.
	'scalar', // A class of scalar numbers.
	'op',     // Mathematical operators, in Polish Notation.
	'set',    // Begin a set, followed by its length, and then members.
	'noun',   // Constant defined object of any type.
	'var',    // Variable defined object of any type.
	
	// Scalar classes.
	'def',   // Defined
	'undef', // Undefined
	'inf',   // +Infinity
	'ninf',  // -Infinity
	'true',  // True
	'false', // False
	
	// Math operators.
	'=', // Equals
	'+', // Plus
	'-', // Minus
	'*', // Multiply
	'/', // Divide
	'%', // Modulo
	'>', // Greater than
	'<', // Less than
	
	// Logical operators.
	'test', // Test for truth
	'and',  // And
	'or',   // Or
	'not',  // Not
	
	// Bitwise operators.
	'!', // NOT
	'&', // AND
	'|', // OR
	
	// Set operators.
	'#', // Cardinality
	'U', // Union
	'I', // Intersection
	'C', // Contains
	
	// Special operators.
	'type_of',
	'operands',
	
	// Parts of this language.
	'types',           // Set of basic types of this language.
	'math_operators',  // Set of math operators of this language.
	'bit_operators',   // Set of bitwise operators of this language.
	'set_operators',   // Set of operators of this language that act on sets.
	'other_operators', // Set of special operators in the language.
	'operators',       // Set of all operators in the language.
	'scalars',         // Set of special scalar values in the language.
	'nouns',           // Set of all nouns in the language.
	'variables',       // Set of all labeled variables in the language.
	'symbols',         // Set of all of the symbols in the entire language!
	'scalar_types',    // Set of data types used in math and logic functions.
	
	// Variables.
	'x',
	'y',
	'z',
	
	// Program control?
	
	// Chemistry.
	
	
	// Images.
));

$message = trim(join(' break ', array(

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
	'op = op + bin     1 bin 1 bin     2', //     1 + 1 = 2
	'op = op + bin     1 bin 2 bin     3', //     1 + 2 = 3
	'op = op + bin     1 bin 3 bin     4', //     1 + 3 = 4
	'op = op + bin     1 bin 4 bin     5', //     1 + 4 = 5
	'op = op + bin     1 bin 5 bin     6', //     1 + 5 = 6
	'op = op + bin     1 bin 6 bin     7', //     1 + 6 = 7
	'op = op + bin     1 bin 7 bin     8', //     1 + 7 = 8
	'op = op + bin     1 bin 8 bin     9', //     1 + 8 = 9
	'op = bin 2 op + bin 1 bin 1',         //     2 = 1 + 1 (= is transitive.)
	'op = op + bin     2 bin 1 bin     3', //     2 + 1 = 3 (+ is transitive.)
	'op = op + bin 32767 bin 1 bin 32768', // 32767 + 1 = 32768 (Carrying.)
	'',
	// TODO handle overflow and underflow?
	
	// Introduce subtraction and negative numbers.
	'op = op - bin     2 bin 1 bin     1', //     2 - 1 = 1
	'op = op - bin     5 bin 3 bin     2', //     5 - 3 = 2
	'op = op - bin     5 bin 2 bin     3', //     5 - 2 = 3 (- is intransitive.)
	'op = op - bin 32768 bin 1 bin 32767', // 32768 - 1 = 32767 (Borrowing.)
	'op = op - bin     0 bin 1 neg     1', //     0 - 1 = -1 (Negative numbers.)
	'op = op - bin     1 bin 2 neg     1', //     1 - 2 = -1
	'op = op - bin 1 bin 32768 neg 32767', // 1 - 32768 = -32767
	'op = op + neg     1 neg 1 neg     2', //   -1 + -1 = -2 (Adding negative.)
	'op = op - neg     1 bin 1 neg     2', //   -1 -  1 = -2 (Subtracting pos.)
	'op = bin 0 neg 0',                    //        -0 = 0  (Negative zero.)
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
	
	// Introduce bitwise NOT.
	'op = op ! bin     0 bin 65535', // !  0000000000000000 =  1111111111111111
	'op = op ! bin 65535 bin     0', // !  1111111111111111 =  0000000000000000
	'op = op ! bin 21845 bin 43690', // !  0101010101010101 =  1010101010101010
	'op = op ! bin 43690 bin 21845', // !  1010101010101010 =  0101010101010101
	'op = op ! bin     1 bin 65534', // !  1111111111111110 =  0000000000000001
	'op = op ! bin 65534 bin     1', // !  0000000000000001 =  1111111111111110
	'op = op ! bin 32768 bin 32767', // !  1000000000000000 =  0111111111111111
	'op = op ! bin 32767 bin 32768', // !  0111111111111111 =  1000000000000000
	'op = op ! bin 11742 bin 53793', // !  0010110111011110 =  1101001000100001
	'op = op ! bin 53793 bin 11742', // !  1101001000100001 =  0010110111011110
	'op = op ! neg     1 neg 65534', // ! -1111111111111110 = -0000000000000001
	'',
	
	// Introduce bitwise AND.
	'op = op & bin 1 bin 0 bin 0', // 1 & 0 = 0
	'op = op & bin 1 bin 1 bin 1', // 1 & 1 = 1
	'op = op & bin 1 bin 2 bin 0', // 1 & 2 = 0
	'op = op & bin 1 bin 4 bin 0', // 1 & 4 = 0
	'op = op & bin 1 bin 8 bin 0', // 1 & 8 = 0
	'op = op & bin 2 bin 0 bin 0', // 2 & 0 = 0
	'op = op & bin 2 bin 1 bin 0', // 2 & 1 = 0
	'op = op & bin 2 bin 2 bin 2', // 2 & 2 = 2
	'op = op & bin 2 bin 4 bin 0', // 2 & 4 = 0
	'op = op & bin 2 bin 8 bin 0', // 2 & 8 = 0
	'op = op & bin 4 bin 0 bin 0', // 4 & 0 = 0
	'op = op & bin 4 bin 1 bin 0', // 4 & 1 = 0
	'op = op & bin 4 bin 2 bin 0', // 4 & 2 = 0
	'op = op & bin 4 bin 4 bin 4', // 4 & 4 = 4
	'op = op & bin 4 bin 8 bin 0', // 4 & 8 = 0
	'op = op & bin 8 bin 0 bin 0', // 8 & 0 = 0
	'op = op & bin 8 bin 1 bin 0', // 8 & 1 = 0
	'op = op & bin 8 bin 2 bin 0', // 8 & 2 = 0
	'op = op & bin 8 bin 4 bin 0', // 8 & 4 = 0
	'op = op & bin 8 bin 8 bin 8', // 8 & 8 = 8
	'op = op & bin 65535 bin     0 bin 0',     // 1111111111111111 & 0 = 0
	'op = op & bin 65535 bin     1 bin 0',     // 1111111111111111 & 1 = 1
	'op = op & bin 65535 bin     2 bin 0',     // 1111111111111111 & 2 = 2
	'op = op & bin 65535 bin     4 bin 0',     // 1111111111111111 & 4 = 4
	'op = op & bin 65535 bin     8 bin 0',     // 1111111111111111 & 8 = 8
	'op = op & bin 65535 bin 32768 bin 32768', // 1111111111111111 & X = X
	'op = op & bin 32768 bin 32767 bin 0', // 1000000000000000 & 0111111111111111
	'op = op & bin   255 bin 65280 bin 0', // 0000000011111111 & 1111111100000000
	'',
	
	// Introduce bitwise OR.
	'op = op | bin 1 bin 0 bin 1', // 1 | 0 = 1
	'op = op | bin 1 bin 1 bin 1', // 1 | 1 = 1
	'op = op | bin 1 bin 2 bin 3', // 1 | 2 = 3
	'op = op | bin 1 bin 4 bin 5', // 1 | 4 = 5
	'op = op | bin 2 bin 0 bin 2', // 2 | 0 = 2
	'op = op | bin 2 bin 1 bin 3', // 2 | 1 = 3
	'op = op | bin 2 bin 2 bin 2', // 2 | 2 = 2
	'op = op | bin 2 bin 4 bin 6', // 2 | 4 = 6
	'op = op | bin 4 bin 0 bin 4', // 4 | 0 = 4
	'op = op | bin 4 bin 1 bin 5', // 4 | 1 = 5
	'op = op | bin 4 bin 2 bin 6', // 4 | 2 = 6
	'op = op | bin 4 bin 4 bin 4', // 4 | 4 = 4
	'op = op | bin     0 bin     0 bin     0', //      0 |      0 = 0
	'op = op | bin 65535 bin     0 bin 65535', //  65535 |      0 = 65535
	'op = op | bin 65535 bin 65535 bin 65535', //  65535 |  65535 = 65535
	'op = op | bin   255 bin 65280 bin 65535', //    255 |  65280 = 65535
	'op = op | neg 32768 neg 32767 neg 65535', // -32768 | -32767 = -65535
	'',
	
	// Introduce basic sets.
	'set 0',                                           // { } (Empty set.)
	'set 1 bin 1',                                     // { 1 }
	'set 2 bin 1 bin 2',                               // { 1, 2 }
	'set 3 bin 1 bin 2 bin 3',                         // { 1, 2, 3 }
	'set 4 bin 1 bin 2 bin 3 bin 4',                   // { 1, 2, 3, 4 }
	'set 5 bin 1 bin 2 bin 3 bin 4 bin 5',             // { 1, 2, 3, 4, 5 }
	'set 6 bin 1 bin 2 bin 3 bin 4 bin 5 bin 6',       // { 1, 2, 3, 4, 5, 6 }
	'set 7 bin 1 bin 2 bin 3 bin 4 bin 5 bin 6 bin 7', // { 1, 2, 3, 4, 5, 6, 7 }
	'',
	
	// Playing with sets.
	'set 1 bin 2',                                     // { 2 } (Any value.)
	'set 1 bin 3',                                     // { 3 }
	'set 1 bin 65535',                                 // { 65535 }
	'set 1 bin scalar inf',                            // { inf } (Even scalars.)
	'set 1 bin scalar undef',                          // { undef }
	'set 1 set 0',                                     // { {} } (Sets in sets.)
	'op = set 2 bin 1 bin 2 set 2 bin 2 bin 1',        // {1,2}={2,1} (No order.)
	'set 5 pulse 1 bin 2 neg 3 scalar inf set 0',      // Mixed types.
	'',
	
	// Cardinality.
	'op = op # set 0 bin 0',              // |{ }|        = 0 (Cardinality.)
	'op = op # set 1 bin 1 bin 1',        // |{ 1 }|      = 1
	'op = op # set 2 bin 1 bin 2 bin 2',  // |{ 1, 2 }|   = 2
	'op = op # set 2 neg 1 neg 2 bin 2',  // |{ -1, -2 }| = 2
	'op = op # set 1 scalar undef bin 1', // |{ undef }|  = 1
	'op = op # set 1 set 0 bin 1',        // |{ {} }|     = 1 (Compound sets.)
	'',
	
	// Union.
	'op = op U set 1 bin 1 set 1 bin 2 set 2 bin 1 bin 2', // {1}U{2} = {1,2}
	'op = op U set 1 bin 2 set 1 bin 1 set 2 bin 1 bin 2', // {2}U{1} = {1,2}
	'op = op U set 1 bin 1 set 1 bin 1 set 1 bin 1',       // {1}U{1} = {1}
	'op = op U set 0 set 1 bin 1 set 1 bin 1',             // {}U{1}  = {1}
	'',
	
	// Intersection.
	// TODO
	
	// Contains.
	// TODO
	
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
	// Notice that the type var has not been introduced yet!
	// Get used to foreshadowing from now on.
	// Show that set operators can be applied to nouns that are sets.
	'op = noun types set 8
		noun pulse
		noun bin
		noun neg
		noun scalar
		noun op
		noun set
		noun noun
		noun var
	',
	'op C noun types noun pulse',
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
	'op = noun other_operators set 2
		noun type_of
		noun operands
	',
	'',
	
	// Set of all operators.
	// Hint at cardinality of this large set.
	'op = noun operators op U op U op U
		noun math_operators
		noun bit_operators
		noun set_operators
		noun other_operators
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
		noun variables
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
		noun variables
	',
	'op C noun symbols set 1 noun symbols',
	'',
	
	// Only these data types may be used in math and logic functions.
	'op = noun scalar_types set 4
		noun pulse
		noun bin
		noun neg
		noun scalar
	',
	
	// Describe the operands of each operator.
	'op = op operands =        set 2 noun scalar_types noun scalar_types',
	'op = op operands +        set 2 noun scalar_types noun scalar_types',
	'op = op operands -        set 2 noun scalar_types noun scalar_types',
	'op = op operands *        set 2 noun scalar_types noun scalar_types',
	'op = op operands /        set 2 noun scalar_types noun scalar_types',
	'op = op operands %        set 2 noun scalar_types noun scalar_types',
	'op = op operands >        set 2 noun scalar_types noun scalar_types',
	'op = op operands <        set 2 noun scalar_types noun scalar_types',
	'op = op operands test     set 1 set 1 noun scalar',
	'op = op operands and      set 2 set 1 noun scalar',
	'op = op operands or       set 2 set 1 noun scalar',
	'op = op operands not      set 1 set 1 noun scalar',
	'op = op operands !        set 1 set 1 noun bin',
	'op = op operands &        set 2 set 1 noun bin set 1 noun bin',
	'op = op operands |        set 2 set 1 noun bin set 1 noun bin',
	'op = op operands #        set 1 set 1 noun set',
	'op = op operands U        set 2 set 1 noun set set 1 noun set',
	'op = op operands I        set 2 set 1 noun set set 1 noun set',
	'op = op operands C        set 2 set 1 noun set set 2 noun set scalar_types',
	'op = op operands type_of  set 1 set 1 noun nouns',
	'op = op operands operands set 1 set 1 noun nouns',
	'',
	
	// Variables???
	'op C noun variables set 3
		noun x
		noun y
		noun z
	',
	
	// Introduce checksum?
	// Introduce chemical elements by atomic number.
	// Organize elements in a periodic table struct?
	// Introduce isotopes of each chemical element.
	// Introduce electron orbitals in each element.
	// Music, images, etc.
)));

$mode = isset($_GET['mode']) ? (int) $_GET['mode'] : 2;

if($mode == 4) header('Content-disposition: attachment; filename="message.dat"');
else           header('Content-type: text/plain');

foreach(preg_split('/\s+/', $message) as $token)
{
	if($token == 'break')
	{
		switch($mode)
		{
			case 3:  echo            "ffffffff"; break;
			case 4:  echo pack('N', 0xFFFFFFFF); break;
			default: echo "\n";                  break;
		}
		continue;
	}
	if(is_numeric($token))
		$symbol = (int) $token;
	else if(isset($symbols[$token]))
		$symbol = $symbols[$token];
	else
		die("Token [$token] not found: " . implode(' ', array_keys($symbols)));
	switch($mode)
	{
		case 0: echo str_pad(       $token,   16, ' ', STR_PAD_LEFT); break;
		case 1: echo str_pad(       $symbol,  16, ' ', STR_PAD_LEFT); break;
		case 2: echo str_pad(decbin($symbol), 16, '0', STR_PAD_LEFT); break;
		case 3: echo str_pad(dechex($symbol),  4, '0', STR_PAD_LEFT); break;
		case 4: echo pack('n', $symbol);                              break;
	}
	if($mode < 3) echo ' ';
}
