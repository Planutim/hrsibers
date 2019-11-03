<?php require 'inc/header.php'; ?>

    <main>
      <div class="container text-center">
        <div class="">
          <div class="">
      <?php if (isset($data)): ?>
        <table class='table border-bottom'> 
          <thead>
            <tr class='border-right border-left'>
                <th scope="col" class='border-right'>
                  #
                </th>
                <th scope="col" class='border-right'>
                  <a href='?sortBy=login' class="nodecor">Username</a>
                </th>
                <th scope="col" class='border-right'>
                    <a href='?sortBy=firstName' class="nodecor">First Name</a>
                  </th>
                  <th scope="col" class='border-right'>
                      <a href='?sortBy=lastName' class="nodecor">Last Name</a>
                    </th>
                <th scope="col">Info</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
          </thead>
          <tbody id="users">
          <?php foreach($data as $key=>$user): ?>
            <tr class='border-left border-right'>
              <td class='border-right'><?=$user['number']?></td>
              <td class='border-right'><?=$user['login']?></td>
              <td class='border-right'><?=$user['firstName']?></td>
              <td class='border-right'><?=$user['lastName']?></td>
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
                <a href="/delete?id=<?=$user['id']?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 8 8">
                  <path d="M2 0l-2 3 2 3h6v-6h-6zm1.5.78l1.5 1.5 1.5-1.5.72.72-1.5 1.5 1.5 1.5-.72.72-1.5-1.5-1.5 1.5-.72-.72 1.5-1.5-1.5-1.5.72-.72z" transform="translate(0 1)" />
                </svg></a>
              </td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      <?php endif?>
      </div>
      <div class="row">
          <div class="col-md-12 d-flex justify-content-between">
    
              <button class="btn btn-primary" onclick="goTo('prev')">Prev</button>
              <form id="pagination" action="/" method="GET">
                <input type="hidden" id="page" name="page" value="1">
                <input type="hidden" id="sortBy" disabled name="sortBy" value="">
                <input type="hidden" id="asc" disabled name="asc" value="asc">
    
                    <select class="form-control " id='limit' name="limit">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                      </select>
              </form>
              <button class="btn btn-primary" onclick="goTo('next')">Next</button>    
            </div>
          </div>
        </div>
      </div>
    </main>

<?php require 'inc/footer.php'; ?>