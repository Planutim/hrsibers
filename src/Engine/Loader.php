<?php


namespace App\Engine;


class Loader{


  
  public static function run(){
    spl_autoload_register(array(__CLASS__,'autoload'));
  }


  private static function autoload($className){
    $pathParts = explode('\\',$className);


    array_shift($pathParts); //take away APP part
 

    $pathToClass =  ROOT . implode('/',$pathParts) . '.php';

    if(is_file($pathToClass)){
      require_once $pathToClass;
    }
  }
}