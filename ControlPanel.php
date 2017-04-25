<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION['login']){
		echo "Allowed!";
	}else {
		echo "Nope! ".$_SESSION['login'];
	   	//header("location:index.php");
	   	//die;
	}	
?>	

<html>

<head>

  <meta charset="UTF-8">

  <title>Control Panel</title>

</head>

<body oncontextmenu="return false">
  <div class="body"></div>
		<div class="grad"></div>
		<br>
    <script language="javascript">
	    
    </script>
</body>
</html>
