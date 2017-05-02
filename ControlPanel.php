<!DOCTYPE html>
<?php
 	require("secretSettings.php");
	/*if(isset($_COOKIE["admin"]) && $_COOKIE["admin"]){
		//echo "Allowed! ".$_COOKIE["admin"];*/
	//}else {
		//echo "Nope! ".$_COOKIE["admin"];
	   	header("location:index.php");
	   	//die;
	//}
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
		var person = null;
		
		function toggleDropdown() {
		    document.getElementById("myDropdown").classList.toggle("show");
		}

		function dropdownClicked(button)
		{
			//var user = button.innerHTML;
			document.getElementById("CurrentPerson").innerHTML = "Currently Picked: " + button.innerHTML;
			person = button.innerHTML;
			toggleDropdown();
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
		
		function postDatabase(user,pts,meetings,status){
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp = new XMLHttpRequest();
			} else {
			    // code for IE6, IE5
			    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","http://dhsrobotics.ddns.net/DatabaseControls.php?user=" + user + "&addPts="+pts + "&addMts=" + meetings + "&status=" + status,true);
			xmlhttp.send();
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
		
		function executeMain(){
			var pointsToAdd = document.getElementsByName("PointsToAdd")[0].value;
			var meetingsToAdd = document.getElementsByName("MeetingsToAdd")[0].value;
			var radios = document.getElementsByName('status');
			//var status = [0,0,0];
			var status = "no change";
			for (var i = 0, length = radios.length; i < length; i++) {
			    if (radios[i].checked) {
				status = radios[i].value;
				break;
			    }
			}

			//alert("User: " + person + "\nPoints: " + pointsToAdd + "\nMeetings: " + meetingsToAdd + "\nStatus: " + status);
			postDatabase(person,pointsToAdd,meetingsToAdd,status);
		}
	</script>
  <div class="body"></div>
	<div class="grad"></div>
	<div class="dropdown">
	  <button onclick="toggleDropdown();" class="dropbtn">Pick Member</button>
	  <div id="myDropdown" class="dropdown-content">
	  <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
		  <?php
		  	echo '<a onclick = "dropdownClicked(this)" href = "#">All Members</a>';
			foreach ($data as $person) {
				echo '<a onclick = "dropdownClicked(this)" href = "#">'.$person["First_Name"].' '.$person["Last_Name"].'</a>';
			}
		  ?>
	  </div>
	</div>
	<br>
	<br>
	<label id="CurrentPerson">Currently Picked: No one</label>
	<br>
	<br>
	<label id = "PointsLabel">Points to add:</label>
	<input id = "pts" type="number" step = ".01" name = "PointsToAdd" value="0">
	<br>
	<br>
	<label id = "MeetingsLabel">Meetings to add:</label>
	<input id = "meetings" type = "number" step = ".01" name = "MeetingsToAdd" value = "0">
	<br>
	<br>
	<input id = "choice1" type = "radio" name = "status" value = "sign in">Sign In
	<input id = "choice2" type = "radio" name = "status" value = "sign out">Sign Out
	<input id = "choice3" type = "radio" name = "status" value = "no change">No Change
	<br>
	<br>
	<br>
	<button onclick = "executeMain();">
		<font color = "red">
			Update Database
		</font>
	</button>
</body>
</html>
