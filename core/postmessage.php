<?php 

# Env settings
if (getenv("ENV") == "DEV") {
  ini_set("display_startup_errors",1);
  error_reporting(E_ALL);
  set_error_handler( function($errno,$errstr,$errfile,$errline,$errcontext){
    echo sprintf("<p style='list-style:disc outside none; display:list-item;margin-left: 20px;'><strong>Error:</strong> %s in %s on %d</p>\n",$errstr,$errfile,$errline);
  } , E_ALL);
}


$db_hostname=getenv("MYSQL_PORT_3306_TCP_ADDR");
$db_username=getenv("USER"); 
$db_password=getenv("PASSWORD");
$db_database=getenv("DATABASE");

var_dump([$db_hostname, $db_username, $db_password]);

$db_server = mysqli_connect($db_hostname, $db_username, $db_password);

if (!$db_server) die("location:cannotlogin.php");
$db_server->select_db($db_database) or die ("location:cannotlogin.php");
//CONNECTION

$message = $_POST['message'];

$message = $db_server->real_escape_string($message);

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


# This is a major bottleneck
# I know you don't want dupe results, but there are better ways
# $result1 = $db_server->query("SELECT * FROM dropcan ORDER BY time DESC");
# while($row = $db_server->fetch_assoc($result1)){
# 	if($row["memo"] == $message){
# 		$copierbig = "on";
# 	}
# }

if($message != "" and $censor === FALSE and $alarm != "on" and $copier != "on" and $copierbig != "on" and 2001 > strlen($message))
{
$db_server->query("INSERT INTO dropcan (memo, time, settings) VALUES('$message', '$time', '$random')") or die(mysql_error()); 
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