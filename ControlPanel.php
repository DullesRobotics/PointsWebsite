<!DOCTYPE html>
<?php
 	require("secretSettings.php");
	if(isset($_COOKIE["admin"]) && $_COOKIE["admin"]){
		//echo "Allowed! ".$_COOKIE["admin"];
	}else {
		//echo "Nope! ".$_COOKIE["admin"];
	   	header("location:index.php");
	   	die;
	}
	try{
		$conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$getMembers = $conn->prepare("SELECT * FROM Members");
		$getMembers->execute();
		$data = $getMembers->fetchAll();
	}catch(PDOException $e){
	 	echo $e;
  	}
?>	

<html>

<head>

  <meta charset="UTF-8">

  <title>Control Panel</title>
	
<style>
	.dropbtn {
	    background-color: #4CAF50;
	    color: white;
	    padding: 16px;
	    font-size: 16px;
	    border: none;
	    cursor: pointer;
	}
	.dropbtn:hover, .dropbtn:focus {
	    background-color: #3e8e41;
	}
	.dropdown {
	    position: relative;
	    display: inline-block;
	}
	.dropdown-content {
	    display: none;
	    position: absolute;
	    background-color: #f9f9f9;
	    min-width: 160px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	}
	.dropdown-content a {
	    color: black;
	    padding: 12px 16px;
	    text-decoration: none;
	    display: block;
	}
	.dropdown-content a:hover {background-color: #f1f1f1}
	.show {display:block;}	
</style>

</head>
	
<body oncontextmenu="return false">
  <div class="body"></div>
	<div class="grad"></div>
	<div class="dropdown">
	  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
	  <div id="myDropdown" class="dropdown-content">
		  <?php
			foreach ($data as $person) {
				echo '<a href = "#">'.$person["First_Name"].' '.$person["Last_Name"].'</a>';
				echo $person["First_Name"]." loaded!";
			}
		  ?>
	  </div>
	</div>
	
    <script language="javascript">
	    
    </script>
</body>
</html>
