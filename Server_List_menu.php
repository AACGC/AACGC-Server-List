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

$servers = $sql -> db_Count("aacgc_serverlist");

$gamemenu_text .= "<center>Total Game Servers: ".$servers."<br><br>";


$gamemenu_text .= "<div style='width:100%; height:".$pref['servlist_servmheight']."px; overflow:auto'><table style='width:100%' class=''>";

$sql = new db;
$sql ->db_Select("aacgc_serverlist", "*", "ORDER BY server_cat ASC","");
while($row = $sql ->db_Fetch()){


if ($pref['servlist_servmbsize'] == "560X95"){
$server = "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row['server_id']."'><img src='http://cache.www.gametracker.com/server_info/".$row['server_ip']."/b_560x95.png' border='0' width='560' height='95' /></a>";}

if ($pref['servlist_servmbsize'] == "350X20"){
$server = "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row['server_id']."'><img src='http://cache.www.gametracker.com/server_info/".$row['server_ip']."/b_350_20_323957_202743_F19A15_111111.png' border='0' width='350' height='20' /></a>";}

$gamemenu_text .= "<tr><td class='".$themea."'>".$server."</td></tr>";}


$gamemenu_text .= "</table></div>";


if ($pref['servlist_enable_submit'] == "1"){
$gamemenu_text .= "<br><center>
<a href='".e_PLUGIN."aacgc_serverlist/Server_Submit_Form.php'><img src='".e_PLUGIN."aacgc_serverlist/images/submitbutton.png'></img></a>
</center>";}

$gamemenu_title .= "".$pref['servlist_servmtitle']."";

$ns -> tablerender($gamemenu_title, $gamemenu_text);

?>

