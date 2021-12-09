<?php

require_once 'app/core/Core.php';
require_once 'app/controller/LoginController.php';
require_once 'vendor/autoload.php';

$core = new Core;
echo $core->start($_GET);