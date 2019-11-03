    <footer class='d-flex justify-content-center pt-2'>
      <p class="lead">SESSION = <?=$_SESSION['UID']?></p>
      </div>
    </footer>
    
    <script>
      document.addEventListener('DOMContentLoaded',()=>{

        params = getQuery();
        if(!$.isEmptyObject(params)){
          
          for(let key in params){
            document.getElementById(key).value = params[key];
          }

        }
        if(typeof params['sortBy']!=='undefined')
          $('#sortBy').prop('disabled', false);
          // $('#asc').prop('disabled',false);

          // $('#asc').val($('#asc').val()==='asc'?'desc':'asc')
      })

      function goTo(where){





        let form = document.getElementById('pagination');
        let input = document.getElementById('page');
        let limit = document.getElementById('limit');
        let users = document.getElementById('users');

        switch(where){
          case 'next':
            input.value = users.childElementCount<parseInt(limit.value,10)?input.value:parseInt(input.value,10) + 1;break;
          case 'prev':
            input.value = input.value>1?parseInt(input.value,10) - 1:1;break;
        }
        
        form.submit();
      }

      function getQuery(){
        var match,
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
        query  = window.location.search.substring(1);

        let urlParams = {};
        while (match = search.exec(query))
          urlParams[decode(match[1])] = decode(match[2]);
        return urlParams
      }


    </script>

    <script src="static/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="static/js/jquery-3.4.1.min.js"></script>
  </body>
</html>