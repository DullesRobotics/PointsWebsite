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
    echo "User found";
    $NameSplit = split(" ",$user);
    echo "\nSplit: ".$NameSplit[0]." ".$NameSplit[1];
    //echo "First: ".$NameSplit[0]." Last: ".$NameSplit[1];
    //$NameSplit = $user.split('%20');
    $firstName = $NameSplit[0];
    $lastName = $NameSplit[1];
    
    echo "\nFinding actiong..";
    $action = $_GET['action'];
    echo "\nAction found: ".$action;
    //echo "\n".$action;
    //echo $q;

    try{
        echo "Attempting connection...";
        $con = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "\nConnected Successfully.";
    }catch(PDOException $e)
    {
        echo "\nConnection aborted: " . $e->getMessage();
        exit;
    }
    /*$getMembers = $conn->prepare("SELECT * FROM Members");
    $getMembers->execute();
    $data = $getMembers->fetchAll();
    foreach ($data as $person){
        if ($person['First_Name'] == $firstName && $person['Last_Name'] == $lastName){
            echo "\nFound: ".$firstName." ".$lastName."!";
            break;
        } else {
            echo $person['First_Name']." found, searching...\n";   
        }
    }*/

    function addPoints($tagId,$pointsToAdd,$connection){
         $connection->exec("UPDATE Members SET Points = Points + '$pointsToAdd' WHERE Tag_ID = '$tagId'");
    }
    
    function addMeetings($tagId,$meetingsToAdd,$connection){
        $connection->exec("UPDATE Members SET Meetings = Meetings + '$meetingsToAdd' WHERE Tag_ID = '$tagId'");
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
