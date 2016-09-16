<?php

$f3=require('lib/base.php');


$f3->config('config.ini');

$f3->config('routes.ini');

new Session();

$f3->run();

