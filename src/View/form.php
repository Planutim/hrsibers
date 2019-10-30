<?php require 'inc/header.php' ?>
<?php if(!isset($data)) $user=null; else $user=$data;?>
<?php echo $user['birthDate'];?>

<div>
  <button class="btn btn-outline-secondary my-2" onclick="autocomplete()">Autocomplete</button>
</div>
<div class="container">
  <form action="" method="POST" onsubmit="return checkLogin()">
    <div class="form-group">
      <label for="login">Login</label>
      <input type="text" class="form-control" required id="login" name="login" value="<?=htmlspecialchars($user['login'])?>">
    </div>
    
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" required id="password" name="password" value="<?=$user['password']?>">
    </div>

    <div class="form-group">
      <label for="firstName">Имя</label>
      <input type="text" class="form-control" required id="firstName" name="firstName" value="<?=htmlspecialchars($user['firstName'])?>">
    </div>

    <div class="form-group">
      <label for="lastName">Фамилия</label>
      <input type="text" class="form-control" required id="lastName" name="lastName" value="<?=htmlspecialchars($user['lastName'])?>">
    </div>

    <div class="form-group">
      <label for="sex">Пол</label>
      <select class="form-control" required id="sex" name="sex">
          <option value="male" <?=$user['sex']==='male'?'selected':''?>>Мужской</option>
          <option value="female" <?=$user['sex']==='female'?'selected':''?>>Женский</option>
        </select>
    </div>

    <div class="form-group">
      <label for="birthDate">Дата рождения</label>
      <input type="date" min='1900-01-01' max='2019-01-01' class="form-control" required id="birthDate" name="birthDate" value="<?=$user['birthDate']?>">
    </div>

    <input type="hidden" value="<?=$user['id']?>">

    <button type="submit" class="btn btn-secondary">Submit</button>
  </form>
</div>

<script>
  function checkLogin(event){

    req = new XMLHttpRequest();
    let loginvalue = $('#login').val();

    req.open('GET', '/check?login='+loginvalue, false);
    req.send();  
    req.onload = function(){
      if(this.responseText == 1){
        return true;
      }
      else{
        return false;
      }
    }

    return false;
  }
  function autocomplete(){
    $('#login').val(uuidv4('login'));
    $('#password').val(uuidv4('password'));
    $('#firstName').val('vitaly');
    $('#lastName').val('ivanov');
    $('#sex').val('male');
    $('#birthDate').val('2000-01-01');
  }

  function uuidv4(type) {
    let uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx';
    let login = 'xxxxxxxxxxyxyx';
    let password = 'xxxxxxxxxyyxx';
    let returnval = '';
    switch(type){
      case 'login': returnval=login;break;
      case 'password': returnval=password;break;
      default: returnval=uuid;break;
    }
  return returnval.replace(/[xy]/g, function(c) {
    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
    return v.toString(16);
  });
}
</script>

<?php require 'inc/footer.php' ?>