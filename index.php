<!DOCTYPE html>
<html>
	<head>
		<title>Points Page</title>
		
		<style>
			.body{
			    position: fixed; 
			    overflow-y: scroll;
			    width: 100%;
				top: -20px;
				left: -20px;
				right: -40px;
				bottom: -40px;
				width: auto;
				height: auto;
				-webkit-filter: blur(0px);

			}



			.header{
				position: absolute;
				top: calc(50% - 35px);
				left: calc(50% - 255px);

			}

			.header div{
				float: left;
				color: #fff;
				font-family: 'Exo', sans-serif;
				font-size: 40px;
				font-weight: 200;
			}

			.header div span{
				color: #F29E20 !important;
			}

			.login{
				position: absolute;
				top: calc(50% - 75px);
				left: calc(50% - 50px);
				height: 150px;
				width: 350px;
				padding: 10px;

			}
			
			.login input[type=button]{
				width: 260px;
				height: 35px;
				background: #fff;
				border: 1px solid #fff;
				cursor: pointer;
				border-radius: 2px;
				color: #a18d6c;
				font-family: 'Exo', sans-serif;
				font-size: 16px;
				font-weight: 400;
				padding: 6px;
				margin-top: 10px;
			}
		</style>
		     <meta http-equiv="refresh" content = "5" />
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
			<!--SITE UNDERGOING CHANGES; IGNORE ANYTHING WEIRD-->
			
			<!--TEMPORARILY OFFLINE; CHECK BACK SOON-->
		</font>
		</h1>
		
		<!--<script>
			$(document).ready(function(e) {
			    var refresher = setInterval("update_content();",5000); // 5 seconds
			})

			function update_content(){
			    $.ajax({
			      type: "GET",
			      url: "index.php", // post it back to itself - use relative path or consistent www. or non-www. to avoid cross domain security issues
			      cache: false, // be sure not to cache results
			    })
			      .done(function( page_html ) {
				    var newDoc = document.documentElement.innerHTML;
					if (page_html != newDoc)
					{
					    	var newDoc = document.open("text/html", "replace");
						newDoc.write(page_html);
					    	newDoc.close();
					}
			    });   
			}
		</script>-->
		 
		<?php
		require("secretSettings.php");
		function getIDurl($stringID){
		     if (strlen($stringID) >= 6 && strlen($stringID) <= 10){
			 return "https://skystorage.iscorp.com/pictures/tx/fortbend//0".$stringID.".JPG";
		     }
		     elseif (strlen($stringID) >= 0 && strlen($stringID) < 6) {
			 return "http://iamattila.com/wp-content/uploads/2014/09/Spy1.png";
		     } else {
			 return NULL;
		     }
		}
		function getIdImageHTMLwithDim($StringId,$w,$h){
		    	$url = getIDurl($StringId) ?: $StringId;
			return "<img src=". $url . " height=" . $h . " width =" .$w.">";
		}
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
			.tg .tg-7ttj{font-size:36px;text-decoration:underline;text-align:center}
			.tg .tg-qj3h{font-size:36px;text-align:center;vertical-align:top}
			.tg .tg-5ofl{font-size:36px;font-family:"Arial Black", Gadget, sans-serif !important;;color:#000000;text-align:center}
			.tg .tg-5ofk{font-size:20px;font-family:"Arial Black", Gadget, sans-serif !important;;background-color:#b1c2ff;color:#000000;text-align:center;vertical-align:top}
			.tg .tg-w08d{background-color:#D2E4FC;font-size:36px;text-align:center;vertical-align:top}
			.tg .tg-c3ly{background-color:#D2E4FC;font-size:36px;text-align:center}
			.tg .tg-c3lz{background-color:#D2E4FC;text-decoration:underline;font-size:36px;text-align:center}
			@media screen and (max-width: 767px) {.tg {width: auto !important;}.tg col {width: auto !important;}.tg-wrap {overflow-x: auto;-webkit-overflow-scrolling: touch;}}
		</style>
		<table class="tg">
		  <tr>
		    <th class="tg-5ofl">Rank</th>
		    <th class="tg-5ofl"> </th>
		    <th class="tg-5ofl">Name</th>
		    <th class="tg-5ofl">Points</th>
		    <th class="tg-5ofk">Meetings<br/>Attended</th>
		    <th class="tg-5ofl">Status</th>
		  </tr>
			<?php
			$indexOn = 1;
			
			
			
			function isOfficer($firstName,$lastName){
				$officers = array('Karim Karim','Kenneth Mitra','Austin Joseph');
				//echo var_dump($officers);
				foreach ($officers as $current){
					//echo "Current: ".$current."\n";
					list($first,$last) = split(' ',$current);
					//echo "First: ".$first."\n";
					//echo "Last: ".$last."\n";
					if ($first == $firstName && $last == $lastName) {
						return true;
					}
				}
				return false;
			}
			
			foreach($data as $person){
				echo "<tr>";
				/*if (strlen($person['Custom_Image']) > 0){
				    $imgHTML = "<img src=". $person['Custom_Image'] . " height=" . "57" . " width =" ."76".">";
				}else{*/
				    $imgHTML = getIdImageHTMLwithDim($person['Student_ID'], "57", "76");
				//} 
                /*
				if ($person['Student_ID'] == 1337){
					$imgHTML = getIdImageHTMLwithDim($person['Custom_Image'], "57", "76");
				} else {
                			$imgHTML = getIdImageHTMLwithDim($person['Student_ID'], "57", "76");
				}
                 * */
                 
				if ($indexOn % 2 == 0){
					if ($indexOn == 2){
						if (isOfficer($person["First_Name"],$person["Last_Name"])){
							echo "<td class = \"tg-c3lz\"<font color = \"#708090\"> Officer</font></td>";
						} else {
							echo "<td class = \"tg-c3lz\"<font color = \"#708090\">".$indexOn." </font></td>";
						}
						echo "<td class = \"tg-c3lz\"> <font color = \"#708090\">".$imgHTML." </font></td>";
						echo "<td class = \"tg-c3lz\"> <font color = \"#708090\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
						echo "<td class = \"tg-c3lz\"> <font color = \"#708090\">".$person['Points']." </font></td>";
						echo "<td class = \"tg-c3lz\"> <font color = \"#708090\">".$person['Num_Meetings']." </font></td>";
					} else {
						if (isOfficer($person["First_Name"],$person["Last_Name"])){
							echo "<td class = \"tg-c3ly\"> <font color = \"#000000\"> Officer</font></td>";
						} else {
							echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$indexOn." </font></td>";
						}
						echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$imgHTML." </font></td>";
						echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
						echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$person['Points']." </font></td>";
						echo "<td class = \"tg-c3ly\"> <font color = \"#000000\">".$person['Num_Meetings']." </font></td>";
					}
					if ($person['Signed_In']%2 == 0){
						echo "<td class = \"tg-c3ly\"> <font color = \"red\"> Signed Out </font> </td>";
					} else {
						echo "<td class = \"tg-c3ly\"> <font color = \"green\"> Signed In </font> </td>";
					}
					
				} else {
					if ($indexOn == 1){
						if (isOfficer($person["First_Name"],$person["Last_Name"])){
							echo "<td class = \"tg-7ttj\"> <font color = \"#FFD700\"> Officer</font></td>";
						} else {
							echo "<td class = \"tg-7ttj\"> <font color = \"#FFD700\">".$indexOn." </font></td>";
						}
						echo "<td class = \"tg-7ttj\"> <font color = \"	#FFD700\">".$imgHTML." </font></td>";
						echo "<td class = \"tg-7ttj\"> <font color = \"	#FFD700\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
						echo "<td class = \"tg-7ttj\"> <font color = \"	#FFD700\">".$person['Points']." </font></td>";
						echo "<td class = \"tg-7ttj\"> <font color = \"	#FFD700\">".$person['Num_Meetings']." </font></td>";
					} elseif ($indexOn == 3){
						if (isOfficer($person["First_Name"],$person["Last_Name"])){
							echo "<td class = \"tg-7ttj\"> <font color = \"#8B4513\"> Officer </font></td>";
						} else {
							echo "<td class = \"tg-7ttj\"> <font color = \"#8B4513\">".$indexOn." </font></td>";
						}
						echo "<td class = \"tg-7ttj\"> <font color = \"	#8B4513\">".$imgHTML." </font></td>";
						echo "<td class = \"tg-7ttj\"> <font color = \"	#8B4513\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
						echo "<td class = \"tg-7ttj\"> <font color = \"	#8B4513\">".$person['Points']." </font></td>";
						echo "<td class = \"tg-7ttj\"> <font color = \"	#8B4513\">".$person['Num_Meetings']." </font></td>";
					} else {
						if (isOfficer($person["First_Name"],$person["Last_Name"])){
							echo "<td class = \"tg-7ttm\"> <font color = \"#000000\"> Officer </font></td>";
						} else {
							echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$indexOn." </font></td>";
						}
						
						echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$imgHTML." </font></td>";
						echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$person['First_Name']." ".$person['Last_Name']." </font></td>";
						echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$person['Points']." </font></td>";
						echo "<td class = \"tg-7ttm\"> <font color = \"#000000\">".$person['Num_Meetings']." </font></td>";
					}
					if ($person['Signed_In']%2 == 0){
						echo "<td class = \"tg-7ttm\"> <font color = \"red\"> Signed Out </font> </td>";
					} else {
						echo "<td class = \"tg-7ttm\"> <font color = \"green\"> Signed In </font> </td>";
					}
				}
				echo "</tr>";
				//echo "Index: ".$indexOn;
				/*if (isOfficer($person["First_Name"],$person["Last_Name"])){
					echo "\nOfficer!";
				} else {
					$indexOn++;
				}*/
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
		<form name="login">
			<div class="login">
					<input type="text" placeholder="Please" name="userid"><br>
					<input type="password" placeholder="Subscribe :)" name="pswrd"><br>
					<input type="button" onclick="check(this.form)" value="Login"/>
			</div>
		</form>
	</div>
        <!-- Bootstrap - Latest compiled JavaScript -->
       	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>

