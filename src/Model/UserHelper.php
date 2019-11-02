<?php


namespace App\Model;

use App\Engine\Db;

class UserHelper{
  
  private $oDb;

  public function __construct(){
    $this->oDb = new Db();
  }

  public function checkLogin($login){
    $stmt = $this->oDb->prepare('SELECT COUNT(*) from users WHERE login=:login');

    $stmt->bindValue(':login', $login);
    $stmt->execute();
    
    $result = null;
    try{
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    }catch(\PDOException $e){
      return false;
    }

    $key = array_key_first($result);
    if(intval($result[$key])===1) // if count(login) === 1
      return false;

    return true;
  }

  public function validate($userData)
  {
    $errors = [];
    $isLoginUnique=null;

    if(!isset($userData['login']) || mb_strlen($userData['login'])>50){
      array_push($errors,'login');
    } //login validate
    else{
      $isLoginUnique = $this->checkLogin($userData['login']);
      if(!$isLoginUnique){
        array_push($errors, 'login'); 
      }
    }

    if(!isset($userData['password']) || mb_strlen($userData['password'])>50){ //password validate
      array_push($errors, 'password'); 
    }
    if(!isset($userData['firstName']) || mb_strlen($userData['firstName'])>50){ //firstname validate
      array_push($errors, 'firstName');
    }
    if(!isset($userData['lastName']) || mb_strlen($userData['lastName'])>50){ //lastname validate
      array_push($errors, 'lastName');
    }
    if(!isset($userData['sex']) || !in_array($userData['sex'],array('male', 'female'))){ //sex validate
      array_push($errors, 'sex');
    }
    if(!isset($userData['birthDate'])){
      array_push($errors, 'birthDate');
    }

    return $errors;

  }

  public function transform($userData,$flag)
  {
    $transformed = $userData;
    if($flag){  // if needed to add to sql table
      $transformed['password'] = password_hash($transformed['password'],PASSWORD_BCRYPT);

      $transformed['UID'] = uniqid();
    }
    else{ // if needed to prepare to fetch it
      $transformed['password'] = null;
    }

    return $transformed;
  }


  public function returnWithErrors($userData, $errFields){
    $userWithErrData = $userData;
    $userWithErrData['password'] =  null; //nullify password field
    foreach($errFields as $errField){
      $userWithErrData[$errField] = null; //nullify error fields
    }

    return $userWithErrData;
  }
}