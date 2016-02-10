<?php

// Db definition
define('DB_SERVER', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) ? 'localhost' : '');
define('DB_USER', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) ? 'root' : '');
define('DB_PASS', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) ? '' : '');
define('DB_DB', in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) ? 'joc' : '');


// Game definitions
define('start_vision', 4);// cells around him
define('delay_slow', 20);// seconds
define('delay_normal', 5);// seconds
define('delay_fast', 10);// seconds


?>