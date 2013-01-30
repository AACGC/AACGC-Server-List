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

//----------------------------------------------------------------------------------------------------

if ($action == "det"){

if ($pref['servlist_enable_theme'])
{$themea = "indent";
$themeb = "forumheader3";}
else
{$themea = "";
$themeb = "";}

if ($pref['servlist_detailpageheight'] == ""){
$playersection = "450";
$mainsection = "1010";}
if ($pref['servlist_detailpageheight'] == "full"){
$playersection = "450";
$mainsection = "1010";}
if ($pref['servlist_detailpageheight'] == "half"){
$playersection = "190";
$mainsection = "750";}
if ($pref['servlist_detailpageheight'] == "small"){
$playersection = "100";
$mainsection = "660";}
        
$sql->db_Select("aacgc_serverlist", "*", "server_id='".intval($sub_action)."'");
$det = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_serverlist_cat", "*", "server_cat_id='".$det['server_cat']."'");
$cat = $sql2->db_Fetch();

$text .= "<center><br><a href='".e_PLUGIN."aacgc_serverlist/Servers.php?det.".$det['server_cat']."'><img src='".e_PLUGIN."aacgc_serverlist/images/goback.png'></img></a></center><br>";

$text .= "<center><table style='width:600px' class='".$themea."'><tr valign='top'>
<td style='width:0%'><center>
<iframe src='http://cache.www.gametracker.com/components/html0/?host=".$det['server_ip']."&bgColor=333333&fontColor=FFFFFF&titleBgColor=222222&titleColor=FFCC00&borderColor=555555&linkColor=FFCC00&borderLinkColor=FFFFFF&showMap=1&currentPlayersHeight=".$playersection."&showCurrPlayers=1&showTopPlayers=1&showBlogs=1&width=300&height=".$mainsection."' frameborder='0' scrolling='no' width='300' height='".$mainsection."'></iframe>
</center></td>";

if ($det['gsid'] == ""){}
else
{$text .= "<td style='width:100%'><div style='width:300px; height:".$mainsection."px; overflow:auto'><table>";

if ($pref['servlist_graph_playerday']){
$text .= "<tr><td class='".$themeb."'><b>Players Past 24 Hours:</b></td></tr>
	  <tr><td><img src='http://cache.www.gametracker.com/images/graphs/server_players.php?GSID=".$det['gsid']."&start=-1d'></img></td></tr>";}

if ($pref['servlist_graph_playerweek']){
$text .= "<tr><td class='".$themeb."'><b>Players Past Week:</b></td></tr>
	  <tr><td><img src='http://cache.www.gametracker.com/images/graphs/server_players.php?GSID=".$det['gsid']."&start=-1w'></img></td></tr>";}

if ($pref['servlist_graph_playermonth']){
$text .= "<tr><td class='".$themeb."'><b>Players Past Month:</b></td></tr>
	  <tr><td><img src='http://cache.www.gametracker.com/images/graphs/server_players.php?GSID=".$det['gsid']."&start=-1m'></img></td></tr>";}

if ($pref['servlist_graph_rank']){
$text .= "<tr><td class='".$themeb."'><b>Server Rank:</b></td></tr>
	  <tr><td><img src='http://cache.www.gametracker.com/images/graphs/server_rank.php?GSID=".$det['gsid']."'></img></td></tr>";}

if ($pref['servlist_graph_maps']){
$text .= "<tr><td class='".$themeb."'><b>Favorite Maps Past Week:</b></td></tr>
	  <tr><td><img src='http://cache.www.gametracker.com/images/graphs/server_maps.php?GSID=".$det['gsid']."'></img></td></tr>";}


$text .= "</table></div></td>";}


$text .= "</tr></table></center>";

$title = "".$cat['server_cat_name']." Server Details";

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_serverlist/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);}

require_once(FOOTERF);

?>
