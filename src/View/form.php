<?php require 'inc/header.php' ?>
<?php if(!isset($data)) $user=null; else $user=$data;?>
<?php echo $user['birthDate'];?>

<div>
  <button class="btn btn-outline-secondary my-2" onclick="autocomplete()">Autocomplete</button>
</div>
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-md-6">
  <form action="" method="POST">
    <div class="form-group">
      <label for="login">Username</label>
      <input type="text" class="form-control" required id="login" name="login" value="<?=htmlspecialchars($user['login'])?>">
    </div>
    
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" required id="password" name="password" value="<?=$user['password']?>">
    </div>

    <div class="form-group">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" required id="firstName" name="firstName" value="<?=htmlspecialchars($user['firstName'])?>">
    </div>

    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" required id="lastName" name="lastName" value="<?=htmlspecialchars($user['lastName'])?>">
    </div>

    <div class="form-group">
      <label for="sex">Sex</label>
      <select class="form-control" required id="sex" name="sex">
          <option value="male" <?=$user['sex']==='male'?'selected':''?>>Male</option>
          <option value="female" <?=$user['sex']==='female'?'selected':''?>>Female</option>
        </select>
    </div>

    <div class="form-group">
      <label for="birthDate">Date of Birth</label>
      <input type="date" min='1900-01-01' max='2019-01-01' class="form-control" required id="birthDate" name="birthDate" value="<?=$user['birthDate']?>">
    </div>

    <input type="hidden" value="<?=$user['id']?>">

    <button type="submit" class="btn btn-secondary">Submit</button>
  </form>
</div>
</div>
</div>

<script>
  async function  checkLogin(event){

    req = new XMLHttpRequest();
    let loginvalue = $('#login').val();

    req.open('GET', '/check?login='+loginvalue, false);
     req.send();
     req.onload = await function(){
      if(this.responseText == 1){
        alert('works!');
        return true;
      }
      else{
        alert('now working!')
        
      }
    }
    return false;
  }
  function autocomplete(){
    $('#login').val(uuidv4('login'));
    $('#password').val(uuidv4('password'));
    $('#firstName').val('inna');
    $('#lastName').val('petrova');
    $('#sex').val('female');
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