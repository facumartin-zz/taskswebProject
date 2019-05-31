

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Python Flask user list</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" >
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="header">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="#">Home</a>
                    </li>
                    <li role="presentation"><a href="#">Sign In</a>
                    </li>
                    <li role="presentation"><a href="showSignUp">Sign Up</a>
                    </li>
                </ul>
            </nav>
            <h3 class="text-muted">Python Flask App</h3>
        </div>

        <script>


          function postJSON(url, callback) {
          var xhr = new XMLHttpRequest();
          xhr.open("POST", url, true);
          //Send the proper header information along with the request
          xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

          xhr.onreadystatechange = function() { // Call a function when the state changes.
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                  // Request finished. Do processing here.
              }
          }
          var name= document.getElementById("inputName").value;
          console.log(name);
          var email= document.getElementById("inputEmail").value;
          console.log(email);
          var pass= document.getElementById("inputPass").value;
          console.log(pass);
          xhr.send('{"name":"'+name+'","email":"'+email+'","pwd":"'+pass+'"}');
          };

      /*    var getJSON = function(url, callback) {
          var xhr = new XMLHttpRequest();
          xhr.open('GET', url, true);
          xhr.responseType = 'json';

          xhr.onload = function() {

              var status = xhr.status;

              if (status == 200) {
                  callback(null, xhr.response);
              } else {
                  callback(status);

              }
          };
              xhr.send();
          };
          */
              function getJSON(url, callback) {
              var xhr = new XMLHttpRequest();
              xhr.open('GET', url, true);
              xhr.responseType = 'json';

              xhr.onload = function() {

                  var status = xhr.status;

                  if (status == 200) {
                      callback(null, xhr.response);
                  } else {
                      callback(status);

                  }
              };
                  xhr.send();
              };


          document.write("scripting");
          getJSON('http://localhost:5000/users',  function(err, dataset) {

              if (err != null) {
                  console.error(err);
              } else {

                  var text = `Date: ${dataset.date}
          Time: ${dataset.user_email}
          Unix time: ${dataset.milliseconds_since_epoch}`


              }
              console.log(dataset);
              //document.getElementById("jsontext").innerHTML =texto;
              $(document).ready(function() {
              var table= $('#example').DataTable( {
                    data: dataset,
                    "columns": [
                  { "data": "user_email" },
                  { "data": "user_id" },
                  { "data": "user_name" },
                  { "data": "user_password" },

                ]
                } );
                        $('button').click( function() {
               var data = table.$('input, select').serialize();
               alert(
                   "The following data would have been submitted to the server: \n\n"+
                   data.substr( 0, 120 )+'...'
               );
               return false;
           } );
          } );
        } );
function onlycallpost(){
        postJSON('http://localhost:5000/add',  function(err, dataset) {

        if (err != null) {
            console.error(err);
        } else {

                var text = `Date: ${dataset.date}
        Time: ${dataset.user_email}
        Unix time: ${dataset.milliseconds_since_epoch}`


        }
      });
    }

    </script>

        <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>password</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Email</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>password</th>
                    </tr>
                </tfoot>
            </table>
<h1> Agregar nuevo usuario </h1>
        <p id="jsontext"></p>
        <form name='myform' action="POST" >

          <div class="form-group">


            <label for="exampleInputPassword1">name</label>
            <input type="text" name='name' class="form-control" id="inputName" placeholder="name">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" name='email' class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
            <label for="exampleInputPassword1">pwd</label>
            <input type="password" name='pwd' class="form-control" id="inputPass" placeholder="pwd">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>

          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="button" onclick="onlycallpost()">Agregar!</button>
        </form>

        <footer class="footer">
            <p>&copy; Company 2015</p>
        </footer>

    </div>
</body>

</html>
