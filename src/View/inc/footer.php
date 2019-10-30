    <footer class='d-flex justify-content-between pt-2'>
      <p>footer</p>
      <form action ='#' id='secondaryform' onsubmit='return false;'>
          <input type="text" class="form-control" id="wtf">
      </form>
      <button class="btn btn-outline-secondary px-5 mb-2" onclick="checkLogin()">test</button>
      <a href='/check?login=vasya'>test</a>
      <p id="loginresult" class="w-25 pt-3"></p>
      </div>
    </footer>
    
    <script>
      function prevento(event){


        event.preventDefault();
        event.stopPropagation();
        return false;
      }
      function checkLogin(){
        var value = $('#wtf').val();

        let req = new XMLHttpRequest()
        req.open('get','/check?login='+value)
        req.send();
        req.onload = function(){
          let result = this.responseText;
          $('#loginresult').text(result);
        }

      }
    </script>

    <script src="static/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="static/js/jquery-3.4.1.min.js"></script>
  </body>
</html>