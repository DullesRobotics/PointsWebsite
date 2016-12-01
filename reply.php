
<!DOCTYPE html>
<html>
    <head><title>Response</title></head>
    <body>
        <h1>Response</h1>
        <?php
            $raw = file_get_contents('php://input');
            echo $raw;
            $payload = $_POST['payload'];
            echo var_dump($payload);
            echo "\r\n";
            $rcvObj = json_decode($payload);
            
            echo var_dump($rcvObj);
            echo "\r\n";
            echo $rcvObj->time;
        ?>
    </body>
</html>