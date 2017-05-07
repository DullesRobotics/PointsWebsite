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
                    echo "<p> Member'z tag as per databaz: " . $member["Tag_ID"] . "</p>";
                    echo "<p> Preev1ous amount ov p01nt5: " . $member["Points"]. " </p>";
                    if($member["Points"] == $_POST['points']){
                        echo "<h1>Hold UP JUST A SEC! THERE IS N0000000000 CH4NG3!!!</h1>";
                    }else{
                        $newPoints = $_POST['points'];
                        $id = $_POST['tag'];
                        if($id == $member["Tag_ID"]){
                            echo "Tag_ID = POST[\'tag\']";
                        }
                        echo "UPDATE Members SET Points= '$newPoints' WHERE Tag_ID='$id' ";
                        $connection->exec("UPDATE Members SET Points= '$newPoints' WHERE Tag_ID='$id' ");
                        $checkGetMembers = $connection->exec("SELECT * FROM Members WHERE Tag_ID= '" . $_POST['tag']."'");
                        $checkMembersData = $checkGetMembers->fetchAll();
                        foreach ($checkMembersData as $checkMember) {
                            echo "<p> New amount ov p01nt5: " . $checkMember["Points"]. " </p>";
                        }
                        
                        
                    }
                }
                
            }catch(PDOException $e){
                echo "<h3>Connection Failed: " . $e->getMessage() . "</h3>";
            }








?>