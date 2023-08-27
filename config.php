<?php

define('BASEDIR', dirname(__FILE__, 0));
define('VIEWS', BASEDIR . '/app/View/');

$_ENV['VIEWS'] = 'app/View/';

$_ENV['db']['host'] = '127.0.0.1';
$_ENV['db']['user'] = 'neto';
$_ENV['db']['pass'] = 'netozicadb';
$_ENV['db']['database'] = 'sistema_login';