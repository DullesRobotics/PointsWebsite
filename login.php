
<!DOCTYPE html>
<html>

<head>
	<?php
	//put this at the first line
	//session_start();
	//if  authentication successful 
	//$_SESSION['login'] = true;
	?>

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
function check(form)
{
	switch(form.userid.value) {
		case "123": if (form.pswrd.value == "123") { alert("Do something here!"); }
			else { alert("Try again!"); } break;
		case "admin": if (form.pswrd.value == "okgo") { alert("Welcome Admin, you're signed in!"); }
								      else { alert("Invalid request!"); } break;	
		default: alert("This user Does Not Exist!");
	}

}
</script>
</body>
</html>
