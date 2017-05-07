<?php
    require("secretSettings.php");
    echo $_POST["tag"] . "<br>";
    echo $_POST["points"] . "<br>";
    echo $_POST["submit"] . "<br>";
    
    try{
                $connection = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME",$USERNAME,$PASSWORD);
                
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<h3>Connected sucessfully</h3>";
                $getMembers = $connection->prepare("SELECT * FROM Members WHERE Tag_ID= '" . $_POST['tag']."'");
                $getMembers->execute();
                $MemberData = $getMembers->fetchAll();
                
                foreach ($MemberData as $member) {
                    echo "<p> Nayme ov da per son akording tu da databaz: " . $member["First_Name"] . " " . $member["Last_Name"]. " </p>";
                    echo "<p> Preev1ous amount ov p01nt5: " . $member["Points"]. " </p>";
                }
                
            }catch(PDOException $e){
                echo "<h3>Connection Failed: " . $e->getMessage() . "</h3>";
            }








?>