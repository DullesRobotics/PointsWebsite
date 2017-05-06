<!DOCTYPE html>
<html>
    <head>
        <title>SQL Test Page</title>
        <style>
            #main_title{
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1 id="main_title">SQL Test Page</h1>
        <?php
            require 'secretSettings.php';
            try{
                $connection = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME",$USERNAME,$PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<h3>Connected sucessfully</h3>";
            }catch(PDOException $e){
                echo "<h3>Connection Failed: " . $e->getMessage() . "</h3>";
            }
        ?>
    </body>
</html>