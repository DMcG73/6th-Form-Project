<?php
//starts a session so global variables can be used
session_start();
session_regenerate_id();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
//creates a style for the form for aesthetic purposes
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

//creates a style for every even row in a certain table
.row0
	{
  	background-color: white;	
	}

//creates a style for every odd row in a certain table
.row1
	{
  	background-color: #e6e6ff;
	}
</style>
<script type="text/javascript">
//creates a function called logout
function logout()
{
	//if the user selects yes when asked if they want to log out
	if(confirm("Are you sure you would like to log out?"))
	{
		//deletes the cookie for the username, sets a cookie and a session variable for denoting the user having logged out
		<?php
		setcookie('cookiename', '', time() - 3600, '/');
		setcookie('logout', true, time() + 86400, '/');
		$_SESSION['logout'] = true;
		?>
		//reloads the current page
		window.location.reload();
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Skilling Calculator</title>
</head>
//sets the background picture
<body background="background.png">
<p>
<div align=left>
<?php
//if the user is logged in, continue
if(isset($_COOKIE['cookiename']) && !isset($_COOKIE['logout']))
{
	//set the cookie for the user's username
	setcookie('cookiename', $_COOKIE['cookiename'], time() + (86400 * 30), '/');
	//displays button for logging out, clicking runs the function logout
	echo "<button onclick=\"logout();\">Log out</button>";
	//displays button for settings, clicking redirects the user to settings.php
	echo "<button onclick=\"window.location.href = 'settings.php'\">Settings</button>";
}
//if the user has previously chosen to log out, continue
elseif(isset($_COOKIE['logout']))
{
	//displays button for logging in, clicking redirects the user to login.php
	echo "<button onclick=\"window.location.href = 'login.php'\">Log in</button>";
	//displays button for registration, clicking redirects the user to register.php
	echo "<button onclick=\"window.location.href = 'register.php'\">Register</button>";
}
//in any other case, continue
else
{
	//displays button for logging in, clicking redirects the user to login.php
	echo "<button onclick=\"window.location.href = 'login.php'\">Log in</button>";
	//displays button for registration, clicking redirects the user to register.php
	echo "<button onclick=\"window.location.href = 'register.php'\">Register</button>";
}
//displays button for viewing calculations, clicking redirects the user to calculations.php
echo "<button onclick=\"window.location.href = 'calculations.php'\">View saved calculations</button>";

//if the form has already been filled out, continue
if (isset($_POST['skillform'], $_POST['goalxp'], $_POST['bonusxp'], $_POST['gphr'], $_POST['currentxp']))
{
	//display nothing
}
//if the form hasn't been filled out, continue
else
{ 

?>
//creates a form that posts the values to formsubmitted.php
<form method = "post" action="formsubmitted.php">
&emsp; 
<div align="center">
//creates a logo which when clicked, redirects you to index.php (refreshes the page)
<a href="index.php">
  	<img src="logo.png" alt="Runescape Skilling Calculator" style="width:100%;height:100%;" />
</a>
<div style="form">
  <br /><strong>Skill:</strong> 
    //Creates a drop-down menu so the user can select a skill to calculate with
    <select name="skillform">
      <option value="0">Select skill:</option>
      <option value="1">Agility</option>
      <option value="2">Construction</option>
      <option value="3">Cooking</option>
      <option value="4">Crafting</option>
      <option value="5">Divination</option>
      <option value="6">Farming</option>
      <option value="7">Firemaking</option>
      <option value="8">Fishing</option>
      <option value="9">Fletching</option>
      <option value="10">Herblore</option>
      <option value="11">Hunter</option>
      <option value="12">Magic</option>
      <option value="13">Mining</option>
      <option value="14">Prayer</option>
      <option value="15">Runecrafting</option>
      <option value="16">Smithing</option>
      <option value="17">Summoning</option>
      <option value="18">Thieving</option>
      <option value="19">Woodcutting</option>
    </select><br /><br />
    
    //creates an input box for the user to enter their current xp
    <strong>Current XP: </strong>
    <input name="currentxp" type="text" size="9" maxlength="10" /><br /><br />
    
    //creates an input box for the user to enter their bonus xp
    <strong>Bonus XP: </strong>
    <input name="bonusxp" type="text" size="9" maxlength="9" /><br /><br />
    
    //creates an input box for the user to enter their goal xp
    <strong>Goal XP: </strong>
    <input name="goalxp" type="text" size="9" maxlength="9" /><br /><br />
    
    //creates an input box for the user to enter their prospective gp/hr 
    <strong> Max GP/HR:</strong>
    <input name="gphr" type="text" size="9" maxlength="10" /><br /><br /><br />
    
    //creates a submit box that submits values to formsubmitted.php
    <input type="submit" value="Submit" /><br />
    
    </script>
  </div>
</div>
</form>


<?php
}
//creates a counter i
$i = 1;
?>

</p>
//creates a table for levels and equivalent experience
<div style="height: 250px; width: 20%; overflow: auto; margin: auto; background-color: white; border-radius: 12px"> <table width="100%" border="1">
  //creates a table row using the class row0
  <tr class="row<?php echo($i++ & 1 );?>">
    <td><b>Level</b></td>
    <td><b>Experience</b></td>
  </tr>
  //creates a table row using the class row1 (general pattern repeats)
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>1</td>
    <td>0</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>2</td>
    <td>83</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>3</td>
    <td>174</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>4</td>
    <td>276</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>5</td>
    <td>338</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>6</td>
    <td>512</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>7</td>
    <td>650</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>8</td>
    <td>801</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>9</td>
    <td>969</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>10</td>
    <td>1,154</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>11</td>
    <td>1,358</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>12</td>
    <td>1,584</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>13</td>
    <td>1,833</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>14</td>
    <td>2,107</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>15</td>
    <td>2,411</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>16</td>
    <td>2,746</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>17</td>
    <td>3,115</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>18</td>
    <td>3,523</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>19</td>
    <td>3,973</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>20</td>
    <td>4,470</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>21</td>
    <td>5,018</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>22</td>
    <td>5,624</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>23</td>
    <td>6,291</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>24</td>
    <td>7,028</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>25</td>
    <td>7,842</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>26</td>
    <td>8,740</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>27</td>
    <td>9,730</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>28</td>
    <td>10,824</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>29</td>
    <td>12,031</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>30</td>
    <td>13,363</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>31</td>
    <td>14,833</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>32</td>
    <td>16,456</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>33</td>
    <td>18,247</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>34</td>
    <td>20,224</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>35</td>
    <td>22,406</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>36</td>
    <td>24,813</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>37</td>
    <td>27,473</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>38</td>
    <td>30,408</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>39</td>
    <td>33,648</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>40</td>
    <td>37,224</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>41</td>
    <td>41,171</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>42</td>
    <td>45,529</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>43</td>
    <td>50,339</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>44</td>
    <td>55,649</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>45</td>
    <td>61,512</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>46</td>
    <td>67,983</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>47</td>
    <td>75,127</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>48</td>
    <td>83,014</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>49</td>
    <td>91,721</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>50</td>
    <td>101,333</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>51</td>
    <td>111,945</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>52</td>
    <td>123,660</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>53</td>
    <td>136,594</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>54</td>
    <td>150,872</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>55</td>
    <td>166,636</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>56</td>
    <td>184,040</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>57</td>
    <td>203,254</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>58</td>
    <td>224,466</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>59</td>
    <td>247,886</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>60</td>
    <td>273,742</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>61</td>
    <td>302,288</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>62</td>
    <td>333,804</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>63</td>
    <td>368,599</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>64</td>
    <td>407,015</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>65</td>
    <td>449,428</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>66</td>
    <td>496,254</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>67</td>
    <td>547,953</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>68</td>
    <td>605,032</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>69</td>
    <td>668,051</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>70</td>
    <td>737,627</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>71</td>
    <td>814,445</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>72</td>
    <td>899,257</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>73</td>
    <td>992,895</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>74</td>
    <td>1,096,278</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>75</td>
    <td>1,210,421</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>76</td>
    <td>1,336,443</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>77</td>
    <td>1,475,581</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>78</td>
    <td>1,629,200</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>79</td>
    <td>1,798,808</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>80</td>
    <td>1,986,068</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>81</td>
    <td>2,192,818</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>82</td>
    <td>2,421,087</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>83</td>
    <td>2,673,114</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>84</td>
    <td>2,951,373</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>85</td>
    <td>3,258,594</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>86</td>
    <td>3,597,792</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>87</td>
    <td>3,972,294</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>88</td>
    <td>4,385,776</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>89</td>
    <td>4,842,295</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>90</td>
    <td>5,346,332</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>91</td>
    <td>5,902,831</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>92</td>
    <td>6,517,253</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>93</td>
    <td>7,195,629</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>94</td>
    <td>7,944,614</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>95</td>
    <td>8,771,558</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>96</td>
    <td>9,684,577</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>97</td>
    <td>10,692,629</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>98</td>
    <td>11,805,606</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>99</td>
    <td>13,034,431</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>100</td>
    <td>14,391,160</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>101</td>
    <td>15,889,109</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>102</td>
    <td>17,542,976</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>103</td>
    <td>19,358,992</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>104</td>
    <td>21,385,073</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>105</td>
    <td>23,611,006</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>106</td>
    <td>26,068,632</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>107</td>
    <td>28,782,069</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>108</td>
    <td>31,77,943</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>109</td>
    <td>35,085,654</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>110</td>
    <td>38,737,661</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>111</td>
    <td>42,769,801</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>112</td>
    <td>47,221,641</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>113</td>
    <td>52,136,869</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>114</td>
    <td>57,563,718</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>115</td>
    <td>63,555,443</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>116</td>
    <td>70,170,840</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>117</td>
    <td>77,474,828</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>118</td>
    <td>85,539,082</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>119</td>
    <td>94,442,737</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>120</td>
    <td>104,273,167</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>121</td>
    <td>115,126,838</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>122</td>
    <td>127,110,260</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>123</td>
    <td>140,341,028</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>124</td>
    <td>154,948,977</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>125</td>
    <td>171,077,457</td>
  </tr>
  <tr class="row<?php echo($i++ & 1 );?>">
    <td>126</td>
    <td>188,884,740</td>
  </tr>
//ends the table
</table>

</div>
</body>
</html>
