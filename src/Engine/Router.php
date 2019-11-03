<?php

namespace App\Engine;

use App\Controller\AdminController;
use App\Engine\Auth;
require_once __DIR__ . '/traits/Singleton.trait.php';


class Router{
  
  use traits\Singleton;

  private $Controller;

  public function __construct(){
    $this->Controller = new AdminController();
  }
  public function run(){

    $uriWithQuery = $_SERVER['REQUEST_URI'];
    
    $uriArray = preg_split('~\?~',$uriWithQuery);
    $uri = $uriArray[0];

    if(Auth::isLoggedIn()){
      try{
        switch($uri){
          case '/':
          case '/all':
            $this->Controller->allUsers();break;

          case '/test':
            $this->Controller->test();break;

          case '/add':
            $this->Controller->addUser();break;
            
          case '/edit':
            $this->Controller->editUser();break;

          case '/delete': //delete?id=blabla
            $this->Controller->deleteUser();break;

          case '/profile': // /profile?id=blabla
            $this->Controller->userInfo();break;

          case '/check':
            $this->Controller->checkLogin();break;
          case '/test':
            $this->Controller->test();break;
          case '/error':
            $this->Controller->error('routetest');break;

          case '/logout':
            $this->Controller->logout();break;

          default:
          $this->Controller->notFound();break;
        }
      }
      catch(Exception $e){
        $this->Controller->error($e->getMessage);
      }
    }else{
      if($uri!=='/login'){
        header("Location: /login");
      }
      else{
        $this->Controller->login();
      }
    }
  }
 
}
