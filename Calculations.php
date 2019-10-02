<?php
//starts a session for global variables
session_start();
session_regenerate_id();
//if the user has signed in, continue saving the username as a cookie
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
	//cookie saved so that when a calculation is viewed from this page, calculation loads via the calculations table in Methods.php
	setcookie('view', true, time() + (30), '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Calculations</title>
<style type="text/css">
//creates a style for aesthetic purposes with the div class 
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
  align: center;
}
</style>
</script>
</head>
<body background="background.png">
<div class="style">
<div align="center">
//creates a hyperlinked logo that leads to index.php
<a href="index.php">
  	<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
</a>
<img src="calculations.png" alt="Register" style="width:473px;height:90px;" /><br /><br />
//creates a form which allows the variables to be used in the current page when sumbitted
<form action="" method="post">
<?php
//If the user isn't signed in, continue
if(!isset($_COOKIE['cookiename']))
{
	echo "No saved Calculations, please log in via the home screen to save a calculation<br /><br />";
	//creates an input box and submit button for loading a calculation
	echo "Load Calculation via ID: <br /><input name=\"ID\" type=\"text\" size=\"30\" maxlength=\"256\" /><br /><input type=\"submit\" name=\"submit\" value=\"Load Calculation\" />";
	//if the user has submitted the form (loaded a calculation), continue
	if(isset($_POST["ID"]) && $_POST["ID"] != false)
		{
			//sets the string for the SQL query
			$sql = "SELECT SkillID, CurrentXP, GoalXP, BonusXP, GPHR, Actionsgoal, GPXP, GPAction, GPSpent, Efficiency, Time FROM calculations WHERE CalcID ='".$_POST["ID"]."'";
			//sets $_POST["ID"] to false so the previously called calculation can't be accessed by typing in nothing.
			$_POST["ID"] = false;
			//$result is equal to the result of the query to the database
			$result = $conn->query($sql);
			//does a loop for every result of the query 
			while($row = $result->fetch_assoc())
			{
				//assigns session variables so the values can be used in maincalculator.php
				$_SESSION['skillform'] = $row['SkillID'];
				$_SESSION['currentxp'] = $row['CurrentXP'];
				$_SESSION['goalxp'] = $row['GoalXP'];
				$_SESSION['bonusxp'] = $row['BonusXP'];
				$_SESSION['gphr'] = $row['GPHR'];
				$_SESSION['actionsforgoal'] = $row['Actionsgoal'];
				$_SESSION['gpxp'] = $row['GPXP'];
				$_SESSION['gpaction'] = $row['GPAction'];
				$_SESSION['gpspent'] = $row['GPSpent'];
				$_SESSION['efficiency'] = $row['Efficiency'];
				$_SESSION['timetaken'] = $row['Time'];
			}
			//closes the connection to the database
			$conn->close();
			//relocates to Maincalculator.php 
			echo '<script type="text/javascript">
           		 	window.location = "Maincalculator.php"
      			 </script>';
		}
}
//if the user is signed in, continue
else
{
	//sets variables for the database details
	$servername = "localhost";
	$username = "[redacted]";
	$password = "[redacted]";
	$dbname = "skilling_calculator";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	//stores the query for loading user's calculations as a string
	$sql = "SELECT SkillID, CurrentXP, GoalXP, CalcID FROM calculations WHERE Username ='".$_COOKIE['cookiename']."'";
	
	$result = $conn->query($sql);
	$count = 0;
	//runs if there are 1 or more results from the query
	if ($conn->query($sql)->num_rows > 0)
	{
    	echo "<table border=1px solid grey frame=void rules=rows><tr><th>Skill&emsp;</th><th>Starting XP&emsp;</th><th>Goal XP&emsp;</th><th>Calculation ID&emsp;</th><th>&emsp;</th><th>&emsp;</th>";
		echo "</tr>";
    	while($row = $result->fetch_assoc())
		{
		//saves all calculator IDs in a single array, so the correct ID can be selected when the user wants to view/delete a calculation
        	$count = $count + 1;	
		$array[$count] = $row["CalcID"];
			//creates a switch statement which will take the SkillID and convert it to the skillname
			switch ($row["SkillID"]) {
				case 1:
					$row["SkillID"] = "Agility";
					break;
				case 2:
					$row["SkillID"] = "Construction";
					break;
				case 3:
					$row["SkillID"] = "Cooking";
					break;
				case 4:
					$row["SkillID"] = "Crafting";
					break;
				case 5:
					$row["SkillID"] = "Divination";
					break;
				case 6:
					$row["SkillID"] = "Farming";
					break;
				case 7:
					$row["SkillID"] = "Firemaking";
					break;
				case 8:
					$row["SkillID"] = "Fishing";
					break;
				case 9:
					$row["SkillID"] = "Fletching";
					break;
				case 10:
					$row["SkillID"] = "Herblore";
					break;
				case 11:
					$row["SkillID"] = "Hunter";
					break;
				case 12:
					$row["SkillID"] = "Magic";
					break;
				case 13:
					$row["SkillID"] = "Mining";
					break;
				case 14:
					$row["SkillID"] = "Prayer";
					break;
				case 15:
					$row["SkillID"] = "Runecrafting";
					break;
				case 16:
					$row["SkillID"] = "Smithing";
					break;
				case 17:
					$row["SkillID"] = "Summoning";
					break;
				case 18:
					$row["SkillID"] = "Thieving";
					break;
				case 19:
					$row["SkillID"] = "Woodcutting";
					break;
			}
			//outputs rows of tables
			echo "<tr><td>".$row["SkillID"]."</td>&emsp;<td>".$row["CurrentXP"]."</td>&emsp;<td>".$row["GoalXP"]."</td>&emsp;<td>".$row["CalcID"]."</td>&emsp;<td><input type=\"submit\" name=".$row["CalcID"]."1"." value=\"View Calculation\" /></td></td>&emsp;<td><input type=\"submit\" name=".$row["CalcID"]." value=\"Delete Calculation\" /></td></tr>";
		}
		echo "</table>";
	}
	//If the query gives no results, continue
	else
	{
		echo "You have not saved any calculations<br /><br />";
	}
	//creates an input box and submission button for the form
	echo "Load Calculation via ID: <br /><input name=\"ID\" type=\"text\" size=\"30\" maxlength=\"256\" /><br /><input type=\"submit\" name=\"submit\" value=\"Load Calculation\" />";
	//creates a loop from 1 to the amount of IDs
	for($i = 1; $i <= $count; $i++)
	{	
		//If the delete button of a particular calculation is selected, continue
		if(isset($_POST[$array[$i]]))
		{
			//saves database connection info
			$servername = "localhost";
			$username = "[redacted]";
			$password = "[redacted]";
			$dbname = "skilling_calculator";
			
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}
			//Stores the sql query as a string
			$sql = "DELETE FROM calculations WHERE CalcID='".$array[$i]."'";
			//carries out the query; if successful, continue
			$conn->query($sql);
			if($conn->query($sql) === true)
			{
				//alert the user that the calculation was deleted and refresh	
				echo "<script type=\"text/javascript\">
				var JavaScriptAlert = 'Calculation deleted.';
				alert(JavaScriptAlert);
				window.location = 'calculations.php';
				</script>";
			}
			//close connection
			$conn->close();
		}
		//If the view button of a particular calculation is selected, continue
		elseif(isset($_POST[$array[$i]."1"]))
		{
			//stores sql query as a string
			$sql = "SELECT SkillID, CurrentXP, GoalXP, BonusXP, GPHR, Actionsgoal, GPXP, GPAction, GPSpent, Efficiency, Time FROM calculations WHERE CalcID ='".$array[$i]."'";
			$result = $conn->query($sql);
			//for every record accepted, use $row as the raw text for a field
			while($row = $result->fetch_assoc())
			{
				//saves session variables 
				$_SESSION['skillform'] = $row['SkillID'];
				$_SESSION['currentxp'] = $row['CurrentXP'];
				$_SESSION['goalxp'] = $row['GoalXP'];
				$_SESSION['bonusxp'] = $row['BonusXP'];
				$_SESSION['gphr'] = $row['GPHR'];
				$_SESSION['actionsforgoal'] = $row['Actionsgoal'];
				$_SESSION['gpxp'] = $row['GPXP'];
				$_SESSION['gpaction'] = $row['GPAction'];
				$_SESSION['gpspent'] = $row['GPSpent'];
				$_SESSION['efficiency'] = $row['Efficiency'];
				$_SESSION['timetaken'] = $row['Time'];
			}
			//closes connection to the database
			$conn->close();
			//redirects the user to Maincalculator.php
			echo '<script type="text/javascript">
           		 	window.location = "maincalculator.php"
      			 </script>';
		}
		//else if the load calculation button is selected, continue
		elseif(isset($_POST["ID"]) && $_POST["ID"] != false)
		{
			//stores the sql query as a string
			$sql = "SELECT SkillID, CurrentXP, GoalXP, BonusXP, GPHR, Actionsgoal, GPXP, GPAction, GPSpent, Efficiency, Time FROM calculations WHERE CalcID ='".$_POST["ID"]."'");
			$_POST["ID"] = false;
			$result = $conn->query($sql);
			//creates a loop that while running, $row is the raw data from the field of the current record in the calculations table
			while($row = $result->fetch_assoc())
			{
				//saves session variables so they can be used in Maincalculator.php
				$_SESSION['skillform'] = $row['SkillID'];
				$_SESSION['currentxp'] = $row['CurrentXP'];
				$_SESSION['goalxp'] = $row['GoalXP'];
				$_SESSION['bonusxp'] = $row['BonusXP'];
				$_SESSION['gphr'] = $row['GPHR'];
				$_SESSION['actionsforgoal'] = $row['Actionsgoal'];
				$_SESSION['gpxp'] = $row['GPXP'];
				$_SESSION['gpaction'] = $row['GPAction'];
				$_SESSION['gpspent'] = $row['GPSpent'];
				$_SESSION['efficiency'] = $row['Efficiency'];
				$_SESSION['timetaken'] = $row['Time'];
			}
			//closes the connection to the database
			$conn->close();
			//redirects the user to Maincalculator.php
			echo '<script type="text/javascript">
           		 	window.location = "maincalculator.php"
      			 </script>';
		}
	}
}
?>
</form>
</div>
</div>
</body>
</html>
