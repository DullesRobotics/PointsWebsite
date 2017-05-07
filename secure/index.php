<!DOCTYPE html>
<html>
    <head>
        <title>SQL Test Page</title>
        <style>
            #main_title,#date,table{
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
            
        </style>
    </head>
    <body>
        <h1 id="main_title">SQL Test Page</h1>
        <?php
            require 'secretSettings.php';
            echo "<p id='date'>Today is " . date("d/m/Y") . "</p>";
            try{
                $connection = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME",$USERNAME,$PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<h3>Connected sucessfully</h3>";
                $getMembers = $connection->prepare("SELECT * FROM Members ORDER BY Points DESC");
                $getMembers->execute();
                $MemberData = $getMembers->fetchAll();
                
                echo "<table>
                <tr>
                    <th>Rank</th>
                    <th>Tag ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Points</th>
                    
                </tr>";
                $i = 0;
                foreach ($MemberData as $member) {
                    $i = $i + 1;
                    echo "<tr>";
                    echo("<td>" . $i . "</td>");
                    echo("<td>" . $member['Tag_ID'] . "</td>");
                    echo("<td>" . $member['First_Name'] . "</td>");
                    echo("<td>" . $member['Last_Name'] . "</td>");
                    echo("<td><form action='updateDB.php' method='post'><input type='hidden' name='tag' value='". $member["Tag_ID"]. "'><input type='text' name='points' value='".$member['Points'] . "'><input type='submit' name='submit' value='Change ". $member['First_Name'] . " " . $member['Last_Name'] . "'></form></td>");
                    echo "</tr>";
                }
                echo "</table>";
                
            }catch(PDOException $e){
                echo "<h3>Connection Failed: " . $e->getMessage() . "</h3>";
            }
        ?>
    </body>
</html>