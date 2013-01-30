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
  
$title .= "Game Server Submission Form";

if ($pref['servlist_enable_theme'])
{$themea = "indent";
$themeb = "forumheader3";}
else
{$themea = "";
$themeb = "";}

if ($pref['servlist_enable_submit'] == "1"){

if (USER){
//----------------------------------------------
if ($_POST['add_server'] == '1') {

$sql->db_Select("aacgc_serverlist", "*", "", "");
$servs = $sql->db_Fetch();
$serverlist = $servs['server_ip'];

$newgame = $tp->toDB($_POST['game']);
$newip = $tp->toDB($_POST['ip']);
$newport = $tp->toDB($_POST['port']);
$newgsid = $tp->toDB($_POST['gsid']);

$newipport = "".$newip.":".$newport."";

$newpmfrom = $_POST['pm_from'];
$newpmto = $_POST['pm_to'];
$newpmsent = $_POST['pm_sent'];
$newpmread = $_POST['pm_read'];
$newpmsubject = $_POST['pm_subject'];
$newpmtext = $_POST['pm_text'];
$newpmsenddel = $_POST['pm_send_del'];
$newpmreaddel = $_POST['pm_read_del'];
$newpmatt = $_POST['pm_attachments'];
$newpmoption = $_POST['pm_option'];
$newpmsize = $_POST['pm_size'];

$reason = "";
$newok = "";

if ($serverlist == "".$newipport."")
{$newok = "0";
$reason = "This server is already listed.";} 

else 

{$newok = "1";}

If ($newok == "0")
{$text .= "<br><br><center><b>".$reason."</b></center>";}

If ($newok == "1"){

$sql->db_Insert("aacgc_serverlist_submission", "NULL, '".$newgame."','".$newip."', '".$newport."', '".$newgsid."'") or die(mysql_error());
$sql2->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());

$text .= "<br><br><center><b>Server Submission Sent, Waiting on Admin Approval.</b></center>";

}}


//-------------       

$sql->db_Select("aacgc_serverlist_cat", "*", "ORDER BY server_cat_name ASC", "");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql->db_Fetch();
$options .= "<option name='server_cat' value='".$option['server_cat_name']."'>".$option['server_cat_name']."</option>";
}

$text .= "<br><br>
<form method='POST' action='Server_Submit_Form.php'><center>
<table style='' class='".$themea."'>
<tr>
<td colspan='2' class='".$themea."'>Servers Must Be Registered With GameTracker at <a href='http://www.gametracker.com' target='_blank'>www.GameTracker.com</a></td>
</tr>
<tr>
<td style='width:100px; text-align:right' class='".$themea."'>Game:</td>
<td style='width:' class='".$themea."'>
<select name='game' size='1' class='tbox' style='width:50%'>
".$options."
</td>
</tr>
<tr>
<td style='width:100px; text-align:right' class='".$themea."'>Server IP:</td>
<td style='width:' class='".$themea."'><input class='tbox' type='text' name='ip' size='50'></td>
</tr>
<tr>
<td style='width:100px; text-align:right' class='".$themea."'>Server Port:</td>
<td style='width:' class='".$themea."'><input class='tbox' rows='3' cols='50' name='port' size='50'></td>
</tr>
<tr>
<td style='width:100px; text-align:right' class='".$themea."'>GSID:</td>
<td style='width:' class='".$themea."'><input class='tbox' type='text' name='gsid' size='50'></td>
</tr>
<tr>
<td colspan='2' class='".$themea."'><i>GSID can be found by right clicking a graph on your server's GameTracker detail page. GSID is required to have graphs show on server detail pages.</i></td>
</tr>
</table><center>
<br><br>";


//-----------------------# Auto PM Section #------------------------+

$subject = "Server Submitted To Server List";
$message = "<b>".USERNAME."</b> has submitted a server to the server list.<br><br><a href=".e_PLUGIN."aacgc_serverlist/admin_new.php>[Click Here To View]</a>";
$to = "".$pref['servlist_sendpmto']."";
$from = "".USERID."";
$offset = +0;
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "
        <input type='hidden' name='pm_from' value='".$from."'>
        <input type='hidden' name='pm_to' value='".$to."'>
        <input type='hidden' name='pm_sent' value='".$sent."'>
        <input type='hidden' name='pm_read' value='0'>
        <input type='hidden' name='pm_subject' value='".$subject."'>
        <input type='hidden' name='pm_text' value='".$message."'>
        <input type='hidden' name='pm_send_del' value='0'>
        <input type='hidden' name='pm_read_del' value='0'>
        <input type='hidden' name='pm_attachments' value=''>
        <input type='hidden' name='pm_option' value=''>
        <input type='hidden' name='pm_size' value='0'>
";

//------------------------------------------------------------------+



$text .= "<input type='hidden' name='add_server' value='1'>
	  <input class='button' type='submit' value='Submit'>
	  </form>
	  <br>
	  ";

}
//-------------
else
{

$text .= "<br><br><i>You Must Login or Register to Submit a Server</i>";}}

else

{$text .= "<br><br><i>Server Submissions are not enabled.</i>";}


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

