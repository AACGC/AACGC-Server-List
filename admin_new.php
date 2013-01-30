<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Server List               #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/
require_once("../../class2.php");
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

//-----------------------------------------------------------------------------------------------------------+
if ($_POST['add_server'] == '1') {
$newserverip = $tp->toDB($_POST['server_ip']);
$newservercat = $tp->toDB($_POST['server_cat']);
$newservergsid = $tp->toDB($_POST['gsid']);
$reason = "";
$newok = "";


if (($newserverip == "") OR ($newservercat == "")){
	$newok = "0";
	$reason = "No IP or Category Selected";
} else {
	$newok = "1";
}

If ($newok == "0"){
 	$newtext = "
 	<center>
	<b><br><br> ".$reason."
	</center>
 	</b>
	";
	$ns->tablerender("", $newtext);
}
If ($newok == "1"){
$sql->db_Insert("aacgc_serverlist", "NULL, '".$newserverip."', '".$newservercat."', '".$newservergsid."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Server Added</b></center>");
}
}
//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";


$sql->db_Select("aacgc_serverlist_cat", "*", "ORDER BY server_cat_name ASC", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='server_cat' value='".$option['server_cat_id']."'>".$option['server_cat_name']."</option>";
}

$text .= "
        <tr>
        <td colspan='2' style='width:100%; text-align:center' class='forumheader3'>Servers Must Be Registered With GameTracker at <a href='http://www.gametracker.com' target='_blank'>www.GameTracker.com</a><br><br><i>GSID can be found by right clicking a graph on your server's GameTracker detail page. GSID is required to have graphs show on server detail pages.</i><br></td>
        </tr>

        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Server IP:PORT = </td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='server_ip' size='100'>
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Server Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='server_cat' size='1' class='tbox' style='width:50%'>
		".$options."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>GSID = </td>
        <td style='width:70%' class='forumheader3'>
        <input class='tbox' type='text' name='gsid' size='100'>
        </td>
        </tr>

";
        $text .= "</div>
        </td>
		</tr>
		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_server' value='1'>
		<input class='button' type='submit' value='Add Server'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";





//---------------------------------------------------------------------------------------------------------------


if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_serverlist_submission", "submit_id='".$delete_id[0]."'");
	
}



if ($_POST['add_serversubmitted'] == '1') {


$sql->db_Select("aacgc_serverlist", "*", "", "");
$row = $sql ->db_Fetch();

$newserverip = $_POST['server_ip'];
$newservercat = $_POST['server_cat'];
$newservergsid = $_POST['gsid'];

$newipport = "".$newserverip."";
$serverlist = $row['server_ip'];

$reason = "";
$newok = "";

if ($newserverip == "".$row['server_ip']."")
{$newok = "0";
$reason = "This server is already listed.";} 
else 
{$newok = "1";}


If ($newok == "0"){
$newtext = "<center><b><br><br> ".$reason."</center></b>";
$ns->tablerender("", $newtext);}

If ($newok == "1"){
$sql->db_Insert("aacgc_serverlist", "NULL, '".$newserverip."', '".$newservercat."', '".$newservergsid."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Server Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+

if ($action == "") {


        $text .= "<br><br><br>
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
	<td colspan='5' style='width:100%' class='forumheader3'><center><b>Submitted Servers</b></center></td>
	</tr><tr>
        <td style='width:5%' class='forumheader3'>ID</td>
        <td style='width:40%' class='forumheader3'>Game</td>
        <td style='width:25%' class='forumheader3'>IP:PORT</td>
        <td style='width:0%' class='forumheader3'>GSID</td>
        <td style='width:5%' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_serverlist_submission", "*", "ORDER BY submit_id ASC","");
        while($row = $sql->db_Fetch()){

        $sql2 = new db;
        $sql2->db_Select("aacgc_serverlist_cat", "*", "WHERE server_cat_name='".$row['game']."'","");
        $row2 = $sql2->db_Fetch();

        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['submit_id']."</td>
        <td style='width:' class='forumheader3'>".$row['game']."<br>
<a href='http://www.gametracker.com/server_info/".$row['ip'].":".$row['port']."/' target='_blank'><img src='http://cache.www.gametracker.com/server_info/".$row['ip'].":".$row['port']."/b_350_20_323957_202743_F19A15_111111.png' border='0' width='350' height='20'  alt=''/></a>
	</td>
        <td style='width:' class='forumheader3'>".$row['ip'].":".$row['port']."</td>
        <td style='width:' class='forumheader3'>".$row['gsid']."</td>
        <td style='width:' class='forumheader3'>

<form method='POST' action='admin_new.php'>
<input type='hidden' name='server_ip' value='".$row['ip'].":".$row['port']."'>
<input type='hidden' name='server_cat' value='".$row2['server_cat_id']."'>
<input type='hidden' name='gsid' value='".$row['gsid']."'>
<input type='hidden' name='add_serversubmitted' value='1'>
<input type='image' title='Accept' type='submit' src='".e_PLUGIN."aacgc_serverlist/images/accept.png' onclick=\"return jsconfirm('Add Server To List? [".$row2['server_cat_name']." - ".$row['ip'].":".$row['port']." ]')\"/>
</form>

<form method='POST' action='admin_new.php'>
<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['submit_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['submit_id']} ]')\"/>
</form>
        </td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";

	      




$ns -> tablerender("AACGC Server List (Add Server / View Submissions)", $text);}
require_once(e_ADMIN."footer.php");
?>
