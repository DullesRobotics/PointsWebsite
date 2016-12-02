
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
            
            echo $USERNAME;
            
            $file = fopen("logs/scannedID.txt","a+") or die("cant open/create file");
            fwrite($file,$id."\n");
            fclose($file);
            
            
        ?>
        <h3>Cron job test</h3>
    </body>
</html>