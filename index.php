<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Core;

$core = new Core;
$core->start($_GET);