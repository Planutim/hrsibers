<?php

namespace App\Engine;


class Util{


  public function getView($viewName,$data=null){
    $viewPath = ROOT . 'View/'. $viewName . '.php';
    if(is_file($viewPath))
      require $viewPath;
    else
    {
      echo 'Something\'s wrong!'; 
      exit();
    }
  }
}