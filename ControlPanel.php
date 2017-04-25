<!DOCTYPE html>
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
	<?php
		if(!$_SESSION['login']){
		   header("location:index.php");
		   die;
		}	
	?>
</body>
</html>
