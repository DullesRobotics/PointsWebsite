<!DOCTYPE html>
<html>
  <head>
    <title>Error 401: Not Authorized</title>
  </head>
  <body>
    <h1 style="text-align:center;font-size:2em">401</h1>
    <hr />
    <h1 style="text-align:center;font-size:4em">NOT AUTHORIZED</h1>

    <div id="ip" style="text-align:center;border:2px;margin-left:auto;margin-right:auto;">
      <h2>The following has been logged:</h2>
            <h3>User Agent</h3>
            <p><?php echo $_SERVER['HTTP_USER_AGENT'] ?></p>
            <h3>IP Address</h3>
            <p><?php echo $_SERVER['REMOTE_ADDR'] ?></p>

            <h3>Port</h3>
            <p><?php echo $_SERVER['REMOTE_PORT']?></p>
        </div>
  </body>
</html>
