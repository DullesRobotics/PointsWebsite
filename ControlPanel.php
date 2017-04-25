<!DOCTYPE html>
<?php
	if(isset($_COOKIE["admin"]) && $_COOKIE["admin"]){
		//echo "Allowed! ".$_COOKIE["admin"];
	}else {
		//echo "Nope! ".$_COOKIE["admin"];
	   	header("location:index.php");
	   	die;
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
	<div class="dropdown">
	  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
	  <div id="myDropdown" class="dropdown-content">
		  <?php
		  	$conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "\nConnected successfully\n";
			$getMembers = $conn->prepare("SELECT * FROM Members");
			$getMembers->execute();
			$data = $getMembers->fetchAll();
		  	for ($data as $person) {
				echo "<a href = \"#\">".$person["First_Name"]." ".$person["Last_Name"]."</a>";
			}
		  ?>
	  </div>
	</div>
    <script language="javascript">
	    
    </script>
</body>
</html>
