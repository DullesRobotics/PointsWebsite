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
    $action = $_GET['action'];

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
        if ($user != "all" && $person['First_Name'] == $firstName && $person['Last_Name'] == $lastName){
            executeCommand($action,$person,$conn);
            echo $action." to ".$person['First_Name'];
            break;
        } elseif ($user == "all") {
            executeCommand($action,$person,$conn);
            echo $action." to ".$person['First_Name']." <br>";
        }
    }

    function addPoints($tagId,$pointsToAdd,$connection){
         $connection->exec("UPDATE Members SET Points = Points + '$pointsToAdd' WHERE Tag_ID = '$tagId'");
    }
    
    function addMeetings($tagId,$meetingsToAdd,$connection){
        $connection->exec("UPDATE Members SET Meetings = Meetings + '$meetingsToAdd' WHERE Tag_ID = '$tagId'");
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
        break;
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
        break;
    }
    
    function executeCommand($command,$person,$conn){
        echo "Command: ".$command." to: ".$person["First_Name"]."<br>";
        switch($command){
            case "sign out":
                signOut($person,$conn); break;
            case "sign in":
                signIn($person,$conn); break;
        }
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
