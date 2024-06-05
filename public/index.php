<?php
namespace pms;
require '../vendor/autoload.php';
(new App(dirname(__DIR__)))->httpWeb;
