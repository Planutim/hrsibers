<?php

namespace App\Engine;

use App\Controller\AdminController;

class Router{
  
  private static $Controller;

  public static function run(){

    $Controller = new AdminController();
    $uri = $_SERVER['REQUEST_URI'];


    try{
      switch($uri){
        case '/':
          $Controller->index();break;
        case '/test':
          $Controller->test();break;
        case '/add':
          $Controller->addUser();break;
        case preg_match('/\/edit\?id=.+/',$uri)?true:false: // /edit?id=blabla
          $Controller->editUser();break;
        case preg_match('/\/profile\?id=.+/',$uri)?true:false: // /profile?id=blabla
          $Controller->userInfo();break;
        case '/all':
          $Controller->allUsers();break;
        case preg_match('/\/check\?login=.+/',$uri)?true:false: 
          $Controller->checkLogin();break;
        case '/error':
          $Controller->error('routetest');break;
      }
    }
    catch(Exception $e){
      $Controller->error($e->getMessage);
    }
  }
}