<?php

require 'Engine/Loader.php';

define('ROOT', __DIR__.'/');

use App\Engine\Loader;
use App\Engine\Router;
use App\Engine\Auth;


Loader::run();

Router::run();
Auth::run();

