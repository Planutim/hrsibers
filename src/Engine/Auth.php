<?php

namespace App\Engine;

use App\Config;

class Auth{

  private static $uid;

  public static function run(){
    session_start();

    if(!self::isLoggedIn()){
      self::destroy();
    }
  }

  public static function isLoggedIn(){
    return isset($_SESSION,$_SESSION['UID']);
  }

  public static function login($login,$password){
    if($login === Config::ADMIN_LOGIN && $password === Config::ADMIN_PASSWORD){
      self::$uid = uniqid();
      $SESSION['UID'] = self::$uid;
      return true;
    }
    return false;
  }


  public static function destroy(){
    session_unset();
    session_destroy();
  }
}