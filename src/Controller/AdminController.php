<?php

namespace App\Controller;

use App\Engine\Util;
use App\Model\User;

class AdminController{

  private $oUtil, $User;

  public function __construct(){
    $this->oUtil = new Util();
    $this->User = new User();
  }

  public function index(){      //serve main page
    
    return $this->oUtil->getView('index');
  }

  public function login(){
    if(isset($_POST['admin_login'])){     //serve login page

    }
  }

  public function addUser(){      //Add a user
    if(isset($_POST['login'])){

        try{
          $errorData = $this->User->add($_POST); 
          
          if($errorData){
            return $this->oUtil->getView('form', $errorData); // if witherrors  is not empty return to form page with filled fields
          }
        }
        catch(\PDOException $e){
          // return $this->oUtil->getView('error', $e->getMessage);
        }

      return $this->oUtil->getView('index');
    }else{ //if post data is not set meaning you are to register 
      return $this->oUtil->getView('form');
    }
  }

  public function editUser(){     //Edit a user
    if(isset($_POST['login'])){
      
      try{
        $errorData = $this->User->edit($_POST,$_GET['id']);

        if($errorData){
          return $this->oUtil->getView('form', $errorData);
        }else{
          return $this->oUtil->getView('index');
        }
      }
      catch(\PDOException $e){
        return $this->oUtil->getView('error',$e->getMessage);
      }

    }else if(isset($_GET['id'])){
      
      $editUser = $this->User->getOneById($_GET['id']);

      if($editUser!==null){
        return $this->oUtil->getView('form',$editUser);
      }
    }

    return $this->oUtil->getView('error','Something wrong happened');
  }

  public function userInfo(){
    if(isset($_GET['id'])){

      try{
        $user = $this->User->getOneById($_GET['id']);
        if($user){
          return $this->oUtil->getView('profile',$user);
        }
        else{
          return $this->oUtil->getView('error','There is no user with this id');
        }
      }catch(\PDOException $e){
        return $this->oUtil->getView('error', $e->getMessage());
      }
    }else{
      header("Location: /");
    }
  }

  public function allUsers(){
    $usersArray = $this->User->getAll();

    return $this->oUtil->getView('index', $usersArray);
  }

  public function test(){
    var_dump($_POST);
  }

  public function error($message){

    return $this->oUtil->getView('error',$message);
  }

  public function checkLogin(){     //
    if(isset($_GET['login'])){
      $result = $this->User->checkLogin($_GET['login']);

      if($result){
        $message= 'its not taken!';
      }
      else{
        $message = 'its taken!';
      }
      echo $message;
      return;
    }
  }


}