
<!DOCTYPE html>
<html>
    <head><title>Response</title></head>
    <body>
        <h1>Response</h1>
        <?php
            require("secretSettings.php");
            $raw = file_get_contents('php://input');
            echo "Raw: " . $raw;
            $contents = split(":", $raw);
            //$id = trim(str_replace("}", "", $contents[1]));
            $id = trim(substr($contents[1],1,-6)) ?: '0000';
            echo "      ID: " .$id;
            
            
            
            $file = fopen("logs/scannedID.txt","a+") or die("cant open/create file");
            $outputFile = fopen("logs/output.txt","a+") or die ("cant create/open/write to output file");
            $signedLogs = fopen("logs/attendanceLogs.txt","a+") or die("cant open/create file");
            fwrite($file,$id."\n");
            /*fwrite($outputFile,"------------------------\n");
            fwrite($outputFile,"ID: ".$id."\n");
            fwrite($outputFile,"raw: ".$raw."\n");
            fwrite($outputFile,"contents 1: ".$contents[1]."\n");
            fwrite($outputFile,"------------------------");*/
            fclose($outputFile);
            fclose($file);
            
            //$timeVar = date('Y-m-d H:i:s');
            //$timeVar = CURRENT_TIMESTAMP;
            //echo "      Time: " . $timeVar;
            try {
                $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
             // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "\nConnected successfully\n";
                //$sql = "INSERT INTO attendance (badgeID,timeScanned) VALUES ($id,$timeVar)"; //Dont forget to change column
                //$sql = "INSERT INTO 'attendance' (badgeID,'time') VALUES ($id,$time)"; //Use this if you dont rename the column
                $getMembers = $conn->prepare("SELECT * FROM Members");
                //$getAttendance = $conn->prepare("SELECT * FROM attendance WHERE timeScanned > unix_timestamp() + 43200");
                $getMembers->execute();
                //$getAttendance->execute();
                $data = $getMembers->fetchAll();
                //$attendanceData = $getAttendance->fetchAll();
                foreach($data as $person){
                    if ($person["Tag_ID"] == $id){
                        $name = $person['First_Name']." ".$person['Last_Name'];
                        $sql = "INSERT INTO attendance (Full_Name,badgeID) VALUES ('$name','$id')";
                        $conn->exec($sql);
                        $lastScanTime = strtotime($person['Last_Time']);
                        echo "Last: ".$lastScanTime."\n";
                        $currentTime = strtotime(date('Y-m-d H:i:s'));
                        echo "Now: ".$currentTime."\n";
                        $difference = $currentTime - $lastScanTime;
                        if ($person["Signed_In"] % 2 == 1){
                            if ($difference > 900){
                               $conn->exec("UPDATE Members SET Num_Meetings = Num_Meetings + 1 WHERE Tag_ID = '$id'"); 
                            } else {
                               echo "User was not there for 15 minutes. Meeting not recorded. \n"; 
                               fwrite($signedLogs,$person["First_Name"]." ".$person["Last_Name"]." signed out too quick.\n");
                            }
                            if ($difference > 43200) {
                                echo "Difference is greater than 12 hours \n";
                                fwrite($signedLogs,$person["First_Name"]." ".$person["Last_Name"]." did not sign out for over 12 hours and was not awarded points.\n");
                                break;
                            }
                            $pointsToAdd = floor($difference/1800);
                            echo $person["First_Name"]." ".$person["Last_Name"]." successfully signed out. \n";
                            fwrite($signedLogs,date('Y-m-d H:i:s')." ".$person["First_Name"]." ".$person["Last_Name"]." successfully signed out. Awarded ".$pointsToAdd." points!\n");
                            echo "Time Difference: ".gmdate("H:i:s", $difference)."\n";
                            if ($pointsToAdd > 0) {
                                $conn->exec("UPDATE Members SET Points = Points + '$pointsToAdd' WHERE Tag_ID = '$id'");
                                echo "Points awarded: ".$pointsToAdd."\n";
                                fwrite($signedLogs,$person['First_Name']." ".$person['Last_Name']." awarded ".$pointsToAdd."\n");
                            }
                        } else {
                            echo $person["First_Name"]." ".$person["Last_Name"]." successfully signed in. \n";
                            fwrite($signedLogs,date('Y-m-d H:i:s')." ".$person["First_Name"]." ".$person["Last_Name"]." successfully signed in. \n");
                        }
                        break;
                    }
                }
                $conn->exec("UPDATE Members SET Signed_In = Signed_In + 1 WHERE Tag_ID = '$id'");
                echo("Successfully Updated\n");
              }
            catch(PDOException $e)
                {
                    echo "\nConnection aborted: " . $e->getMessage();
                    exit;
                }
        fclose($signedLogs);
        
        ?>
        <h3>Cron job test</h3>
    </body>
</html>
