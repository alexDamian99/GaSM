<?php
define('JWT_KEY', 'GASMSECRETKEY');
define('JWT_ISS', 'http://localhost/api');
define('JWT_AUD', 'http://localhost/api');
define('JWT_IAT', time());
define('JWT_EXP', time() + 3600);