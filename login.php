<!DOCTYPE html>
<div id="username-target" style="display: none;">
    <?php 
	require("secretSettings.php");
	//$PAGEPASSWORD;
	//$PAGEUSERNAME;
	echo htmlspecialchars($PAGEUSERNAME." ".$PAGEPASSWORD);
    ?>
</div>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login</title>

    <style>
.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
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

  

</head>

<body oncontextmenu="return false">

  <div class="body"></div>
		<div class="grad"></div>
		<br>
		<form name="login">
		<div class="login">
			<input type="text" placeholder="Username" name="userid"><br>
			<input type="password" placeholder="Password" name="pswrd"><br>
			<input type="button" onclick="check(this.form)" value="Login"/>
		</div>
</form>

<script language="javascript">
	var tries = 3;
	var div = document.getElementById("username-target");
    	var myData = div.textContent;
	var splitData = myData.split(' ');
	//alert(myData + "n\" + splitData);
	var username = splitData[4];
	var password = splitData[5];
	//alert("MyData? " + myData + "\nUsername? " + username + "\nPassword? " + password + "\nSplit length: " + splitData.length);
	//alert("Pos2: " + splitData[2] + "\nPos3: " + splitData[3] + "\nPos4: " + splitData[4] + "\nPos5: " + splitData[5] + "\nPos6: " + splitData[6]);
	function check(form)
	{
		if (tries <= 1) {
			window.open("http://dhsrobotics.ddns.net","_self");
		}
		switch(form.userid.value) {
			/*case "123": if (form.pswrd.value == "123") { alert("Do something here!"); }
				else { alert("Incorrect password"); } break;*/
			case username: if (form.pswrd.value == password) { alert("Welcome Admin, you're signed in!"); }
									      else { alert("Incorrect password; " + tries + " tries left."); tries--; } break;	
			default: alert("This user Does Not Exist!");
		}
	}
</script>
</body>
</html>
