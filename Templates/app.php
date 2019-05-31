

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Python Flask tasks list</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" >
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.3/css/autoFill.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.jqueryui.min.css">




    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.3/js/dataTables.autoFill.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>

<body>
<header>
    <div class="container">
        <div class="header">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="#">{{session.username}}</a>
                    </li>
                    <li role="presentation"><a href="/login ">Sign In</a>
                    </li>
                    <li role="presentation"><a href="/logout">Log out</a>
                    </li>
                </ul>
            </nav>
            <h3 class="text-muted">Python Flask task App</h3>
        </div>
<header>
<h3>Logged as: {{session.username}}</h3>
<br>
        <script type="text/javascript">

var startPos;

                  window.onload = function() {
                    var geoSuccess = function(position) {
                      startPos = position;
                      document.getElementById('startLat').innerHTML = startPos.coords.latitude;
                      document.getElementById('startLon').innerHTML = startPos.coords.longitude;
                    };
                    navigator.geolocation.getCurrentPosition(geoSuccess);
                  };

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
          //var name= document.getElementById("inputName").value;
          //var email= document.getElementById("inputEmail").value;
          var name= toString( document.getElementById("startLat").value);
          var email=toString( document.getElementById("startLon").value);
          var pass= "1234";
          xhr.send('{"name":"'+startPos.coords.latitude.toString()+'","email":"'+email+'","pwd":"'+pass+'"}');
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

              ],dom: 'A<"clear">lfrtip',
              buttons: [
                  'copy', 'pdf',
                  {
          //columns:'visible',
          extend: 'csv',
          text: 'to CSV',
          footer:true,
          exportOptions: {
              modifier: {
                  page:'current'
              }
          }
      },
                  {
               text: 'Eliminar Fila',
               action: function ( e, dt, node, config ) {
                 var deleteurl='http://localhost:5000/delete/'+id.toString(10);
                 getJSON(deleteurl,  function(err, dataset) {

                     if (err != null) {
                         console.error(err);
                     } else {

                         var text = `Date: ${dataset.date}
                 Time: ${dataset.user_email}
                 Unix time: ${dataset.milliseconds_since_epoch}`



                     }
                   });



                   alert( id );
               }

           }
              ],
              rowId:'user_id'
              } );
              var id;

              $('#example').on( 'click', 'tr', function () {
                  id = table.row( this ).id();

                  alert( 'Clicked row id '+id );
              } );

              $('#example tbody').on( 'click', 'tr', function () {
                     if ( $(this).hasClass('selected') ) {
                         $(this).removeClass('selected');
                     }
                     else {
                         table.$('tr.selected').removeClass('selected');
                         $(this).addClass('selected');
                     }
                 } );


            $('#button').click( function () {
              var id = table.row( this ).id();
                alert( 'Clicked row id '+id );
            } );

              table.buttons().container().insertBefore('#example_filter');

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
    };
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
            <small id="emailHelp" class="form-text text-muted">We never share your email with anyone else.</small>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="button" onclick="onlycallpost()">Agregar</button>
        </form>

        <footer class="footer">
            <p>&copy; Company 2015</p>
            <p>Your latitude is:</p>
            <p id="startLat"></p>
            <p>Your longitude is:</p>
            <p id="startLon"></p>
        </footer>


    </div>
</body>

</html>
