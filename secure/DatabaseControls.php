<!DOCTYPE HTML>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
    require("secretSettings.php");
    $user = $_GET['user'];
    if ($user != "all") {
        $NameSplit = split(" ",$user);
        $firstName = $NameSplit[0];
        $lastName = $NameSplit[1];
    }
    $ptsToAdd = $_GET['addPts'] ?: 0;
    echo "\naddPts: ".$ptsToAdd;
    $mtsToAdd = $_GET['addMts'] ?: 0;
    echo "\naddMts: ".$mtsToAdd;
    $status = $_GET['status'] ?: "no change";
    echo "\nstatus: ".$status;
    $conn = null;
    
    try{
        $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e)
    {
        echo "\nConnection aborted: " . $e->getMessage();
        exit;
    }
    $getMembers = $conn->prepare("SELECT * FROM Members");
    $getMembers->execute();
    $data = $getMembers->fetchAll();
    foreach ($data as $person){
        if ($user != "All Members" && ($person['First_Name'] == $firstName && $person['Last_Name'] == $lastName)){
            executeCommand($person,$ptsToAdd,$mtsToAdd,$status,$conn);
            echo "\n<br>Points to add: ".$ptsToAdd." Meetings To Add: ".$mtsToadd." Status to change: ".$status;
            break;
        } elseif ($user == "All Members") {
            executeCommand($person,$ptsToAdd,$mtsToAdd,$status,$conn);
            echo "\n<br>Points to add: ".$ptsToAdd." Meetings To Add: ".$mtsToadd." Status to change: ".$status;
        }
    }

    function addPoints($person,$pointsToAdd,$conn){
         $tagID = $person["Tag_ID"];
         $conn->exec("UPDATE Members SET Points = Points + '$pointsToAdd' WHERE Tag_ID = '$tagID'");
        echo "\n<br>added ".$pointsToAdd." pts to ".$tagID;
    }
    
    function addMeetings($person,$meetingsToAdd,$conn){
        $tagID = $person["Tag_ID"];
        $conn->exec("UPDATE Members SET Num_Meetings = Num_Meetings + '$meetingsToAdd' WHERE Tag_ID = '$tagID'");
        echo "\n<br> added ".$meetingsToAdd." meetings to ".$tagID;
    }
    
    function signOut($person,$conn){
        echo "Command received <br>";
        $tagID = $person["Tag_ID"];
        $conn->exec("UPDATE Members SET Signed_In = 1 WHERE Tag_ID = '$tagID'");
        $url = 'http://dhsrobotics.ddns.net/reply.php';
        $data = array($person["Tag_ID"]);
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { echo "\n ERROR: self-post failed"; }
        var_dump($result);
    }
    
    function signIn($person,$conn){
        echo "Command received <br>";
        $tagID = $person["Tag_ID"];
        $conn->exec("UPDATE Members SET Signed_In = 0 WHERE Tag_ID = '$tagID'");
        $url = 'http://dhsrobotics.ddns.net/reply.php';
        $data = array($person["Tag_ID"]);
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { echo "\n ERROR: self-post failed"; }
        var_dump($result);
    }
    
    function executeCommand($person,$ptsToAdd,$mtsToAdd,$status,$conn){
        echo "\n<br>Data:";
        echo "\n<br> Person: ".$person." Points: ".$ptsToAdd." Meetings: ".$mtsToAdd." Status: ".$status;
        $logsFile = fopen("logs/ControlPanelLogs.txt","a+") or die();
        fwrite($logsFile,"IP: ".$_SERVER['REMOTE_ADDR']."\n");
        if ($ptsToAdd != 0) {
            echo "<br> Attempting to add points...";
            addPoints($person,$ptsToAdd,$conn);
        }
        if ($mtsToAdd != 0) {
            echo "<br> Attemptng to add meetings...";
            addMeetings($person,$mtsToAdd,$conn);
        }
        if ($status == "sign in"){
            signIn($person,$conn);
        } elseif ($status == "sign out"){
            signOut($person,$conn);
        }
        fwrite($logsFile,"Changes: Points Added: ".$ptsToAdd." Meetings Added: ".$mtsToAdd." Status: ".$status."\n");
        fclose($logsFile);
    }
    
    /*echo "<table>
        <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Age</th>
        <th>Hometown</th>
        <th>Job</th>
        </tr>";
    while($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['FirstName'] . "</td>";
        echo "<td>" . $row['LastName'] . "</td>";
        echo "<td>" . $row['Age'] . "</td>";
        echo "<td>" . $row['Hometown'] . "</td>";
        echo "<td>" . $row['Job'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";*/
?>
</body>
</html>
