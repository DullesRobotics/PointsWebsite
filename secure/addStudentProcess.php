<?php
  $fingerID = $_POST['id'];
  $first = $_POST['fn'];
  $last = $_POST['ln'];
  $studentID = $_POST['sid'];

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

  $setData = $conn->prepare("INSERT INTO Student_Info (ID,First_Name,Last_Name,Student_ID) VALUES (:finger,:firstn,:lastn,:stuID)");
  $setData->execute($arrayName = array(':finger' => $fingerID,':firstn' => $first,':lastn'=>$last,':stuID'=>$studentID));

  $getData = $conn->prepare("SELECT First_Name,Last_Name,Student_ID,ID FROM Student_Info");
  $getData->execute();
  $data = $getData->fetchAll();
  foreach ($data as $d) {
    $string = $d['First_Name'] . " " . $d['Last_Name'] . "  |  " . $d['Student_ID'] . "  |  " . $d['ID'];
    echo "<br>" . $string;
  }

 ?>
