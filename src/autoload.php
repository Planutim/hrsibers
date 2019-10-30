<?php

require 'Engine/Loader.php';

define('ROOT', __DIR__.'/');

use App\Engine\Loader;
use App\Engine\Router;
use App\Controller\AdminController as TA;


Loader::run();
Router::run();

