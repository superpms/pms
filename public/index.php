<?php
namespace pms;
require '../vendor/autoload.php';
$http = (new Server(dirname(__DIR__)))->httpWeb;
$http->run();
