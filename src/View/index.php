<?php require 'inc/header.php'; ?>

    <main>
      <div class="container text-center">
      <?php if (isset($data)): ?>
        <table class='table table-bordered'> 
          <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Functions</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach($data as $user): ?>
            <tr>
              <td><?=$user['login']?></td>
              <td>
                <a href="/profile?id=<?=$user['id']?>">Info</a>
                <a href="/edit?id=<?=$user['id']?>">Edit</a>
                <a href='#'>Delete</a>
              </td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      <?php endif?>
      </div>
    </main>

<?php require 'inc/footer.php'; ?>