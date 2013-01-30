<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Server List               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


if ($pref['servlist_enable_theme'])
{$themea = "indent";
$themeb = "forumheader3";}
else
{$themea = "";
$themeb = "";}

//-----------------------------------------------------------------+

if ($pref['servlist_enable_serverlmcount'] == "1"){
$servers = $sql -> db_Count("aacgc_serverlist");
$gamemenu_text .= "<center>Total Game Servers: ".$servers."<br><br>";}

//-----------------------------------------------------------------+

$height = "211";

if ($pref['servlist_enable_servmgraph'] == "1"){
$height = $height + 64;
$optionb = $pref['servlist_enable_servmgraph'];}

if ($pref['servlist_enable_servmplayers'] == "1"){
$height = $height + 77;
$optionc = $pref['servlist_enable_servmplayers'];}

if ($pref['servlist_enable_servmscreens'] == "1"){
$height = $height + 89;
$optiona = $pref['servlist_enable_servmscreens'];}

//-----------------------------------------------------------------+

$fast = $pref['servlist_servmfastspeed'];
$norm = $pref['servlist_servmnormspeed'];
$slow = $pref['servlist_servmslowspeed'];

$gamemenu_text .= "
<script type=\"text/javascript\">
function serversleft(){servers.direction = \"left\";}
function serversright(){servers.direction = \"right\";}
function serversspeedup(){servers.scrollAmount = \"$fast\";}
function serversspeed(){servers.scrollAmount = \"$norm\";}
function serversslowdown(){servers.scrollAmount = \"$slow\";}
</script>";

$gamemenu_text .= "<div style='width:100%; height:auto; overflow:auto'>
		   <marquee id='servers' scrollamount='{$norm}' direction='left' loop='true'>
		   <table style='width:100%' class=''>";

//-----------------------------------------------------------------+

$sql ->db_Select("aacgc_serverlist", "*", "ORDER BY server_cat ASC","");
while($row = $sql ->db_Fetch()){


$server = "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row['server_id']."'><img src='http://cache.www.gametracker.com/server_info/".$row['server_ip']."/b_160_400_0_FFFFFF_C5C5C5_FFFFFF_000000_".$optiona."_".$optionb."_".$optionc.".png' border='0' width='160' height='".$height."'  alt='' /></a>";



$gamemenu_text .= "<td class='".$themea."'>".$server."</td>";}

//-----------------------------------------------------------------+


$gamemenu_text .= "</table></marquee></div>";

$gamemenu_text .= "<center>
<input onClick=\"serversleft();\" type=\"image\" src=\"".e_PLUGIN."aacgc_serverlist/images/prevpage.png\">
<input onClick=\"serversright();\" type=\"image\" src=\"".e_PLUGIN."aacgc_serverlist/images/nextpage.png\"> 
<br>
<input onClick=\"serversspeedup();\" type=\"button\" value=\"Fast\"> 
<input onClick=\"serversspeed();\" type=\"button\" value=\"Normal\">
<input onClick=\"serversslowdown();\" type=\"button\" value=\"Slow\"> 
</center>";

//-----------------------------------------------------------------+


if ($pref['servlist_enable_submit'] == "1"){
$gamemenu_text .= "<br><center>
<a href='".e_PLUGIN."aacgc_serverlist/Server_Submit_Form.php'><img src='".e_PLUGIN."aacgc_serverlist/images/submitbutton.png'></img></a>
</center>";}

//-----------------------------------------------------------------+

$gamemenu_title .= "".$pref['servlist_servmtitle']."";

//-----------------------------------------------------------------+

$ns -> tablerender($gamemenu_title, $gamemenu_text);



?>

