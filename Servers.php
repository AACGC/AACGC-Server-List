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

//----------------------------------------------------------------------------------------------------

       
$sql->db_Select("aacgc_serverlist_cat", "*", "WHERE server_cat_id = $sub_action","");
$catname = $sql->db_Fetch();


//--------------# Multipage Script #---------------------------
$catid = $catname['server_cat_id'];

$previcon = "<img src='".e_PLUGIN."aacgc_serverlist/images/prevpage.png'></img>";
$pageonicon = "<img src='".e_PLUGIN."aacgc_serverlist/images/pageon.png'></img>";
$pageofficon = "<img src='".e_PLUGIN."aacgc_serverlist/images/pageoff.png'></img>";
$nexticon = "<img src='".e_PLUGIN."aacgc_serverlist/images/nextpage.png'></img>";

if ($pref['servlist_bannersperpage'] != '') 
{$rowsPerPage = $pref['servlist_bannersperpage'];} 
else 
{$rowsPerPage = "";}

if(isset($_GET['rowspp']))
{$rowsPerPage = intval($_GET['rowspp']);}

$pageNum = 1;
if(isset($_GET['page']))
{$pageNum = intval($_GET['page']);}

$offset = ($pageNum - 1) * $rowsPerPage;

$query = @mysql_query("SELECT * FROM ".MPREFIX."aacgc_serverlist WHERE server_cat=$sub_action");
$numrows = mysql_num_rows($query);

if(isset($_POST['page'])) 
{$rowsPerPage = intval($_POST['page']);}

$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " $pageonicon ";} 
else 
{$nav .= "<a href=\"$self?page=".$page."&rowspp=".$rowsPerPage."&det.".$catid."\">$pageofficon</a>";}}

if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  .= "<a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">".$previcon."</a>";} 
else 
{$prev  .= "";}

if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next .= "<a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">".$nexticon."</a>";} 
else 
{$next .= "";}

//---------------------------------------------------------------

if ($pref['servlist_bannersperpage'] == "") 
{$limit = "";} 
else 
{$limit = "LIMIT ".$offset.", ".$rowsPerPage."";}



$text .= "<table style='width:100%'><tr>
          <td style='width:50%'><center><a href='Server_Categories.php'><center><img src='".e_PLUGIN."aacgc_serverlist/images/goback.png'></img></center></td>";


if (USER){
if ($pref['servlist_enable_submit'] == "1"){
$text .= "<td style='width:50%'><center><a href='".e_PLUGIN."aacgc_serverlist/Server_Submit_Form.php'><img src='".e_PLUGIN."aacgc_serverlist/images/submitbutton.png'></img></a></center></td>";}}

$text .= "</tr></table><br><br>
        <table style='width:95%'>
        <tr>
        <td colspan=3 class='".$themeb."'><center><font size='".$pref['servlist_catpfsize']."' color='".$pref['servlist_catpfcolor']."'>".$catname['server_cat_name']." Servers</font></center></td>
        </tr><tr>";
    

$sql2 = new db;
$sql2->db_Select("aacgc_serverlist", "*", "WHERE server_cat=".$catname['server_cat_id']." $limit","");
$rows = $sql2->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql2->db_Fetch();

if ($pref['servlist_servpbsize'] == "560X95"){
$server = "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row['server_id']."'><img src='http://cache.www.gametracker.com/server_info/".$row['server_ip']."/b_560x95.png' border='0' width='560' height='95' /></a>";}

if ($pref['servlist_servpbsize'] == "350X20"){
$server = "<a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row['server_id']."'><img src='http://cache.www.gametracker.com/server_info/".$row['server_ip']."/b_350_20_323957_202743_F19A15_111111.png' border='0' width='350' height='20' /></a>";}

$text .= "
<td style='width:100%' class='".$themea."'><center>
".$server."
</center></td>
<td class='".$themeb."'><center><a href='".e_PLUGIN."aacgc_serverlist/Server_Details.php?det.".$row['server_id']."'><img src='".e_PLUGIN."aacgc_serverlist/images/detbutton.png'></img></a></td>";



if ($pcol == 1) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}



$text .= "
</tr></table>
";


$title = "".$catname['server_cat_name']." Servers";


//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_serverlist/plugin.php');
$copyright .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


$ns -> tablerender($title, $text."<br><br><div style='width:' class='".$themeb."'><center><u>Page Selection</u><br><br>".$prev."".$nav."".$next."</center></div>".$copyright."");





require_once(FOOTERF);



?>






