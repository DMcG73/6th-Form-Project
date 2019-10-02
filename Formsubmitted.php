<?php
//starts a session so that global variables can be called
session_start();
session_regenerate_id();
?>
<?php
//if the user is signed in, a cookie is saved to hold the username
if(isset($_COOKIE['cookiename']))
{
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
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
<title>Skilling Calculator</title>
</head>

<body background="background.png">
<?php
//if form from index.php has been submitted, continue
if (isset($_POST['skillform'], $_POST['goalxp'], $_POST['bonusxp'], $_POST['gphr'], $_POST['currentxp'])) {
    
	//if the value for the skill is 0 (default), continue
	if($_POST['skillform'] == "0")
	{
		//alert the user that they didn't select a skill, redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'You must select a skill.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//if the goal xp was not filled out, is less than 1 or is greater than 200,000,000, continue
	if($_POST['goalxp'] == "" or $_POST['goalxp'] <=0 or $_POST['goalxp'] > 200000000)
	{
		//alert the user that the goal xp must be between 1 and 200,000,000 and redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Goal XP must be between 1 and 200,000,000.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//if the bonus xp is less than 0 or is greater than 100,000,000, continue
	if($_POST['bonusxp'] <0 or $_POST['goalxp'] > 100000000)
	{
		//alert the user that the bonus xp must be between 0 and 100,000,000 and redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Bonus XP must be between 0 and 100,000,000.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//if the gp/hr is less than 0 or is greater than 2,147,483,647, continue
	if($_POST['gphr'] <0 or $_POST['gphr'] > 2147483647)
	{
		//alert the user that the gp/hr must be between 0 and 2,147,483,647 and redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Prospective GP per Hour must be between 0 and 2,147,483,647.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//if the current xp is less than 0 or is greater than 200,000,000, continue
	if($_POST['currentxp'] <0 or $_POST['currentxp'] > 200000000)
	{
		//alert the user that the current xp must be between 0 and 200,000,000 and redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Current XP must be between 0 and 200,000,000.';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//if the current xp is greater than the goal xp, continue
	if($_POST['currentxp'] >= $_POST['goalxp'])
	{
		//alert the user that the goal xp must be higher than the current xp, redirects them to index.php
		echo "<script type=\"text/javascript\">
		var JavaScriptAlert = 'Goal XP should be higher than current XP';
		alert(JavaScriptAlert);
		window.location = 'index.php';
		</script>";
	}
	//sets the form values as session values so they can be accessed later
	$_SESSION['skillform'] = $_POST['skillform'];
	$_SESSION['goalxp'] = $_POST['goalxp'];
	$_SESSION['bonusxp'] = $_POST['bonusxp'];
	$_SESSION['gphr'] = $_POST['gphr'];
	$_SESSION['currentxp'] = $_POST['currentxp'];
	
}
//if the form from index.php hasn't been submitted (page entered manuall via URL), continue
else
{
	//redirects the user to index.php
	header('Location: index.php');
}
?>
//creates a form that posts all values to Maincalculator.php
<form method = "post" action="Maincalculator.php">
<div align="center">
//creates a logo that upon clicking redirects you to index.php
<a href="index.php">
	<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
</a>
<div style="form">
//creates radio buttons to select boosts relevant for all skills
<br /><b>Select all boosts:</b> <br /><br />
   <input type="radio" name="template1" value="avanear">Avatar (Nearby)</option><br />
    <input type="radio" name="template1" value="avafar">Avatar (Same world)</option><br />
    <input type="radio" name="template2" value="wisdomall">Wisdom Aura (All the Time)</option><br />
    <input type="radio" name="template2" value="wisdom">Wisdom Aura (When Possible)</option><br />
    <input type="radio" name="template3" value="raf">Refer a Friend</option><br />
    <input type="radio" name="template4" value="festive">Festive Aura</option><br />
    <input type="radio" name="template4" value="enlightenment">Enlightenment Aura</option><br />
	<?php
//creates radiobuttons to select boosts for the skill Construction
    if($_POST['skillform'] == "2")
    { ?>
    	<input type="radio" name="template5" value="gloves">Constructor's Gloves</option><br />
        <input type="radio" name="template6" value="boots">Constructor's Boots</option><br />
        <input type="radio" name="template7" value="hat">Constructor's Hat</option><br />
        <input type="radio" name="template8" value="trousers">Constructor's Trousers</option><br />
        <input type="radio" name="template9" value="top">Constructor's Garb</option><br />
        <input type="radio" name="template10" value="full">Constructor's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Cooking
    <?php
    if($_POST['skillform'] == "3")
    { ?>
        <input type="radio" name="template5" value="gloves">Sous Chef's Mitts</option><br />
        <input type="radio" name="template6" value="boots">Sous Chef's Shoes</option><br />
        <input type="radio" name="template7" value="hat">Sous Chef's Toque</option><br />
        <input type="radio" name="template8" value="trousers">Sous Chef's Trousers</option><br />
        <input type="radio" name="template9" value="top">Sous Chef's Jacket</option><br />
        <input type="radio" name="template10" value="full">Sous Chef's Outfit (Full)</option><br />
        <input type="radio" name="template11" value="armyaxe">Dwarven Army Axe</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Crafting
    <?php
    if($_POST['skillform'] == "4")
    { ?>
    	<input type="radio" name="template5" value="craftgloves">Artisan's Gloves</option><br />
        <input type="radio" name="template6" value="craftboots">Artisan's Boots</option><br />
        <input type="radio" name="template7" value="crafthat">Artisan's Bandana</option><br />
        <input type="radio" name="template8" value="crafttrousers">Artisan's Legs</option><br />
        <input type="radio" name="template9" value="crafttop">Artisan's Top</option><br />
        <input type="radio" name="template10" value="craftfull">Artisan's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Divination
    <?php
    if($_POST['skillform'] == "5")
    { ?>
        <input type="radio" name="template5" value="divgloves">Diviner's Handwear</option><br />
        <input type="radio" name="template6" value="divboots">Diviner's Footwear</option><br />
        <input type="radio" name="template7" value="divhat">Diviner's Headwear</option><br />
        <input type="radio" name="template8" value="divtrousers">Diviner's Legwear</option><br />
        <input type="radio" name="template9" value="divtop">Diviner's Robe</option><br />
        <input type="radio" name="template10" value="divfull">Diviner's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Farming
    <?php
    if($_POST['skillform'] == "6")
    { ?>
    	<input type="radio" name="template5" value="farmgloves">Farmer's Cuffs</option><br />
        <input type="radio" name="template6" value="farmboots">Farmer's Boots</option><br />
        <input type="radio" name="template7" value="farmhat">Farmer's Hat</option><br />
        <input type="radio" name="template8" value="farmtrousers">Farmer's Legwear</option><br />
        <input type="radio" name="template9" value="farmtop">Farmer's Jacket</option><br />
        <input type="radio" name="template10" value="farmfull">Farmer's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Firemaking
    <?php
    if($_POST['skillform'] == "7")
    { ?>
  		<input type="radio" name="template5" value="firering">Ring of Fire</option><br />
 		<input type="radio" name="template6" value="flamegloves">Flame Gloves</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Herblore
    <?php
    if($_POST['skillform'] == "10")
    { ?>
  		<input type="radio" name="template5" value="herbgloves">Botanist's Gloves</option><br />
  		<input type="radio" name="template6" value="herbboots">Botanist's Boots</option><br />
  		<input type="radio" name="template7" value="herbhat">Botanist's Mask</option><br />
  		<input type="radio" name="template8" value="herbtrousers">Botanist's Trousers</option><br />
  		<input type="radio" name="template9" value="herbtop">Botanist's Top</option><br />
  		<input type="radio" name="template10" value="herbfull">Botanist's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Hunter
    <?php
    if($_POST['skillform'] == "11")
    { ?>
  		<input type="radio" name="template5" value="Yaktwee">Yaktwee Stick</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Prayer
    <?php
    if($_POST['skillform'] == "14")
    { ?>
  		<input type="radio" name="template5" value="prayertiara">First Age Tiara</option><br />
  		<input type="radio" name="template6" value="prayeramulet">First Age Amulet</option><br />
  		<input type="radio" name="template7" value="prayercape">First Age Cape</option><br />
  		<input type="radio" name="template8" value="prayerbracelet">First Age bracelet</option><br />
  		<input type="radio" name="template9" value="prayerring">First Age Ring</option><br />
  		<input type="radio" name="template10" value="prayerfull">First Age Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Runecrafting
    <?php
    if($_POST['skillform'] == "15")
    { ?>
    	<input type="radio" name="template5" value="rchat">Master Runecrafter Hat</option><br />
        <input type="radio" name="template6" value="rctop">Master Runecrafer Robe</option><br />
        <input type="radio" name="template7" value="rctrousers">Master Runecrafter Skirt</option><br />
        <input type="radio" name="template8" value="rcboots">Master Runecrafter Boots</option><br />
        <input type="radio" name="template9" value="rcfull">Master Runecrafter Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Smithing
    <?php
    if($_POST['skillform'] == "16")
    { ?>
  		<input type="radio" name="template5" value="smithgloves">Blacksmith's Gloves</option><br />
  		<input type="radio" name="template6" value="smithboots">Blacksmith's Boots</option><br />
  		<input type="radio" name="template7" value="smithhat">Blacksmith's Helmet</option><br />
  		<input type="radio" name="template8" value="smithtrousers">Blacksmith's Apron</option><br />
  		<input type="radio" name="template9" value="smithtop">Blacksmith's Top</option><br />
  		<input type="radio" name="template10" value="smithfull">Blacksmith's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Summoning
    <?php
    if($_POST['skillform'] == "17")
    { ?>
    	<input type="radio" name="template5" value="summgloves">Shaman's Hand Wraps</option><br />
        <input type="radio" name="template6" value="summboots">Shaman's Moccasins</option><br />
        <input type="radio" name="template7" value="summhat">Shaman's Headdress</option><br />
        <input type="radio" name="template8" value="summtrousers">Shaman's Leggings</option><br />
        <input type="radio" name="template9" value="summtop">Shaman's Poncho</option><br />
        <input type="radio" name="template10" value="summfull">Shaman's Outfit (Full)</option><br />
    <?php }; ?>
//creates radiobuttons to select boosts for the skill Woodcutting
    <?php
    if($_POST['skillform'] == "19")
    { ?>
  		<input type="radio" name="template5" value="wchat">Lumberjack Hat</option><br />
  		<input type="radio" name="template6" value="wctop">Lumberjack Top</option><br />
  		<input type="radio" name="template7" value="wctrousers">Lumberjack Legs</option><br />
  		<input type="radio" name="template8" value="wcboots">Lumberjack Boots</option><br />
  		<input type="radio" name="template9" value="wcfull">Lumberjack Outfit (Full)</option><br />
    <?php }; ?>
</select>
<br /> <br />
<b>Features you would like to include:</b><br /><br />
//creates checkboxes for the user to choose what columns they want displayed in the table
<input type="checkbox" name="actionsforgoal" value="1"> - Actions for Goal<br />
<input type="checkbox" name="gpxp" value="1"> - GP/XP<br />
<input type="checkbox" name="gpaction" value="1"> - GP/Action <br />
<input type="checkbox" name="gpspent" value="1"> - GP Spent/Gained<br />
<input type="checkbox" name="efficiency" value="1"> - Efficiency<br />
<input type="checkbox" name="timetaken" value="1"> - Time Taken
//creates a submit button to submit the form
<br /> <br /><input type="submit" value="Submit" />
</div>
</div>
</form>
</body>
</html>
