<?php

namespace App\Model;

use App\Engine\Db;
use App\Model\UserHelper;

class User{
  
  private $oDb, $oHelper;

  public function __construct(){
    $this->oDb = new Db();
    $this->oHelper = new UserHelper();
  }

  public function getOne($login){
    $stmt = $this->oDb->prepare('SELECT * FROM users WHERE login=:login LIMIT 1');

    $stmt->bindValue(':login',$login);
    $stmt->execute();
    
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $this->oHelper->transform($user, false);
  }

  public function getOneById($id){
    $stmt = $this->oDb->prepare('SELECT * FROM users WHERE id=:id LIMIT 1');

    $stmt->bindValue(':id',$id);
    $stmt->execute();
    
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $this->oHelper->transform($user, false);
  }


  public function getAll(){
    $stmt = $this->oDb->query(
      "SELECT * FROM users"
    );

    $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $users;
  }

  public function add($userData){
    $errors = $this->oHelper->validate($userData);
    if(empty($errors))
    {
      //transform transformed data, add hash to password, add uuid
      $transformed = $this->oHelper->transform($userData,true);
      //prepare SQL query
      $stmt = $this->oDb->prepare(
        "INSERT INTO users(UID, login, password, firstName, lastName, sex, birthDate) 
        VALUES( :UID, :login, :password, :firstName, :lastName, :sex, :birthDate);"
      );
      
      $stmt->bindValue('UID',$transformed['UID']);
      $stmt->bindValue('login',$transformed['login']);
      $stmt->bindValue('password',$transformed['password']);
      $stmt->bindValue('firstName',$transformed['firstName']);
      $stmt->bindValue('lastName',$transformed['lastName']);
      $stmt->bindValue('sex',isset($transformed['sex'])?$transformed['sex']:null);
      $stmt->bindValue('birthDate',$transformed['birthDate']);


      //check for exceptions
      try{
        $stmt->execute();
      }
      catch(\PDOException $e){
        // return $this->oHelper->returnWithErrors($userData, $errors);;
      }
    } else //if validate errors
    {
      return $this->oHelper->returnWithErrors($userData, $errors);
    }
    return false; //if successful return false - meaning no errors
  }

  public function edit($userData,$id)
  {
    $errors = $this->oHelper->validate($userData);

    if(empty($errors)){
      $transformed = $this->oHelper->transform($userData, true);

      $stmt = $this->oDb->prepare(
        "UPDATE users SET
          login = :login,
          password = :password,
          firstName = :firstName,
          lastName = :lastName,
          sex = :sex,
          birthDate = :birthDate
          WHERE id = :id"
      );

      $stmt->bindValue(':id',$id);
      $stmt->bindValue(':login',$transformed['login']);
      $stmt->bindValue(':password',$transformed['password']);
      $stmt->bindValue(':firstName',$transformed['firstName']);
      $stmt->bindValue(':lastName',$transformed['lastName']);
      $stmt->bindValue(':sex',$transformed['sex']);
      $stmt->bindValue(':birthDate',$transformed['birthDate']);

      $stmt->execute();
    }else{
      return $this->oHelper->returnWithErrors($userData, $errors);
    }
    return false;
  }



  public function checkLogin($login){
    return $this->oHelper->checkLogin($login);
  }

} 