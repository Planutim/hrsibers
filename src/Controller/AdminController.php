<?php

namespace App\Controller;

use App\Engine\Util;
use App\Model\User;
use App\Engine\Auth;

class AdminController{

  private $oUtil, $User;
  private $count=0;

  public function __construct(){
    $this->oUtil = new Util();
    $this->User = new User();
  }

  public function index(){     
    
    return $this->allusers();
  }

  public function login(){ //admin login
    if(isset($_POST['admin_login'],$_POST['admin_password'])){  //if post data given  
      $login = $_POST['admin_login'];
      $password = $_POST['admin_password'];
      
      if(Auth::login($login,$password)){
        header("Location: /");
        // return $this->oUtil->getView('index');
      }
      else{
        return $this->oUtil->getView('login');
      }
    }else{  //serve login page
      return $this->oUtil->getView('login');
    }
  }

  public function logout(){
    Auth::destroy();
    header("Location: /");
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
          return $this->oUtil->getView('error', $e->getMessage);
        }

      header("Location:/");
      // return $this->oUtil->getView('index');
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
          // return $this->oUtil->getView('index');
          header("Location: /");
        }
      }
      catch(\PDOException $e){
        return $this->oUtil->getView('error',$e->getMessage);
      }

    }else if(isset($_GET['id'])&&intval($_GET['id'])){
      
      $editUser = $this->User->getOneById($_GET['id']);

      if($editUser!==null){
        return $this->oUtil->getView('form',$editUser);
      }
    }

    return $this->oUtil->getView('error','Something wrong happened');
  }

  public function deleteUser(){
    if(isset($_GET['id'])&&intval($_GET['id'])){
      if($this->User->delete($_GET['id'])){
        header("Location: /");
      }
      else{
        header("Location: /error");
      }
    }
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
    $options = [];
    if(isset($_GET['sortBy'])){
      if(in_array($_GET['sortBy'],array('login','id','firstName','lastName'))){
        $options['sortBy'] = $_GET['sortBy'];

      }
    }

    if(isset($_GET['asc'])){
      if(in_array($_GET['asc'],array('asc','desc')))
        $options['ascdesc'] = $_GET['asc'];
    }

    if(isset($_GET['page'])){
      if(is_numeric($_GET['page'])){
        $options['page'] = $_GET['page'];
      }
    }

    if(isset($_GET['limit'])){
      if(is_numeric($_GET['limit']))
        $options['limit'] = $_GET['limit'];
    }

    $usersArray = $this->User->getAll($options);

    return $this->oUtil->getView('index', $usersArray);
  }

  public function error($message){

    return $this->oUtil->getView('error',$message);
  }

  public function notFound(){
    return $this->oUtil->getView('notFound');
  }
}