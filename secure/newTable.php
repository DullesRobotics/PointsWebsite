<?php
  require("secretSettings.php");

  try
  {
    $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
    echo "Connected to database";
  }
  catch (PDOException $e) {
     echo "Failed to connect to database";
     exit;
  }

?>
<table class="table table-striped">
  <thead>
    <tr>
      <?php
        $getColumns = $conn->prepare("SELECT column_name FROM information_schema.columns WHERE table_schema = 'roboticsClub' AND table_name = 'Student_Info' ;");
        $getColumns->execute();
        $columns = $getColumns->fetchAll();
        for($i=0;$i<count($columns);$i++){
          echo "<th>" . ($columns[$i]['column_name']) . "</th>";
        }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
      $getPeople = $conn->prepare("SELECT * FROM Student_Info ORDER BY ID;");
      $getPeople->execute();
      $peopledata = $getPeople->fetchAll();
      for($i=0;$i<count($peopledata);$i++){
        echo "<tr>";
        for($j=0;$j<count($peopledata[$i]);$j++){
          echo "<td>" . $peopledata[$i][$j] . "</td>";
        }
        echo "</tr>";
      }
    ?>
  </tbody>

</table>
