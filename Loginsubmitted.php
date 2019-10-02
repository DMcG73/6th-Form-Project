<?php
//creates a session in which global variables can be called
session_start();
session_regenerate_id(true);
//unsets the logout cookie
setcookie('logout', '', time() - 86400, '/');
$username = $_POST['username'];
$password = $_POST['password'];
//hashes the password so that it is safely encrypted
$password = hash('md2', $password);

//if the username and password were selected in the previous form
if($_POST['username'] != "" & $_POST['password'] != "")
{
	//saves the database connection information as variables
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
	//saves sql query as a string 
	$sql = "Select username FROM users WHERE username='".$username."' and password='".$password."'";
	
	//if the query gives 1 or more results
	if($conn->query($sql)->num_rows > 0)
	{
		//sets the state of being logged out to false
		$_SESSION['logout'] = false;
		//sets the user's username as a cookie
		setcookie('cookiename', $_POST['username'], time() + (86400 * 30), '/'); // 86400 = 1 day
		//alerts the user that the sign in was successful and redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Sign in successful.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";

	}
	//if the query gives no results
	else
	{
		//alerts the user that they entered an incorrect username or password, redirects user to login.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Incorrect username or password';
		alert(JavaScriptAlert);
		window.location = 'login.php';
		</script>";
	}
	//closes connection to the database
	$conn->close();
}
//if the username and password weren't both selected
else
{
	//alerts the user that the form wasn't fully filled out, redirects the user to login.php
	echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Form not fully filled out.';
		alert(JavaScriptAlert);
		window.location = 'login.php';
		</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login to Runescape Calcs</title>
</head>

<body>

</body>
</html>
