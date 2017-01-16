<!DOCTYPE html>
<html>
	<head>
		<title>Points Page</title>
			<!-- Bootstrap - Latest compiled and minified CSS -->
        		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>
	<body>
	<nav class="navbar navbar-inverse"
	<div style="text-align:center;">
		<h1>
		<font color="red">
	    		Dulles Robotics Club Points Page
		</font>
		</h1>
		<?php
		require("secretSettings.php");
		try
		{
		   $conn = new PDO("mysql:host=$SERVERNAME;dbname=$DBNAME", $USERNAME, $PASSWORD);
		   echo "Connected Successfully";
		}
		catch (PDOException $e) {
		    echo "Failed to connect to database";
		    exit;
		}
		$getMembers = $conn->prepare("SELECT * FROM Members ORDER BY Points DESC");
		//echo "Got Table Members";
		$getMembers->execute();
		//echo "Executed";
		$data = $getMembers->fetchAll();
		//echo "Fetched";
		
		?>
		<style type="text/css">
			.tg  {border-collapse:collapse;border-spacing:0;border-color:#aabcfe;margin:0px auto;}
			.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#669;background-color:#e8edff;}
			.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aabcfe;color:#039;background-color:#b9c9fe;}
			.tg .tg-fity{font-size:36px;font-family:"Arial Black", Gadget, sans-serif !important;;color:#000000;text-align:center;vertical-align:top}
			.tg .tg-7ttm{font-size:36px;text-align:center}
			.tg .tg-qj3h{font-size:36px;text-align:center;vertical-align:top}
			.tg .tg-5ofl{font-size:36px;font-family:"Arial Black", Gadget, sans-serif !important;;color:#000000;text-align:center}
			.tg .tg-w08d{background-color:#D2E4FC;font-size:36px;text-align:center;vertical-align:top}
			.tg .tg-c3ly{background-color:#D2E4FC;font-size:36px;text-align:center}
		</style>
		<table class="tg">
		  <tr>
		    <th class="tg-5ofl">First Name</th>
		    <th class="tg-5ofl">Last Name</th>
		    <th class="tg-5ofl">Points</th>
		    <th class="tg-5ofl">Meetings Attended</th>
		    <th class="tg-5ofl">Status</th>
		  </tr>
			<?php
			$indexOn = 0;
			foreach($data as $person){
				echo "<tr>";
				if ($indexOn % 2 == 0){
					echo "<td class = \"tg-c3ly\">".$person['First_Name']."</td>";
					echo "<td class = \"tg-c3ly\">".$person['Last_Name']."</td>";
					echo "<td class = \"tg-c3ly\">".$person['Points']."</td>";
					echo "<td class = \"tg-c3ly\">".$person['Num_Meetings']."</td>";
					if ($person['Signed_In']%2 == 0){
						echo "<td class = \"tg-c3ly\"> <font color = \"red\"> Signed Out </font> </td>";
					} else {
						echo "<td class = \"tg-c3ly\"> <font color = \"green\"> Signed In </font> </td>";
					}
					
				} else {
					echo "<td class = \"tg-7ttm\">".$person['First_Name']."</td>";
					echo "<td class = \"tg-7ttm\">".$person['Last_Name']."</td>";
					echo "<td class = \"tg-7ttm\">".$person['Points']."</td>";
					echo "<td class = \"tg-7ttm\">".$person['Num_Meetings']."</td>";
					if ($person['Signed_In']%2 == 0){
						echo "<td class = \"tg-7ttm\"> <font color = \"red\"> Signed Out </font> </td>";
					} else {
						echo "<td class = \"tg-7ttm\"> <font color = \"green\"> Signed In </font> </td>";
					}
				}
				echo "</tr>";
				//echo "Index: ".$indexOn;
				$indexOn++;
			}
			?>
		  <!--<tr>
		    <td class="tg-rqeu">TEST</td>
		    <td class="tg-rqeu">TWO</td>
		    <td class="tg-rqeu">0</td>
		    <td class="tg-rqeu">0</td>
		  </tr>
		  <tr>
		    <td class="tg-w08d">TEST</td>
		    <td class="tg-w08d">THREE</td>
		    <td class="tg-w08d">0</td>
		    <td class="tg-w08d">0</td>
		  </tr>-->
		</table>
	</div>
        <!-- Bootstrap - Latest compiled JavaScript -->
       	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>

