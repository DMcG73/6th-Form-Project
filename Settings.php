<?php
//creates a session which allows global variables to be used
session_start();
session_regenerate_id();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Account Settings</title>
<style type="text/css">
//creates a style that can be used with a div tag, for aesthetic purposes
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
<script type="text/javascript">
//creates a function for deleting an account
function delacc()
{
	//asks the user if they wish to delete their account
	var conf = confirm('Are you sure you wish to delete your account?');
	//if the user confirmed, continue
	if(conf == true)
	{
		//saves the details of the database
		<?php
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
		//stores the sql query as a string
		$sql = "DELETE FROM users WHERE username='".$_COOKIE['cookiename']."'";
		//carries out the query
		$conn->query($sql);
		//closes the connection to the database
		$conn->close();
		session_destroy();
		?>
		//redirects the user to index.php
		window.location = 'index.php';
	}	
}
</script>
<?php
//if the user is logged in, set a cookie for the user's username
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
}
?>
</head>
<body>
//sets a background image
<body background="background.png">
<div class="style">
<div align="center">
//creates a hyperlinked logo that when clicked redirects the user to index.php
<a href="index.php">
  	<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
    
</a>
<img src="accsettings.png" alt="Account settings" style="width:623px;height:90px;" /><br /><br />

//creates a button which when clicked, calls the function delacc to delete the user's account
<button onclick="delacc();">Delete Account</button><br /><br />
//creates a button which when clicked, redirects the user to changepass.php to change the user's password
<button onclick="window.location.href = 'changepass.php'">Change Password</button>
</div>
</div>
</body>
</body>
</html>
