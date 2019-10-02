<?php
//creates a session which allows global variables to be used
session_start();
session_regenerate_id();
?>
<?php
//if the user is logged in, save the username as a cookie
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

//sets the background image
<body background="background.png">
<?php 
$username = $_POST['username'];
$password = $_POST['password'];
//hashes the password so that it it safely encrypted
$password = hash('md2', $password);

//if both the username and password fields were filled in, continue
if($_POST['username'] != "" & $_POST['password'] != "")
{
	//saves the database information in variables
	$servername = "localhost";
	$sqlname = "[redacted]";
	$sqlpass = "[redacted]";
	$dbname = "skilling_calculator";
	
	// Create connection
	$conn = new mysqli($servername, $sqlname, $sqlpass, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//saves sql queries as strings
	$sql = "Select * FROM users WHERE username='".$username."'";
	
	$sql2 = "INSERT INTO users (username, password)
	VALUES ('" . $username . "', '" . $password . "')";
	
	//if there are no users with your chosen username, continue
	if($conn->query($sql)->num_rows == 0)
	{
		//if the username and password have been successfully written to the users table, continue
		if ($conn->query($sql2) === TRUE) {
			//alerts the user that the registration was successful, redirects the user to index.php
			echo "<script type=\"text/javascript\">
			var JavaScriptAlert = 'Registration successful.';
			alert(JavaScriptAlert);
			window.location = 'index.php';
			</script>";
		}
		//if the username and password were unsuccessful in being written to the users table, continue 
		else {
			//alerts the user that the registration was unsuccessful, redirects the user to index.php
			echo "<script type=\"text/javascript\">
			var JavaScriptAlert = 'There was an error with your registration, please try again.';
			alert(JavaScriptAlert);
			window.location = 'index.php';
			</script>";
		}
	}
	//if there is a user with your chosen username, continue
	else
	{
		//alerts the user that the username was already taken, redirects the user to register.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Username already taken.';
		alert(JavaScriptAlert);
		window.location = 'register.php';
		</script>";
	}
	//closes the connection to the database
	$conn->close();
}
//if any of the username and password fields in the form are empty, continue
else
{
	//alerts the user that the form was not fully filled out, redirects the user to register.php
	echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Form not fully filled out.';
		alert(JavaScriptAlert);
		window.location = 'register.php';
		</script>";
}
?>
</body>
</html>
