<?php require 'inc/header.php' ?>
<?php if(!isset($data)) $user=null; else $user=$data?>


    <h1 class="display-4 text-center my-5">Profile Info</h1>
    <div class="row m-auto d-flex justify-content-center text-center">
      <div class="col-md-6 d-flex justify-content-between">
        <table class='table lead'>
          <thead>
            <!-- <th scope="col">Username</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Sex</th>
            <th scope="col">Date of Birth</th> -->
          </thead>
          <tbody class="border">
            <tr>
              <th class="" scope="row">Username</th>
              <th><?=$user['login']?></td>
            </tr>
            <tr>
              <th scope="row">First Name</th>
              <th><?=$user['firstName']?></td>
            </tr>
            <tr>
              <th scope="row">Last Name</th>
              <th><?=$user['lastName']?></td>
            </tr>
            <tr>
              <th scope="row">Sex</th>
              <th><?=$user['sex']?></td>
            </tr>
            <tr>
              <th scope="row">Date of Birth</th>
              <th><?=$user['birthDate']?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <div class="col-md-5 d-flex justify-content-between">
          <a href="/edit?id=<?=$user['id'];?>" class="btn btn-primary px-5 mr-5" role="button">Edit</a>
          <a href="/all" role="button" class="btn btn-secondary px-5">Back</a>
      </div>
    </div>

<?php require 'inc/footer.php' ?>