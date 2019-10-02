<?php
//creates a session so that global variables can be used
session_start();
session_regenerate_id();
?>
<?php
//if the user is logged in, their username is saved as a cookie
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
//sets a background image
<body background="background.png">
<?php 

//if the form values for either the new password or the old password haven't been set, contine
if(!isset($_POST['currentpass'], $_POST['newpass']))
{
	//Alert the user that they haven't filled out the form and redirects them to changepass.php
	echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'You have not fully filled out the form.';
		alert(JavaScriptAlert);
		window.location = 'changepass.php';
		</script>";
}
//if the form values for the new password and the old password are the same, continue
elseif($_POST['currentpass'] == $_POST['newpass'])
	{
		//Alert the user that they chose the same password twice and redirects them to changepass.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Your new password is the same as your old password.';
		alert(JavaScriptAlert);
		window.location = 'changepass.php';
		</script>";
	}
//if the input is valid, continue
else
{
	//hashes the password values so they can be securely saved
	$oldpassword = hash('md2', $_POST['currentpass']);
	$newpassword = hash('md2', $_POST['newpass']);

	//stores values for database connection information
	$servername = "localhost";
	$username = "[redacted]";
	$password = "[redacted]";
	$dbname = "skilling_calculator";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//creates a string to hold an sql query
	$sql = "SELECT Username from users WHERE Password='".$oldpassword."' AND Username='".$_COOKIE['cookiename']."'";
	//if the old password is the user's current password, continue
	if($conn->query($sql)->num_rows > 0)
	{
		//creates a string to hold an sql query
		$sql1 = "UPDATE users SET Password='".$newpassword."' WHERE Username='".$_COOKIE['cookiename']."'";
		//executes the query
		$conn->query($sql1);
		//Alerts the user that the password was successfully changed and redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Your password has successfully been changed.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//if there are no results for searching for a record with the selected password and the user's current username
	else
	{
		//alerts the user that there was an error, may be due to an incorrect current password, redirects them to changepass.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'There was an error with changing your password, you may have inputted an incorrect current password';
		alert(JavaScriptAlert);
		window.location = 'changepass.php';
		</script>";
		
	}
	$conn->close();
}
?>
</body>
</html>
