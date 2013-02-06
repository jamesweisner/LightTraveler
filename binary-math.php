<?php

$symbols = array(

	// Bitwise operators.
	'!', // NOT
	'&', // AND
	'|', // OR

);

$lines = array(

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
	'op = op & neg     1 neg     1 neg 1', // -1 & -1 = -1
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

); ?>
