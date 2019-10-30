<?php

require 'Engine/Loader.php';

define('ROOT', __DIR__.'/');

use App\Engine\Loader;
use App\Engine\Auth;
use App\Engine\Router;

Loader::run();



Auth::run();

Router::run();

