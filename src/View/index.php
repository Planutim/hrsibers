<?php require 'inc/header.php'; ?>

    <main>
      <div class="container text-center">
      <?php if (isset($data)): ?>
        <table class='table'> 
          <thead>
            <tr class='border-right border-left'>
                <th scope="col" class='border-right'>Username</th>
                <th scope="col">Info</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach($data as $user): ?>
            <tr class='border-left border-right'>
              <td class='border-right'><?=$user['login']?></td>
              <td >
                <a href="/profile?id=<?=$user['id']?>">
                  
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 8 8">
                    <path d="M3 0c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1zm-1.5 2.5c-.83 0-1.5.67-1.5 1.5h1c0-.28.22-.5.5-.5s.5.22.5.5-1 1.64-1 2.5c0 .86.67 1.5 1.5 1.5s1.5-.67 1.5-1.5h-1c0 .28-.22.5-.5.5s-.5-.22-.5-.5c0-.36 1-1.84 1-2.5 0-.81-.67-1.5-1.5-1.5z" transform="translate(2)"
                    />
                  </svg>
                </a>
              </td>
              <td>
                <a href="/edit?id=<?=$user['id']?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 8 8">
                  <path d="M6 0l-1 1 2 2 1-1-2-2zm-2 2l-4 4v2h2l4-4-2-2z" />
                </svg></a>
              </td>
              <td>
                <a href='#'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 8 8">
                  <path d="M2 0l-2 3 2 3h6v-6h-6zm1.5.78l1.5 1.5 1.5-1.5.72.72-1.5 1.5 1.5 1.5-.72.72-1.5-1.5-1.5 1.5-.72-.72 1.5-1.5-1.5-1.5.72-.72z" transform="translate(0 1)" />
                </svg></a>
              </td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      <?php endif?>
      </div>
    </main>

<?php require 'inc/footer.php'; ?>