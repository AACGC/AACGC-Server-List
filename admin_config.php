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
if (!defined('e107_INIT'))
{exit;}
if (!getperms("P"))
{header("location:" . e_HTTP . "index.php");
exit;}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, "width:100%;");}

if (e_QUERY == "update")
{
 
    $pref['servlist_catpheader'] = $_POST['servlist_catpheader'];
    $pref['servlist_catphfsize'] = $_POST['servlist_catphfsize'];
    $pref['servlist_catpintro'] = $_POST['servlist_catpintro'];
    $pref['servlist_catpifsize'] = $_POST['servlist_catpifsize'];
    $pref['servlist_catptitle'] = $_POST['servlist_catptitle'];
    $pref['servlist_catpfsize'] = $_POST['servlist_catpfsize'];
    $pref['servlist_catpfcolor'] = $_POST['servlist_catpfcolor'];
    $pref['servlist_catpcatpr'] = $_POST['servlist_catpcatpr'];
    $pref['servlist_catpminisheight'] = $_POST['servlist_catpminisheight'];
    $pref['servlist_catpminicount'] = $_POST['servlist_catpminicount'];

    $pref['servlist_catmtitle'] = $_POST['servlist_catmtitle'];
    $pref['servlist_catmfsize'] = $_POST['servlist_catmfsize'];
    $pref['servlist_catmfcolor'] = $_POST['servlist_catmfcolor'];
    $pref['servlist_catmheight'] = $_POST['servlist_catmheight'];
    $pref['servlist_catmcatpr'] = $_POST['servlist_catmcatpr'];
    $pref['servlist_catmminisheight'] = $_POST['servlist_catmminisheight'];
    $pref['servlist_catmminicount'] = $_POST['servlist_catmminicount'];

    $pref['servlist_servpbsize'] = $_POST['servlist_servpbsize'];
    $pref['servlist_bannersperpage'] = $_POST['servlist_bannersperpage'];
    $pref['servlist_detailpageheight'] = $_POST['servlist_detailpageheight'];

    $pref['servlist_servmtitle'] = $_POST['servlist_servmtitle'];
    $pref['servlist_servmbsize'] = $_POST['servlist_servmbsize'];
    $pref['servlist_servmheight'] = $_POST['servlist_servmheight'];
    $pref['servlist_servmnormspeed'] = $_POST['servlist_servmnormspeed'];
    $pref['servlist_servmfastspeed'] = $_POST['servlist_servmfastspeed'];
    $pref['servlist_servmslowspeed'] = $_POST['servlist_servmslowspeed'];

    $pref['servlist_sendpmto'] = $_POST['servlist_sendpmto'];

if (isset($_POST['servlist_enable_headintro'])) 
{$pref['servlist_enable_headintro'] = 1;}
else
{$pref['servlist_enable_headintro'] = 0;}

if (isset($_POST['servlist_enable_intro'])) 
{$pref['servlist_enable_intro'] = 1;}
else
{$pref['servlist_enable_intro'] = 0;}

if (isset($_POST['servlist_enable_catcount'])) 
{$pref['servlist_enable_catcount'] = 1;}
else
{$pref['servlist_enable_catcount'] = 0;}

if (isset($_POST['servlist_enable_servercount'])) 
{$pref['servlist_enable_servercount'] = 1;}
else
{$pref['servlist_enable_servercount'] = 0;}

if (isset($_POST['servlist_enable_catmcount'])) 
{$pref['servlist_enable_catmcount'] = 1;}
else
{$pref['servlist_enable_catmcount'] = 0;}

if (isset($_POST['servlist_enable_servermcount'])) 
{$pref['servlist_enable_servermcount'] = 1;}
else
{$pref['servlist_enable_servermcount'] = 0;}

if (isset($_POST['servlist_enable_submit'])) 
{$pref['servlist_enable_submit'] = 1;}
else
{$pref['servlist_enable_submit'] = 0;}

if (isset($_POST['servlist_enable_catpminib'])) 
{$pref['servlist_enable_catpminib'] = 1;}
else
{$pref['servlist_enable_catpminib'] = 0;}

if (isset($_POST['servlist_enable_catmminib'])) 
{$pref['servlist_enable_catmminib'] = 1;}
else
{$pref['servlist_enable_catmminib'] = 0;}

if (isset($_POST['servlist_enable_theme'])) 
{$pref['servlist_enable_theme'] = 1;}
else
{$pref['servlist_enable_theme'] = 0;}


if (isset($_POST['servlist_graph_playerday'])) 
{$pref['servlist_graph_playerday'] = 1;}
else
{$pref['servlist_graph_playerday'] = 0;}

if (isset($_POST['servlist_graph_playerweek'])) 
{$pref['servlist_graph_playerweek'] = 1;}
else
{$pref['servlist_graph_playerweek'] = 0;}

if (isset($_POST['servlist_graph_playermonth'])) 
{$pref['servlist_graph_playermonth'] = 1;}
else
{$pref['servlist_graph_playermonth'] = 0;}

if (isset($_POST['servlist_graph_rank'])) 
{$pref['servlist_graph_rank'] = 1;}
else
{$pref['servlist_graph_rank'] = 0;}

if (isset($_POST['servlist_graph_maps'])) 
{$pref['servlist_graph_maps'] = 1;}
else
{$pref['servlist_graph_maps'] = 0;}

if (isset($_POST['servlist_enable_servmgraph'])) 
{$pref['servlist_enable_servmgraph'] = 1;}
else
{$pref['servlist_enable_servmgraph'] = 0;}

if (isset($_POST['servlist_enable_servmplayers'])) 
{$pref['servlist_enable_servmplayers'] = 1;}
else
{$pref['servlist_enable_servmplayers'] = 0;}

if (isset($_POST['servlist_enable_servmscreens'])) 
{$pref['servlist_enable_servmscreens'] = 1;}
else
{$pref['servlist_enable_servmscreens'] = 0;}

    save_prefs();
    $led_msgtext = "Settings Saved";
}

$admin_title = "AACGC Server List (settings)";
//--------------------------------------------------------------------

$sql->db_Select("user", "*", "ORDER BY user_name ASC", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='servlist_sendpmto' value='".$option['user_id']."'>".$option['user_name']."</option>";}

$sql2 = new db;
$sql2->db_Select("user", "*", "WHERE user_id=".$pref['servlist_sendpmto']."", "");
$row2 = $sql2->db_fetch();

$text .= "
<form method='post' action='" . e_SELF . "?update' id='confnwb'>
	


<table style='" . ADMIN_WIDTH . "' class='fborder'>



		<tr>
			<td colspan='3' class='fcaption'><b>Main Settings:</b></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>Enable Indent Layout:<br><i>Adds indent to the table and table data areas to give a more details look. Only works on some themes, disable if table and areas don't appear correctly.</i></td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_theme'] == 1 ? "<input type='checkbox' name='servlist_enable_theme' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_theme' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Allow Server Submissions:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_submit'] == 1 ? "<input type='checkbox' name='servlist_enable_submit' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_submit' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Send PM To:<br><i>If server submissions are allowed.</i></td>
                        <td style='width:' class='forumheader3'>
                        <select name='servlist_sendpmto' size='1' class='tbox' style='width:'>
                        <option name='servlist_sendpmto' value='".$row2['user_id']."'>".$row2['user_name']."</option>
                        ".$options."
                        </td>
		</tr>




</table><br><br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>




		<tr>
			<td colspan='3' class='fcaption'><b>Category Page Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Category Page Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='servlist_catptitle' value='" . $tp->toFORM($pref['servlist_catptitle']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Header:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_headintro'] == 1 ? "<input type='checkbox' name='servlist_enable_headintro' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_headintro' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Header:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='100' name='servlist_catpheader' value='" . $tp->toFORM($pref['servlist_catpheader']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Header Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catphfsize' value='" . $tp->toFORM($pref['servlist_catphfsize']) . "' />px</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Category Count Below Header:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_catcount'] == 1 ? "<input type='checkbox' name='servlist_enable_catcount' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_catcount' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Sevrer Count Below Header:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_servercount'] == 1 ? "<input type='checkbox' name='servlist_enable_servercount' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_servercount' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Enable Intro:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_intro'] == 1 ? "<input type='checkbox' name='servlist_enable_intro' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_intro' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Intro:</td>
			<td colspan='2'  class='forumheader3'>
			<textarea class='tbox' rows='5' cols='100' name='servlist_catpintro'>" . $tp->toFORM($pref['servlist_catpintro']) . "</textarea>
			</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Intro Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catpifsize' value='" . $tp->toFORM($pref['servlist_catpifsize']) . "' />px</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catpfsize' value='" . $tp->toFORM($pref['servlist_catpfsize']) . "' />px</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Category Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catpfcolor' value='" . $tp->toFORM($pref['servlist_catpfcolor']) . "' /></td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Categories Per Row:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='servlist_catpcatpr' size='1' class='tbox' style='width:'>
                        <option name='servlist_catpcatpr' value='".$pref['servlist_catpcatpr']."'>".$pref['servlist_catpcatpr']."</option>
                        <option name='servlist_catpcatpr' value='1'>1</option>
                        <option name='servlist_catpcatpr' value='2'>2</option>
                        <option name='servlist_catpcatpr' value='3'>3</option>
                        <option name='servlist_catpcatpr' value='4'>4</option>
                        </td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Mini Banner Server List below Category Names:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_catpminib'] == 1 ? "<input type='checkbox' name='servlist_enable_catpminib' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_catpminib' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Number of Mini Banners To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catpminicount' value='" . $tp->toFORM($pref['servlist_catpminicount']) . "' />(type 0 for all, if limit set banners will show in random order)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Mini Banner Section Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catpminisheight' value='" . $tp->toFORM($pref['servlist_catpminisheight']) . "' />px (type auto to automatically adjust height with no scroll)</td>
	        </tr>




</table><br><br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>




		<tr>
			<td colspan='3' class='fcaption'><b>Category Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='servlist_catmtitle' value='" . $tp->toFORM($pref['servlist_catmtitle']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Category Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_catmcount'] == 1 ? "<input type='checkbox' name='servlist_enable_catmcount' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_catmcount' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Sevrer Count:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_servermcount'] == 1 ? "<input type='checkbox' name='servlist_enable_servermcount' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_servermcount' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Category Font Size:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catmfsize' value='" . $tp->toFORM($pref['servlist_catmfsize']) . "' />px</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Category Font Color:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catmfcolor' value='" . $tp->toFORM($pref['servlist_catmfcolor']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catmheight' value='" . $tp->toFORM($pref['servlist_catmheight']) . "' />px (type auto for menu to automatically adjust height with no scroll)</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Categories Per Row:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='servlist_catmcatpr' size='1' class='tbox' style='width:'>
                        <option name='servlist_catmcatpr' value='".$pref['servlist_catmcatpr']."'>".$pref['servlist_catmcatpr']."</option>
                        <option name='servlist_catmcatpr' value='1'>1</option>
                        <option name='servlist_catmcatpr' value='2'>2</option>
                        <option name='servlist_catmcatpr' value='3'>3</option>
                        <option name='servlist_catmcatpr' value='4'>4</option>
                        </td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Mini Banner Server List below Category Names:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_catmminib'] == 1 ? "<input type='checkbox' name='servlist_enable_catmminib' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_catmminib' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Number of Mini Banners To Show:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catmminicount' value='" . $tp->toFORM($pref['servlist_catmminicount']) . "' />(type 0 for all, if limit set banners will show in random order)</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Mini Banner Section Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_catmminisheight' value='" . $tp->toFORM($pref['servlist_catmminisheight']) . "' />px (type auto to automatically adjust height with no scroll)</td>
	        </tr>





</table><br><br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>





		<tr>
			<td colspan='3' class='fcaption'><b>Server List Page Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Banners Per Page:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_bannersperpage' value='" . $tp->toFORM($pref['servlist_bannersperpage']) . "' /></td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Banner Size:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='servlist_servpbsize' size='1' class='tbox' style='width:'>
                        <option name='servlist_servpbsize' value='".$pref['servlist_servpbsize']."'>".$pref['servlist_servpbsize']."</option>
                        <option name='servlist_servpbsize' value='560X95'>560X95</option>
                        <option name='servlist_servpbsize' value='350X20'>350X20</option>
                        </td>
		</tr>




</table><br><br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>




		<tr>
			<td colspan='3' class='fcaption'><b>Server List Menu Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Menu Title:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='50' name='servlist_servmtitle' value='" . $tp->toFORM($pref['servlist_servmtitle']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Menu Height:</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_servmheight' value='" . $tp->toFORM($pref['servlist_servmheight']) . "' />px (type auto for menu to automatically adjust height with no scroll)</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Banner Size:</td>
                        <td style='width:' class='forumheader3'>
                        <select name='servlist_servmbsize' size='1' class='tbox' style='width:'>
                        <option name='servlist_servmbsize' value='".$pref['servlist_servmbsize']."'>".$pref['servlist_servmbsize']."</option>
                        <option name='servlist_servmbsize' value='560X95'>560X95</option>
                        <option name='servlist_servmbsize' value='350X20'>350X20</option>
                        </td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'><b>Server List Menu Settings:(Tall Scrolling)</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Scroll Speed (Normal):</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_servmnormspeed' value='" . $tp->toFORM($pref['servlist_servmnormspeed']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Scroll Speed (Fast):</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_servmfastspeed' value='" . $tp->toFORM($pref['servlist_servmfastspeed']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Scroll Speed (Slow):</td>
			<td colspan='2'  class='forumheader3'><input class='tbox' type='text' size='10' name='servlist_servmslowspeed' value='" . $tp->toFORM($pref['servlist_servmslowspeed']) . "' /></td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Player Graph:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_servmgraph'] == 1 ? "<input type='checkbox' name='servlist_enable_servmgraph' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_servmgraph' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Top Players :</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_servmplayers'] == 1 ? "<input type='checkbox' name='servlist_enable_servmplayers' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_servmplayers' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Map Screenshot:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_enable_servmscreens'] == 1 ? "<input type='checkbox' name='servlist_enable_servmscreens' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_enable_servmscreens' value='0' />")."</td>
	        </tr>






</table><br><br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>




		<tr>
			<td colspan='3' class='fcaption'><b>Server Detail Page Settings:</b></td>
		</tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Players Past 24 Hours Graph:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_graph_playerday'] == 1 ? "<input type='checkbox' name='servlist_graph_playerday' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_graph_playerday' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Show Players Past Week Graph:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_graph_playerweek'] == 1 ? "<input type='checkbox' name='servlist_graph_playerweek' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_graph_playerweek' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Show Players Past Month Graph:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_graph_playermonth'] == 1 ? "<input type='checkbox' name='servlist_graph_playermonth' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_graph_playermonth' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Server Rank PastGraph:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_graph_rank'] == 1 ? "<input type='checkbox' name='servlist_graph_rank' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_graph_rank' value='0' />")."</td>
	        </tr>
                <tr>
		        <td style='width:30%' class='forumheader3'>Show Favorite Maps Past Week Graph:</td>
		        <td colspan=2 class='forumheader3'>".($pref['servlist_graph_maps'] == 1 ? "<input type='checkbox' name='servlist_graph_maps' value='1' checked='checked' />" : "<input type='checkbox' name='servlist_graph_maps' value='0' />")."</td>
	        </tr>
                <tr>
			<td style='width:30%' class='forumheader3'>Page Height:<br><i>Adjust height of the server details with scrolling layer for extra. Set to full to show all with no scrolling.(page will be 1010px min when set to full)</i></td>
                        <td style='width:' class='forumheader3'>
                        <select name='servlist_detailpageheight' size='1' class='tbox' style='width:'>
                        <option name='servlist_detailpageheight' value='".$pref['servlist_detailpageheight']."'>".$pref['servlist_detailpageheight']."</option>
                        <option name='servlist_detailpageheight' value='full'>full</option>
                        <option name='servlist_detailpageheight' value='half'>half</option>
                        <option name='servlist_detailpageheight' value='small'>small</option>
                        </td>
		</tr>





</table><br><br><br><table style='" . ADMIN_WIDTH . "' class='fborder'>





                <tr>
			<td colspan='3' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' /></td>
		</tr>



</table>
</form>";



$ns->tablerender($admin_title, $text);
require_once(e_ADMIN . "footer.php");
?>
