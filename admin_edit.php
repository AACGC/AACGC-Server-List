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
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $id = $tmp[1];
        unset($tmp);
}
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_server'])) {
        $message = ($sql->db_Update("aacgc_serverlist", "server_ip='".$tp->toDB($_POST['server_ip'])."', server_cat='".$tp->toDB($_POST['server_cat'])."', gsid='".$tp->toDB($_POST['gsid'])."' WHERE server_id='".$_POST['id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($_POST['main_delete'])) {
        $delete_id = array_keys($_POST['main_delete']);
	$sql2 = new db;
    $sql2->db_Delete("aacgc_serverlist", "server_id='".$delete_id[0]."'");
	
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "") {
        $text .= $rs->form_open("post", e_SELF, "myform_".$row['server_id']."", "", "");
        $text .= "
        <div style='text-align:center'>
        <table style='width:95%' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:0%' class='forumheader3'>ID</td>
        <td style='width:50%' class='forumheader3'>IP:PORT</td>
        <td style='width:0%' class='forumheader3'>GSID</td>
        <td style='width:50%' class='forumheader3'>Category</td>
        <td style='width:0%' class='forumheader3'>Options</td>
       </tr>";
        $sql->db_Select("aacgc_serverlist", "*", "ORDER BY server_cat ASC","");
        while($row = $sql->db_Fetch()){
        $sql3 = new db;
        $sql3->db_Select("aacgc_serverlist_cat", "*", "WHERE server_cat_id='".$row['server_cat']."'","");
        $row3 = $sql3->db_Fetch();
        $text .= "
        <tr>
        <td style='width:' class='forumheader3'>".$row['server_id']."</td>
        <td style='width:' class='forumheader3'>".$row['server_ip']."<br><a href='http://www.gametracker.com/server_info/".$row['server_ip']."/' target='_blank'>
<img src='http://cache.www.gametracker.com/server_info/".$row['server_ip']."/b_350x20_C323957-202743-F19A15-111111.png' border='0' width='350' height='20'></img>
</a></td>
        <td style='width:' class='forumheader3'>".$row['gsid']."</td>
        <td style='width:' class='forumheader3'>".$row3['server_cat_name']."</td>
        <td style='width:' class='forumheader3'>
        
		<a href='".e_SELF."?edit.{$row['server_id']}'>".ADMIN_EDIT_ICON."</a>
		<input type='image' title='".LAN_DELETE."' name='main_delete[".$row['server_id']."]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$row['server_id']} ]')\"/>
		</td>
        </tr>";
		}
        $text .= "
        </table>
        </div>";
        $text .= $rs->form_close();
	      $ns -> tablerender("AACGC Server List (Edit Server)", $text);
	      require_once(e_ADMIN."footer.php");
}
//-----------------------------------------------------------------------------------------------------------+

//-----------------------------------------------------------------------------------------------------------+

if ($action == "edit")
{
                
$sql->db_Select("aacgc_serverlist", "*", "server_id = $id");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_serverlist_cat", "*");
$rows = $sql2->db_Rows();
for ($i=0; $i < $rows; $i++) {
$option = $sql2->db_Fetch();
$options .= "<option name='server_cat' value='".$option['server_cat_id']."'>".$option['server_cat_name']."</option>";}

$sql3 = new db;
$sql3->db_Select("aacgc_serverlist_cat", "*", "WHERE server_cat_id=".$row['server_cat']."", "");
$row3 = $sql3->db_fetch();


        $width = "width:100%";
        $text = "
        <div style='text-align:center'>
        ".$rs -> form_open("post", e_SELF, "MyForm", "", "enctype='multipart/form-data'", "")."
        <table style='".$width."' class='fborder' cellspacing='0' cellpadding='0'>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>IP:PORT</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("server_ip", 100, $row['server_ip'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>GSID:</td>
        <td style='width:70%' class='forumheader3'>
            ".$rs -> form_text("gsid", 100, $row['gsid'], 500)."
        </td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='server_cat' size='1' class='tbox' style='width:50%'>
                <option name='server_cat' value='".$row3['server_cat_id']."'>".$row3['server_cat_name']."</option>
		".$options."
        </td>
        </tr>
";

        $text .= "</div>
        </td></tr>
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
        ".$rs->form_hidden("id", "".$row['server_id']."")."
        ".$rs -> form_button("submit", "update_server", "Update")."
        </td>
        </tr>
        </table>
        ".$rs -> form_close()."
        </div>";
	      $ns -> tablerender("AACGC Server List (Edit Server)", $text);
	      require_once(e_ADMIN."footer.php");
}
?>

