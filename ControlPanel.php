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
	
<style>
	/* Dropdown Button */
	.dropbtn {
	    background-color: #4CAF50;
	    color: white;
	    padding: 16px;
	    font-size: 16px;
	    border: none;
	    cursor: pointer;
	}

	/* Dropdown button on hover & focus */
	.dropbtn:hover, .dropbtn:focus {
	    background-color: #3e8e41;
	}

	/* The container <div> - needed to position the dropdown content */
	.dropdown {
	    position: relative;
	    display: inline-block;
	}

	/* Dropdown Content (Hidden by Default) */
	.dropdown-content {
	    display: none;
	    position: absolute;
	    background-color: #f9f9f9;
	    min-width: 160px;
	    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	    z-index: 1;
	}

	/* Links inside the dropdown */
	.dropdown-content a {
	    color: black;
	    padding: 12px 16px;
	    text-decoration: none;
	    display: block;
	}

	/* Change color of dropdown links on hover */
	.dropdown-content a:hover {background-color: #f1f1f1}

	/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
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
		  	require("secretSettings.php");
		  	$conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
