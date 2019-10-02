//creates a session so that global variables can be used
<?php
session_start();
session_regenerate_id();
?>
<?php
//if the user is logged in, create a cookie which stores the user's username
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
//creates a style for the table that gives the calculator structure
table.calcbuttons {
	float: left;
	background: -webkit-linear-gradient( #fff, #000);
	background: -moz-linear-gradient( #fff, #000);
	background: -ms-linear-gradient( #fff, #000);
	background: -o-linear-gradient( #fff, #000);
	background-repeat: no-repeat;
	background-attachment: fixed;
	border-radius: 12px;
	border: 1px solid #000000;
}
//creates a style for the buttons on the calculator
input.calcbuttons {
	border-radius: 3px;
	margin: 3px;
	width: 90%;
}
//creates a style for the datagrid on the table
.datagrid table {
	border-radius: 25px;
	border-collapse: collapse;
	text-align: left;
	width: 100%;
	float: right;
} 
//creates a style for the datagrid
.datagrid {
	font: normal 12px/150% Arial, Helvetica, sans-serif; 
	background: #fff; 
	overflow: hidden; 
	border: 1px solid #8C8C8C; 
	-webkit-border-radius: 3px; 
	-moz-border-radius: 3px; 
	border-radius: 25px;
	width: 80%;
	float: right;
}
//creates a style for the table head
.datagrid table td, .datagrid table th {
	padding: 3px 10px;
}
//creates a style for the table head
.datagrid table thead th {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );
	background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 50% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');		
	background-color:#8C8C8C;
	color:#FFFFFF;
	font-size: 15px;
	font-weight: bold; 
	border-left: 1px solid #A3A3A3;
} 
//creates a style for the table head
.datagrid table thead th:first-child {
	border: none;
}
/creats a style for the table body
.datagrid table tbody td {
	color: #7D7D7D; 
	border-left: 1px solid #DBDBDB;
	font-size: 12px;
	font-weight: normal;
}
//creates a style for the table body
.datagrid table tbody .alt td {
	background: #EBEBEB; 
	color: #7D7D7D; 
}
//creates a style for the table body
.datagrid table tbody td:first-child { 
	border-left: none;
}
//creates a style for the table body
.datagrid table tbody tr:last-child td {
	border-bottom: none;
}
//creates a style for the table foot
.datagrid table tfoot td div { 
	border-top: 1px solid #8C8C8C;
	background: #EBEBEB;
} 
//creates a style for the table foot
.datagrid table tfoot td {
	padding: 0;
	font-size: 12px
} 
//creates a style for the table foot
.datagrid table tfoot td div{ 
	padding: 2px;
}
//creates a style for the table foot
.datagrid table tfoot td ul {
	margin: 0;
	padding:0;
	list-style: none;
	text-align: right;
}
//creates a style for the table foot
.datagrid table tfoot  li {
	display: inline;
}
//creates a style for the table foot
.datagrid table tfoot li a {
	text-decoration: none;
	display: inline-block;
	padding: 2px 8px;
	margin: 1px;
	color: #F5F5F5;
	border: 1px solid #8C8C8C;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );
	background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 50% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');
	background-color:#8C8C8C;
}
//creates a style for the table foot
.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { 
	text-decoration: none;
	border-color: #7D7D7D; 
	color: #F5F5F5; 
	background: none; 
	background-color:#8C8C8C;	
}
//creates a style for the entire table
div.dhtmlx_window_active, div.dhx_modal_cover_dv {
	position: fixed;
}
//creates a style for the calculator
table.calcbuttons1 {	float: left;
	background: -webkit-linear-gradient( #fff, #000);
	background: -moz-linear-gradient( #fff, #000);
	background: -ms-linear-gradient( #fff, #000);
	background: -o-linear-gradient( #fff, #000);
	background-repeat: no-repeat;
	background-attachment: fixed;
	border-radius: 12px;
	border: 1px solid #000000;
}
//creates a style for the calculator
table.calcbuttons11 {float: left;
	background: -webkit-linear-gradient( #fff, #000);
	background: -moz-linear-gradient( #fff, #000);
	background: -ms-linear-gradient( #fff, #000);
	background: -o-linear-gradient( #fff, #000);
	background-repeat: no-repeat;
	background-attachment: fixed;
	border-radius: 12px;
	border: 1px solid #000000;
}
</style>
<script type="text/javascript">
//creates a function for when a button on the calculator is pressed (not =)
function calcbutton(buttonValue) {
	//if the button pressed is C, clear the input box in the calculator
	if (buttonValue == 'C') {
		document.getElementById('calculator').value = '';
	}
	//if the button pressed isn't c, add the button to the input box in the calculator
	else 
	{
		document.getElementById('calculator').value += buttonValue;
	}
}
//creates a function for when the = button is pressed on the calculator
function calculate(equation) {
	//the result on the calculator is the numeric value of the equation
	var answer = eval(equation);
	document.getElementById('calculator').value = answer;
}

<?php
//If the user is logged in, continue
if(!isset($_COOKIE['view']))
{
?>
	//creates a function that saves the calculation
	function savecalc()
	{
		//sets variables as the details for connecting to the database
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
		//creates a hash ID for the CalculatorID, since it's based on the user and the time saved, there shouldn't be any calculations with the same id
		$id = time().$_COOKIE['cookiename'];
		$idhash = hash('md2', $id);
		//saves the sql query as a string
		$sql = "INSERT INTO calculations (CalcID, Username, SkillID, CurrentXP, GoalXP, BonusXP, GPHR, Actionsgoal, GPXP, GPAction, GPSpent, Efficiency, Time) VALUES ('".$idhash."', '".$_COOKIE['cookiename']."','".$_SESSION['skillform']."', '".$_SESSION['currentxp']."', '".$_SESSION['goalxp']."', '".$_SESSION['bonusxp']."', '".$_SESSION['gphr']."', '".$_POST['actionsforgoal']."', '".$_POST['gpxp']."', '".$_POST['gpaction']."', '".$_POST['gpspent']."', '".$_POST['efficiency']."', '".$_POST['timetaken']."')";
		//if the query was successful, continue
		if ($conn->query($sql) === TRUE)
		{
			//alerts the user that the calculation was saved successfully, gives them the CalcID
			?>
			var JavaScriptAlert = 'Calculation saved, use the id <?php echo $idhash ?> to share the calculation, you may access this calculation via the index.';
			alert(JavaScriptAlert);
			<?php
		} 
		//if the query wasn't successful, print the error message
		else 
		{
			echo $conn->error;
		}
		?>
	}
<?php
}
?>
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Skilling Calculator</title>
</head>
//sets the background picture
<body background="background.png">
<div align="center">
//creates a hyperlinked logo that redirects the user to index.php when clicked
<a href="index.php">
	<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
</a>
</div>
<div class="datagrid">


<?php
//if a user is logged in, add a button that when clicked, calls the function savecalc
if(isset($_COOKIE['cookiename']) && !isset($_COOKIE['view']))
{
	echo "<div align=\"center\"><button onclick=\"savecalc();\">Save Calculation</button></div>";
}
//if the view cookie is set (if the calculation is accessed through the viewing a saved calculation interface), continue
if(isset($_COOKIE['view']))
{
	//sets variables used in the calculations to the standard used in regular calculations
	$_POST['actionsforgoal'] = $_SESSION['actionsforgoal'];
	$_POST['gpxp'] = $_SESSION['gpxp'];
	$_POST['gpaction'] = $_SESSION['gpaction'];
	$_POST['gpspent'] = $_SESSION['gpspent'];
	$_POST['efficiency'] = $_SESSION['efficiency'];
	$_POST['time'] = $_SESSION['timetaken'];
}

//saves the details for connecting to the database as variables
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
//saves an sql query as a string
$sql = "SELECT Method, Level, XP, XPHR FROM methods WHERE SkillID = $_SESSION[skillform]";
$result = $conn->query($sql);

//if the result of querying gives more than 0 results, continue
if ($result->num_rows > 0) {
	//creates a table with headers for each column needed in the calculation
    echo "<table style='float:right;' border=1px solid grey frame=void rules=rows><tr><th>Method&emsp;</th><th>Level&emsp;</th><th>XP&emsp;</th>";
	//creates columns for additional extras, if the user has chosen to calculate them as well
	if (!empty($_POST['actionsforgoal']))
	{
		echo "<th>Actions needed&emsp;</th>";
	}
	if (!empty($_POST['gpxp']))
	{
		echo "<th>GP/XP&emsp;</th>";
	}
	if (!empty($_POST['gpaction']))
	{
		echo "<th>GP/Action&emsp;</th>";
	}
	if (!empty($_POST['gpspent']))
	{
		echo "<th>Total GP&emsp;</th>";
	}
	if (!empty($_POST['efficiency']))
	{
		echo "<th>Efficiency&emsp;</th>";
	}
	if (!empty($_POST['timetaken']))
	{
		echo "<th>Time taken (hours)&emsp;</th>";
	}
	echo "</tr>";
	//starts a loop that when running, $row holds the raw data in the current record
    while($row = $result->fetch_assoc()) {
	//prints out the raw data in a new row
        echo "<tr class='alt'><td>".$row["Method"]."</td>&emsp;<td>".$row["Level"]."</td>&emsp;<td>".$row["XP"]."</td>&emsp;";
		//prints out the raw data in a new row for additional extras
		if (!empty($_POST['actionsforgoal']))
		{
			echo "<td>".ceil(($_SESSION['goalxp']-$_SESSION['currentxp'])/$row["XP"])."</td>";
		}
		if (!empty($_POST['gpxp']))
		{
			echo "<td>"($conn->query("SELECT (ItemPrice*Item1Amount+ ItemPrice*Item2Amount+ -ItemPrice*Product1)/methods.xp AS 'GPXP' FROM Methods AND GE
WHERE methods.item1 = ge.item AND methods.item2 = ge.item AND methods.product1 = ge.item AND methods.product2 = ge.item"
))->fetch_assoc()['gpxp']."</td>";

		}
		if (!empty($_POST['gpaction']))
		{
			echo "<td>"($conn->query("SELECT (ItemPrice*Item1Amount+ ItemPrice*Item2Amount-ItemPrice*Product1) AS ‘GPAction’ FROM Methods AND GE
WHERE methods.item1 = ge.item AND methods.item2 = ge.item AND methods.product1 = ge.item 
"

		}
		if (!empty($_POST['gpspent']))
		{
			echo "<td>"($conn->query("SELECT (ItemPrice*Item1Amount+ ItemPrice*Item2Amount -ItemPrice*Product1)*$actionsforgoal AS ‘GPSpent’ FROM Methods AND GE
WHERE methods.item1 = ge.item AND methods.item2 = ge.item AND methods.product1 = ge.item 
"
))->fetch_assoc()['gpspent']."</td>";

		}
		if (!empty($_POST['efficiency']))
		{
			echo "<td>"($conn->query("SELECT ($gphr-(XP/HR*( ItemPrice*Item1Amount+ ItemPrice*Item2Amount-ItemPrice*Product1)/methods.xp))*XP/HR) AS ‘Efficiency’ FROM Methods AND GE
WHERE methods.item1 = ge.item AND methods.item2 = ge.item AND methods.product1 = ge.item
"
))->fetch_assoc()['efficiency'])"</td>";

		}
		if (!empty($_POST['timetaken']))
		{
			//if the XP/HR on the table is greater than 0, continue
			if($row["XPHR"] > 0)
			{
				echo "<td>".($_SESSION['goalxp']-$_SESSION['currentxp'])/$row["XPHR"]."</td>";
			}
		}
		
		echo "</tr>";
    }
    echo "</table>";
} 
//if the query gave no results, continue
else {
    echo "0 results";
}
//close the connection
$conn->close();
?> 
</div>
</div>
<p>&nbsp;</p>
//creates a table using class calcbuttons
<table width="200" height="278" cellpadding="4" class="calcbuttons11">
  <tr>
    <td colspan="5"><input class="inputform" id="calculator" type="text"/></td>
  </tr>
  <tr>
    //creates buttons to be placed on the calculator, calling function calcbutton with the button value upon clicking
    <td><input class="calcbuttons" type="button" value=1 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value=2 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value=3 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value='/' onclick="calcbutton(this.value);"/></td>
  </tr>
  <tr>
    <td><input class="calcbuttons" type="button" value=4 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value=5 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value=6 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value='*' onclick="calcbutton(this.value);"/></td>
  </tr>
  <tr>
    <td><input class="calcbuttons" type="button" value=7 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value=8 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value=9 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value='-' onclick="calcbutton(this.value);"/></td>
  </tr>
  <tr>
    <td><input class="calcbuttons" type="button" value=0 onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value='.' onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value='C' onclick="calcbutton(this.value);"/></td>
    <td><input class="calcbuttons" type="button" value='+' onclick="calcbutton(this.value);"/></td>
  </tr>
  <tr>
    <td colspan="5"><div style="text-align:center;">
      //Creates an = button that calls the function calculate with the contents of the calculator upon clicking
      <input class="inputform" type="button" value=' = ' onclick="calculate(document.getElementById('calculator').value);"/>
    </div></td>
  </tr>
</table>
</body>
</html>
