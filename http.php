<?php
namespace pms;
require './vendor/autoload.php';
$http = (new Server(__DIR__))->httpSwoole;
$http->run();
