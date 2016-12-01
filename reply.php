
<!DOCTYPE html>
<html>
    <head><title>Response</title></head>
    <body>
        <h1>Response</h1>
        <?php
            $payload = $_POST['payload'];
            $rcvObj = json_decode($payload);
            echo "RCVD" . $rcvObj->time;
        ?>
    </body>
</html>