<?php
    $payload = $_POST['payload'];
    $rcvObj = json_decode($payload);
    echo "RCVD" . $rcvObj->time;
?>