<?php
//starts the session so global variables can be used
session_start();
session_regenerate_id();
?>
<?php
//if logged in, user's username is stored as another cookie
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
</head>
<style type="text/css">
//creates a style for a div tag, acts as a box that text is placed in
div.style {
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
//sets the background picture
<body background="background.png">
<div class="style">
<div align="center">
//creates a hyperlinked logo that redirects the user to index.php when clicked
<a href="index.php">
  	<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
    
</a>
<img src="accsettings.png" alt="Account settings" style="width:623px;height:90px;" /><br /><br />

//creates a form for the user to enter their old and new password
<form method = "post" action="changepass2.php">
	<strong>Current Password: </strong><br />
	//creates an input box for the user's old password
    	<input name="currentpass" type="password" size="17" maxlength="15" /><br /><br />
    
   	<strong>New Password: </strong><br />
	//creates an input box for the user's new password
    	<input name="newpass" type="password" size="17" maxlength="15" /><br /><br />
    
	//creates a submit box to submit the form
    	<input type="submit" value="Submit" /><br />
</form>
</div>
</body>
</html>
