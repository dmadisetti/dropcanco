 <?php
$access = $_GET['access'];
$authority = $_POST['authority'];
?>
<head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45902673-2', 'dropcan.co');
  ga('send', 'pageview');

</script>
<title>Dropcan</title>
<?php
if($access == "view")
{

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
<?php if(1 == 2)
{
?>
<center>
<br><br>
<img src="dropcanlogo.png" height="140">
<br><br>
<font face="Montserrat, Tahoma" size="6" color="#1a1a1a">
The trashcan of the web
<font size="4"> <br>
(for things that really are irksome) 
</font>
<br><font size="2">Updates including favorites list of the past 24 hours coming soon!<br>
  See what is in the trashcan <a href="http://dropcan.co/?access=view">right now.</a>
    </font>
    <br>
<font size="3"><?php if($access == "bad"){echo "<b>Please do not post inflammatory speech. Thank you. </b><br>";}?>
<?php if($access == "copycat"){echo "<b>WOW!  So Original of you ;)</b><br><br>";}?>
<?php if($access == "copycatbig"){echo "<b>That's already in the dropcan!  So original of you!</b><br><br>";}?>
<font face="Tahoma">
Throw something away right now!: &nbsp &nbsp &nbsp &nbsp &nbsp  </font>
&nbsp &nbsp &nbsp &nbsp &nbsp 
&nbsp &nbsp &nbsp &nbsp &nbsp 
&nbsp &nbsp &nbsp &nbsp &nbsp 
&nbsp &nbsp &nbsp &nbsp &nbsp 
&nbsp &nbsp &nbsp &nbsp &nbsp </div>
<br><br>
<form action="postmessage.php" method="post">
	  &nbsp &nbsp <textarea placeholder="Description of something you want to get rid of, a memory you would like forget, a bad idea you know will never work, or just simply any rubbish you encounter in life and are just sick off. Let the web take it. " name="message"></textarea><font color="E4E4E4">

 &nbsp <br><br>
	  <input type="image" src="trash1.png" 
onmouseover="this.src='trash2.png'"
onmouseout="this.src='trash1.png'" name="connect" height="30" style="horizantal-align: right;" >


	   </font>


</font>
</font>


</center>

<script>
$('textarea').keypress(function(e) {
    var tval = $('textarea').val(),
        tlength = tval.length,
        set = 999,
        remain = parseInt(set - tlength);
    $('p').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('textarea').val((tval).substring(0, tlength - 1))
    }
})
</script>
<?php 
}
else
{
?>
<center>
<br><br>
<a href="index.php"><img src="dropcanlogo.png" height="140"></a>
<br><br>
<font face="Montserrat, Tahoma" size="6" color="#1a1a1a">
The trashcan of the web
<font size="4"> <br>
(for things that really are irksome) 
</font>
<br></center>
<?php

function put_url_in_a($arr)
    {
    if(strpos($arr[0], 'http://') !== 0)
        {
            $arr[0] = 'http://' . $arr[0];
        }
        $url = parse_url($arr[0]);

        //links
        return sprintf('<a href="%1$s">%1$s</a>', $arr[0]);
    }

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
		if($row['settings'] == "memo" and $counter < 1000 and strtolower($row['memo']) != "d" and $row['memo'] != "" and $row['memo'] != " "
		
		)
		
		{
		
		$counter = $counter + 1;
		$s = $row['memo'];
	$string = htmlentities($s);

		$s = preg_replace_callback('#(?:https?://\S+)|(?:www.\S+)|(?:\S+\.\S+)#', 'put_url_in_a', $string);
		if(substr($s,0,5) == "*gold")
        {
           $feature = "gold";
        }
        else
        {
         $feature = false;  
        }
		?>
		<div style="border-top-style:solid;border-top-width:2px;
                <?php if($feature == "gold"){?>    
                    border-color:orange;
                    
                    <?php } else {?>
                    border-color:black;
                <?php    } ?>
                    
width:550px;font-align:left;margin:auto;margin-top:15px;word-wrap: break-word;"><font face="Tahoma" size="2">
		<b>
		<?php
		if($feature == "gold")
		{ ?><font color="grey"><?php
		echo htmlentities(date("F j, Y, g:i a",$row['time'])) . "</font></b>: " . substr($s,5);
		} else
		{
		echo htmlentities(date("F j, Y, g:i a",$row['time'])) . "</b>: " . $s;
		}
		?>
		</font></div>
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
 </div>
<?


}

?>
</font>
</body>
