<?php
$access = $_GET['access'];
$authority = $_POST['authority'];
?>
<head>
<title>Dropcan</title>
<?php
if($access == "view")
{
echo "<meta http-equiv=\"refresh\" content=\"20;url='index.php?access=view'\">";
}
else
{
}
?>
       <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<style>
textarea {
background: #FCFCFC;
border: 1px solid #D1D1D1;
font: 16px Open Sans,Ebrima,Helvetica,Sans-serif;
color: #000;
width: 800px;
padding: 2px 15px 2px 10px;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
text-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15) inset;
-webkit-transition: all 0.7s ease 0s;
-moz-transition: all 0.7s ease 0s;
-o-transition: all 0.7s ease 0s;
transition: all 0.7s ease 0s;
height: 225px;
padding-top: 5px;
}
</style>
</head>
<body>

<center>
<br><br>
<a href="index.php"><img src="dropcanlogo.png" height="140"></a>
<br><br>
<font face="Montserrat, Tahoma" size="6" color="#1a1a1a">
The trashcan of the web for bad ideas
<font size="4"> <br>
(and things that really need to go) 
</font>
<br></center>
<?php
$db_hostname="db497389632.db.1and1.com"; 
$db_username="dbo497389632"; 
$db_password="LD2apriori450";
$db_database="db497389632"; 					
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("location:cannotlogin.php");
mysql_select_db($db_database) or die ("location:cannotlogin.php");

  $result1 = mysql_query("SELECT * FROM dropcan ORDER BY time DESC");
  $counter = 0;
	   	while($row = mysql_fetch_assoc($result1)) //LOGGED IN USER DATA
		{
		if($row['settings'] == "memo" )
		{		
		$counter = $counter + 1;
		?>
		

		<?php
		}	
		}
?>
<div style="border-top-style:solid;border-top-width:2px;
 min-height:10px;width:550px;font-align:left;margin-left:400px;margin-top:20px;"><br>
 <a href="index.php">
 	  <img src="dump1.png" 
onmouseover="this.src='dump2.png'"
onmouseout="this.src='dump1.png'" name="connect" height="30" style="horizantal-align: right;" ></a>
 </div><br>
<?


echo $counter;

?>

</font>
</body>
