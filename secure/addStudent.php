<!DOCTYPE html>
  <html>
    <head>
      <title>Add Student</title>

      <!-- Bootstrap - Latest compiled and minified CSS -->
        		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php include_once("analyticstracking.php") ?>

    </head>
    <body>
      <?php include($_SERVER['DOCUMENT_ROOT'] . "/navigationBar.php"); ?>
      <div class="jumbotron jumbotron-fluid" style="margin:2.5% 5% 2.5% 5%">
        <div class="container">
          <h1 class="display-4">Add Student</h1>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">ID: </span>
                </div>
                <input type="text" id="ID" placeholder="Ex: 'A' ">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">First Name: </span>
                </div>
                <input type="text" id="First_Name" placeholder="Ex: 'Kenneth'">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Last Name: </span>
                </div>
                <input type="text" id="Last_Name" placeholder="Ex: 'Mitra'">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Student ID: </span>
                </div>
                <input type="text" id="Student_ID" placeholder="Ex: '756825'">
              </div>

              <input type="button" value="Add Student" onclick="addStudentAction()">
            </div>
      </div>

    </div>

      <div class="jumbotron jumbotron-fluid" style="margin:2.5% 5% 2.5% 5%">

        <div class="container" id="result" style="padding:0%">
            <div id="alertSpace"></div>
        </div>
        </div>
      </div>
    </body>
    <script>
      function addStudentAction(){
        s_id = $("#ID").val();
        s_fn = $("#First_Name").val();
        s_ln = $("#Last_Name").val();
        s_sid = $("#Student_ID").val();
        if(s_id.length > 0 && s_fn.length > 1 && s_ln.length > 2 && s_sid.length == 6){
          $("#result").load("addStudentProcess.php",{id:s_id,fn:s_fn,ln:s_ln,sid:s_sid});
          $("#alertSpace").html("<div class='alert alert-success' role='alert'>Student Added</div>");
        }else{
          $("#alertSpace").html("<div class='alert alert-danger' role='alert'>Check your inputs</div>");
        }
      }
    </script>

  </html>
