<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Server List               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}


if ($pref['servlist_enable_theme'])
{$themea = "indent";
$themeb = "forumheader3";}
else
{$themea = "";
$themeb = "";}

//----------------------------------------------------------------+

$title = "".$pref['servlist_catptitle']."";

//----------------------------------------------------------------+

$text .= "<table style='width:100%' class=''>";

if ($pref['servlist_enable_headintro'] == "1"){
$text .= "<tr><td class=''><center><font size='".$pref['servlist_catphfsize']."'><u>".$pref['servlist_catpheader']."</u></font></td></tr>";}

if ($pref['servlist_enable_catcount'] == "1"){
$gservercats = $sql -> db_Count("aacgc_serverlist_cat");
$text .= "<tr><td class=''><center>Total Games Supported: ".$gservercats."</td></tr>";}

if ($pref['servlist_enable_servercount'] == "1"){
$gservers = $sql -> db_Count("aacgc_serverlist");
$text .= "<tr><td class=''><center>Total Servers Listed: ".$gservers."</td></tr>";}

if ($pref['servlist_enable_intro'] == "1"){
$text .= "<tr><td class=''><center><br><font size='".$pref['servlist_catpifsize']."'>".$pref['servlist_catpintro']."</font></center></td></tr>";}

$text .= "</table>";

//----------------------------------------------------------------+

$text .= "<table style='width:100%' class=''><tr valign=top>";

if ($pref['servlist_catpcatpr'] == "1")
{$width = "100%";}
if ($pref['servlist_catpcatpr'] == "2")
{$width = "50%";}
if ($pref['servlist_catpcatpr'] == "3")
{$width = "33%";}
if ($pref['servlist_catpcatpr'] == "4")
{$width = "25%";}

$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."aacgc_serverlist_cat ORDER BY server_cat_name ASC");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
while($row = $sql->db_Fetch()){

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select server_cat, count(server_id) as catserver from ".MPREFIX."aacgc_serverlist where server_cat=".$row['server_cat_id'].";");
$catservers = $sql3->db_fetch();

$text .= "<td class='".$themeb."' style='width:".$width."'><center>
<a href='Servers.php?det.".$row['server_cat_id']."'><font size='".$pref['servlist_catpfsize']."' color='".$pref['servlist_catpfcolor']."'>".$row['server_cat_name']."</font></a> (".$catservers['catserver'].")";


if ($pref['servlist_enable_catpminib'] == "1"){
$text .= "<br><div style='width:95%; height:".$pref['servlist_catpminisheight']."px; overflow:auto' class='".$themea."'><center>";

if ($pref['servlist_catpminicount'] == "0")
{$limit = "";}
else
{$limit = "ORDER BY rand() LIMIT 0,".$pref['servlist_catpminicount']."";}

$sql2 = new db;
$sql2 -> db_Select("aacgc_serverlist", "*", "WHERE server_cat=".$row['server_cat_id']." ".$limit."", "");
while($row2 = $sql2->db_fetch()){
$text .= "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row2['server_id']."'>
<img src='http://cache.www.gametracker.com/server_info/".$row2['server_ip']."/b_350_20_323957_202743_F19A15_111111.png' border='0' width='350' height='20'></img></a><br>";}
$text .= "</center></div>";}


$text .= "</center></td>";

$catsperrow = "".$pref['servlist_catpcatpr']."";

if ($pcol == $catsperrow) 
{$text .= "</tr><tr valign=top>";
$pcol = 1;}
else
{$pcol++;}}}


$text .= "</table>";


//----------------------------------------------------------------+


if (USER){
if ($pref['servlist_enable_submit'] == "1"){
$text .= "<center>
<br><br>
<a href='".e_PLUGIN."aacgc_serverlist/Server_Submit_Form.php'><img src='".e_PLUGIN."aacgc_serverlist/images/submitbutton.png'></img></a>
</center>";}}


//----------------------------------------------------------------+

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_serverlist/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);
require_once(FOOTERF);

?>
