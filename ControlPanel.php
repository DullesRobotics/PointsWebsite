<!DOCTYPE html>
<?php
	if(isset($_COOKIE["admin"]) && $_COOKIE["admin"]){
		echo "Allowed! ".$_COOKIE["admin"];
	}else {
		echo "Nope! ".$_COOKIE["admin"];
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
