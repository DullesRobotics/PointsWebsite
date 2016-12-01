
<!DOCTYPE html>
<html>
    <head><title>Response</title></head>
    <body>
        <h1>Response</h1>
        <?php
            $payload = $_POST['payload'];
            $rcvObj = json_decode($payload);
            echo $payload;
            echo "\r\n";
            echo var_dump($rcvObj);
            echo "\r\n";
            echo $rcvObj->time;
        ?>
    </body>
</html>