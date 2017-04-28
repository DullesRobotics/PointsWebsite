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
	#myInput {
	    border-box: box-sizing;
	    background-image: url('searchicon.png');
	    background-position: 14px 12px;
	    background-repeat: no-repeat;
	    font-size: 16px;
	    padding: 14px 20px 12px 45px;
	    border: none;
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
	    padding: 6px 8px;
	    text-decoration: none;
	    display: block;
	}
	.dropdown-content a:hover {background-color: #f1f1f1}
	.show {display:block;}	
</style>

</head>
	
<body oncontextmenu="return false">	
	<script language="javascript">
		function toggleDropdown() {
		    document.getElementById("myDropdown").classList.toggle("show");
		}

		function changeBtnName(to)
		{
			document.getElementById("myDropdown").value = to;
			<?php
				echo "done?";
			?>
		}

		function dropdownClicked(button)
		{
			//var user = button.innerHTML;
			changeBtnName(button);
			document.getElementById("myDropdown").classList.toggle("show");
			/*if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp = new XMLHttpRequest();
			} else {
			    // code for IE6, IE5
			    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","http://dhsrobotics.ddns.net/DatabaseControls.php?q="+user,true);
			xmlhttp.send();*/
		}

		function filterFunction() {
		    var input, filter, ul, li, a, i;
		    input = document.getElementById("myInput");
		    filter = input.value.toUpperCase();
		    div = document.getElementById("myDropdown");
		    a = div.getElementsByTagName("a");
		    for (i = 0; i < a.length; i++) {
			if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
			    a[i].style.display = "";
			} else {
			    a[i].style.display = "none";
			}
		    }
		}
	</script>
  <div class="body"></div>
	<div class="grad"></div>
	<div class="dropdown">
	  <button onclick="toggleDropdown()" class="dropbtn">Pick Member</button>
	  <div id="myDropdown" class="dropdown-content">
	  <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
		  <?php
			foreach ($data as $person) {
				echo '<a onclick = "dropdownClicked(this)" href = "#">'.$person["First_Name"].' '.$person["Last_Name"].'</a>';
			}
		  ?>
	  </div>
	</div>
</body>
</html>
