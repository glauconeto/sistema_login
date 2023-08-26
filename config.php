<?php

define('BASEDIR', dirname(__FILE__, 2));
define('VIEWS', BASEDIR . '/app/View/');

$_ENV['db']['host'] = 'localhost';
$_ENV['db']['user'] = 'neto';
$_ENV['db']['pass'] = 'netozicadb';
$_ENV['db']['database'] = 'sistema_login';