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


  public function getAll($options=null){

    $limit = isset($options['limit'])?$options['limit']:5;

    $page = @(int)$options['page'];
    
    $offset = 0;

    if(isset($page)&&$page>0){
      $numPages = intval($this->selectAllCount() / $limit) + 1;
      if($page<=$numPages){
        $offset = ($page-1) * $limit;
      }else{
        $offset = ($numPages-1) * $limit;
      }
    }
    
    $sortBy = isset($options['sortBy'])?' ORDER BY '. $options['sortBy']:'';

    $ascdesc = isset($options['ascdesc'])?$options['ascdesc']:'';

    $query = "SELECT * FROM users  $sortBy $ascdesc LIMIT $limit OFFSET $offset";
    
    $defaultQuery = 'SELECT * FROM users';

    try{
      $stmt = $this->oDb->query($query);
    }
    catch(\PDOException $e){
      echo $e->getMessage();
      return;
    }

    $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach($users as $key=>$user){
      $users[$key]['number'] = $key+$offset+1;
    }

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
        "INSERT INTO users(login, password, firstName, lastName, sex, birthDate) 
        VALUES(:login, :password, :firstName, :lastName, :sex, :birthDate);"
      );
      
      // $stmt->bindValue('UID',$transformed['UID']);
      $stmt->bindValue('login',$transformed['login']);
      $stmt->bindValue('password',$transformed['password']);
      $stmt->bindValue('firstName',$transformed['firstName']);
      $stmt->bindValue('lastName',$transformed['lastName']);
      $stmt->bindValue('sex',isset($transformed['sex'])?$transformed['sex']:null);
      $stmt->bindValue('birthDate',$transformed['birthDate']);

      echo $stmt->queryString;

      
      //check for exceptions
      try{
        $stmt->execute();
        

      }
      catch(\PDOException $e){
        return $this->oHelper->returnWithErrors($userData, $errors);
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

  public function delete($id){
    $stmt = $this->oDb->prepare('DELETE FROM users where id=:id');

    $stmt->bindValue(':id',$id);
    try{
      $stmt->execute();
    }
    catch(\PDOException $e){
      return false;
    }
    return true;
  }




  public function selectAllCount(){
    $stmt = $this->oDb->query('SELECT COUNT(*) FROM users');
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return (int)$result[array_key_first($result)];
  }
} 