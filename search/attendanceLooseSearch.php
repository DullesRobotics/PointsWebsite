<?php
  $query = $_POST['query'];

  require("secretSettings.php");
  $conn = null;

  try{
      $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e)
  {
      echo "\nConnection aborted: " . $e->getMessage();
      exit;
  }

  $getData = $conn->prepare("SELECT First_Name,Last_Name,timeScanned,Status FROM log");
  $getData->execute();
  $data = $getData->fetchAll();
  foreach ($data as $d) {
    $string = $d['First_Name'] . " " . $d['Last_Name'] . "  |  " . $d['timeScanned'] . "  |  " . $d['Status'];
    if(strpos(strtolower($string),strtolower($query)) !== false){
      echo "<br>" . $string;
    }
  }

 ?>
