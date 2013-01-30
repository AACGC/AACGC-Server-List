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


if ($pref['servlist_enable_catmcount'] == "1"){
$gservercats = $sql -> db_Count("aacgc_serverlist_cat");
$gamemenu_text .= "<center>Total Games Supported: ".$gservercats."";}

if ($pref['servlist_enable_servercount'] == "1"){
$servers = $sql -> db_Count("aacgc_serverlist");
$gamemenu_text .= "<center>Total Servers Listed: ".$servers."<br><br>";}


$gamemenu_text .= "<div style='width:100%; height:".$pref['servlist_catmheight']."px; overflow:auto'><table style='width:100%' class=''><tr>";


if ($pref['servlist_catmcatpr'] == "1")
{$width = "100%";}
if ($pref['servlist_catmcatpr'] == "2")
{$width = "50%";}
if ($pref['servlist_catmcatpr'] == "3")
{$width = "33%";}
if ($pref['servlist_catmcatpr'] == "4")
{$width = "25%";}


$sql = new db;
$sql ->db_Select("aacgc_serverlist_cat", "*", "ORDER BY server_cat_name ASC","");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
while($row = $sql ->db_Fetch()){

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select *, count(server_id) as catserver from ".MPREFIX."aacgc_serverlist where server_cat=".$row['server_cat_id'].";");
$catservers = $sql3->db_fetch();

$gamemenu_text .= "<td class='".$themeb."'><center>
<a href='".e_PLUGIN."aacgc_serverlist/Servers.php?det.".$row['server_cat_id']."'>
<font size='".$pref['servlist_catmfsize']."' color='".$pref['servlist_catmfcolor']."'>".$row['server_cat_name']."</font> (".$catservers['catserver'].")</a>";


if ($pref['servlist_enable_catmminib'] == "1"){
$gamemenu_text .= "<br><div style='width:95%; height:".$pref['servlist_catmminisheight']."px; overflow:auto' class='".$themea."'><center>";

if ($pref['servlist_catmminicount'] == "0")
{$limit = "";}
else
{$limit = "ORDER BY rand() LIMIT 0,".$pref['servlist_catmminicount']."";}

$sql2 = new db;
$sql2 -> db_Select("aacgc_serverlist", "*", "WHERE server_cat=".$row['server_cat_id']." ".$limit."", "");
while($row2 = $sql2->db_fetch()){
$gamemenu_text .= "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row2['server_id']."'>
<img src='http://cache.www.gametracker.com/server_info/".$row2['server_ip']."/b_350_20_323957_202743_F19A15_111111.png' border='0' width='350' height='20'></img></a><br>";}
$gamemenu_text .= "</center></div>";}

$gamemenu_text .= "</center></td>";

$catsperrowm = "".$pref['servlist_catmcatpr']."";

if ($pcol == $catsperrowm) 
{$gamemenu_text .= "</tr><tr valign=top>";
$pcol = 1;}
else
{$pcol++;}}}

$gamemenu_text .= "</table></div>";

if (USER){
if ($pref['servlist_enable_submit'] == "1"){
$gamemenu_text .= "<br><center>
<a href='".e_PLUGIN."aacgc_serverlist/Server_Submit_Form.php'><img src='".e_PLUGIN."aacgc_serverlist/images/submitbutton.png'></img></a>
</center>";}}





$gamemenu_title .= "".$pref['servlist_catmtitle']."";


$ns -> tablerender($gamemenu_title, $gamemenu_text);



?>

