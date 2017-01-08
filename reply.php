
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
            $id = trim(str_replace("}", "", $contents[1]));
            echo "      ID: " . $id;
            
            
            $file = fopen("logs/scannedID.txt","a+") or die("cant open/create file");
            fwrite($file,$id."\n");
            fclose($file);
            
            $timeVar = date('Y-m-d H:i:s');
            echo "      Time: " . $timeVar;

        try {
            $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
         // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "\nConnected successfully\n";
            $sql = "INSERT INTO attendance (badgeID,timeScanned) VALUES ($id,'".$timeVar."'"); //Dont forget to change column
            //$sql = "INSERT INTO 'attendance' (badgeID,'time') VALUES ($id,$time)"; //Use this if you dont rename the column
            //$sql = "INSERT INTO 'attendance' (badgeID) VALUES ($id)";
            $conn->exec($sql);
            echo "New record created successfully";
          }
        catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
            
        ?>
        <h3>Cron job test</h3>
    </body>
</html>
