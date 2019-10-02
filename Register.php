<?php
//creates a session so that global variables can be used
session_start();
session_regenerate_id();
?>
<?php
//if the user is signed in, a cookie is created that stores the user's username
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
//creates a style used with forms, for aesthetic purposes
form {
  border: 2px solid #006699;
  background: -webkit-linear-gradient( #fff, #C0C1C2);
  background: -moz-linear-gradient( #fff, #C0C1C2);
  background: -ms-linear-gradient( #fff, #C0C1C2);
  background: -o-linear-gradient( #fff, #C0C1C2);
  width: 50%;
  padding-bottom: 1%;
  margin-left: auto;
  margin-right: auto;
  border-radius: 25px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register to Runescape Calcs</title>
</head>


<body>
//sets a background image
<body background="background.png">
<div align="center">

<div style="form">
//starts a form which posts values to savedetails.php
<form method = "post" action="savedetails.php">
	//creates a hyperlinked image which when clicked redirects the user to index.php
	<a href="index.php">
  		<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
	</a>
    <img src="registration.png" alt="Register" style="width:473px;height:90px;" /><br /><br />
	<br /><strong>Username:</strong><br />
	//creates an input box for the user to input their username
    <input name="username" type="text" size="11" maxlength="12" /><br /><br />

    <strong>Password:</strong><br />
	//creates an input box for the user to input their password
    <input name="password" type="password" size="14" maxlength="15" /><br /><br />
    
	//creates a submit button that submits the values to savedetails.php
    <input type="submit" value="Submit" /><br />
    
</form>
</div>
</div>
</body>
</html>
