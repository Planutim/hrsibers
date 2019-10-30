<?php

namespace App\Engine;

class Auth{

  public static function login(){
    
  }

  public static function logout(){
    session_unset();
    header("Location: /login");
  }
}