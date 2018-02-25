<!DOCTYPE html>
<html>
	<head>
		<title>Sign In</title>

		<style>

			form{
				display: inline-block;

			}

		</style>
		     <!--<meta http-equiv="refresh" content = "5" />-->
			<!-- Bootstrap - Latest compiled and minified CSS -->
        		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <noscript>
            <meta http-equiv="refresh" content="5">
        </noscript>
        <?php include_once("analyticstracking.php") ?>
	</head>
	<body style="background-color: black" onload="loadTable()">
	<?php include($_SERVER['DOCUMENT_ROOT'] . "/navigationBar.php"); ?>

      <!--
        <form name="login">
            <div class="login">
                    <input type="button" onclick="loadLogin()" value="Login" style="padding: 5px 10px;"/>
            </div>
        </form>
      -->

	<div style="text-align:center;">
		<h1>
			<font color="red">
				Dulles Robotics Club Sign In Page<br/>
				<!--TEMPORARILY OFFLINE; CHECK BACK SOON-->
			</font>
			<font color = "white">
				Did you sign in today?
			</font>
		</h1>
		<p style="color: white">This page automatically updates every 2 seconds.</p>
		<p style="color:white;">Go to the "Search Attendance" tab to get a list of people who signed in on a particuar date</p>
		<noscript>
		    <h1 style="color: yellow">This page works better with javascript enabled</h1>
				<h3>But Kenneth the Genius has programmed the web page to accomodate your anti Javascript stance</h3>
		</noscript>

	<div id="tableContainer"><!--Begin Container -->

	</div> <!--close table container-->

	    <script>

	        function loadTable(){
	            $("#tableContainer").load("returnSignInTable.php");
	            console.log("Table loaded");
	        }
	        window.setInterval(function(){loadTable()},2000);
	    </script>


		<script>
			function loadLogin()
			{
			    window.open('http://dhsrobotics.ddns.net/secure/ControlPanel.php',"_self");
			}
		</script>
	</div>
        <!-- Bootstrap - Latest compiled JavaScript -->
       	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>
