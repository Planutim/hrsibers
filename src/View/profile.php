<?php require 'inc/header.php' ?>
<?php if(!isset($data)) $user=null; else $user=$data?>

    <div class="row m-auto d-flex justify-content-center text-center">
      <div class="d-flex justify-content-between">
        <table class='table table-bordered'>
          <thead>
            <th scope="col">Username</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Sex</th>
            <th scope="col">Date of Birth</th>
          </thead>
          <tbody>
            <td><?=$user['login']?></td>
            <td><?=$user['firstName']?></td>
            <td><?=$user['lastName']?></td>
            <td><?=$user['sex']?></td>
            <td><?=$user['birthDate']?></td>
          </tbody>
        </table>
      </div>
    </div>

<?php require 'inc/footer.php' ?>