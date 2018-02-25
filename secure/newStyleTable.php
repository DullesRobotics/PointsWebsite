<!DOCTYPE html>
<html>
	<head>
		<title>Hours Page</title>

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
	<body style="" onload="loadTable()">
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/navigationBar.php"); ?>


	<div style="text-align:center;">
		<h1>
			<font color="red">
				Dulles Robotics Club Hours Page<br/>
			</font>
			<font color = "">
				How long have you spent in robotics?
			</font>
		</h1>
		<p style="">This page automatically updates every 2 seconds.</p>
		<noscript>
		    <h1 style="color: yellow">This page works better with javascript enabled</h1>
				<h3>But Kenneth the Genius has programmed the web page to accomodate your anti Javascript stance</h3>
		</noscript>

	<div class="container container-fluid" id="tableContainer"><!--Begin Container -->

	</div> <!--close table container-->
	    <script>

	        function loadTable(){
	            $("#tableContainer").load("newTable.php");
	            console.log("Table loaded");
	        }
	        window.setInterval(function(){loadTable()},2000);
	    </script>



	</div>

</html>
