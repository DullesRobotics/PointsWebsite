
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
            
            $time = date('Y-m-d h:i:s');
            echo $time;

        try {
            $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
         // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "\nConnected successfully\n";
            $sql = "INSERT INTO attendance (badgeID,time) VALUES ($id,$time)";
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