<?php 
$db_hostname="db497389632.db.1and1.com"; 
$db_username="dbo497389632"; 
$db_password="LD2apriori450";
$db_database="db497389632"; 					
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("location:cannotlogin.php");
mysql_select_db($db_database) or die ("location:cannotlogin.php");
//CONNECTION

$message = $_POST['message'];


$message = mysql_real_escape_string($message);

$time = time();
$rand = mt_rand();
$id = $time . $rand; //ID of the post
$random = "memo";
$message1 = strtolower($message);
$message1 = " " . $message1;


$censor = strpos($message1,"barack",0);
if($censor !== false)
{
$alarm = "on";
}
$censor = strpos($message1,"obama",0);
if($censor !== false)
{
$alarm = "on";
}


$copycat = strpos($message1,"droopcan",0);
if($copycat !== false)
{
$copier = "on";
}

if($message1 == " d")
{
$copier = "on";
}
if($message1 == " mathew")
{
$copier = "on";
}
if($message1 == " matthew")
{
$copier = "on";
}


if(ctype_space($message1))
{
$copier = "on";
}



$result1 = mysql_query("SELECT * FROM dropcan ORDER BY time DESC");
	   	while($row = mysql_fetch_assoc($result1)) //LOGGED IN USER DATA
		{
		if($row["memo"] == $message)
		{
		$copierbig = "on";
		}
		}

if($message != "" and $censor === FALSE and $alarm != "on" and $copier != "on" and $copierbig != "on" and 2001 > strlen($message))
{
mysql_query("INSERT INTO dropcan (memo, time, settings) VALUES('$message', '$time', '$random')") or die(mysql_error()); 
echo "<meta http-equiv=\"refresh\" content=\"0;url='index.php?access=view'\">";
}
elseif($copier == "on")
{
echo "<meta http-equiv=\"refresh\" content=\"0;url='index.php?access=copycat'\">";
}
elseif($copierbig == "on")
{
echo "<meta http-equiv=\"refresh\" content=\"0;url='index.php?access=copycatbig'\">";
}
elseif($alarm == "on")
{
echo "<meta http-equiv=\"refresh\" content=\"0;url='index.php?access=bad'\">";
}
else
{
echo "<meta http-equiv=\"refresh\" content=\"0;url='index.php'\">";
}

?>