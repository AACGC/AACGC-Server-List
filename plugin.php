<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Server List               #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

$eplug_name = "AACGC Server List";
$eplug_version = "3.3";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Displays server banners from GameTracker and arranges into catagories and pages. Supports any game tracked by gametracker including TS2, TS3, and Ventrilo. Includeds option to allow user server submissions.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "aacgc_serverlist";

$eplug_menu_name   = "Server_List";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "logo.png";
$eplug_icon        = e_PLUGIN."aacgc_serverlist/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_serverlist/images/icon_16.png";
$eplug_caption     = "AACGC Server List";  

// Preferences --------------
$eplug_prefs = array(
"servlist_catpheader" => "",
"servlist_catphfsize" => "4",
"servlist_catpintro" => "",
"servlist_catpifsize" => "2",
"servlist_catptitle" => "Server Categories",
"servlist_catmtitle" => "Server Categories",
"servlist_catpfsize" => "3",
"servlist_catmfsize" => "2",
"servlist_catpfcolor" => "",
"servlist_catmfcolor" => "",
"servlist_catpcatpr" => "1",
"servlist_catmcatpr" => "1",
"servlist_detailpageheight" => "full",
"servlist_catpminicount" => "0",
"servlist_catmminicount" => "0",
"servlist_catpminisheight" => "auto",
"servlist_catmminisheight" => "auto",
"servlist_servmbsize" => "350X20",
"servlist_servpbsize" => "560X95",
"servlist_catmheight" => "auto",
"servlist_servmheight" => "auto",
"servlist_servmnormspeed" => "5",
"servlist_servmfastspeed" => "15",
"servlist_servmslowspeed" => "1",
"servlist_servmtitle" => "Servers",
"servlist_enable_headintro" => "0",
"servlist_enable_intro" => "0",
"servlist_enable_submit" => "1",
"servlist_enable_catpminib" => "1",
"servlist_enable_catmminib" => "0",
"servlist_enable_theme" => "1",
"servlist_enable_catcount" => "0",
"servlist_enable_catmcount" => "0",
"servlist_enable_servercount" => "0",
"servlist_enable_servermcount" => "0",
"servlist_sendpmto" => "1",
"servlist_graph_playerday" => "1",
"servlist_graph_playerweek" => "1",
"servlist_graph_playermonth" => "1",
"servlist_graph_rank" => "1",
"servlist_graph_maps" => "1",
);

$eplug_table_names = array("aacgc_serverlist", "aacgc_serverlist_cat", "aacgc_serverlist_submission");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_serverlist(server_id int(11) NOT NULL auto_increment,server_ip text NOT NULL,server_cat int(10) unsigned NOT NULL,gsid text NOT NULL,PRIMARY KEY  (server_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_serverlist_cat(server_cat_id int(11) NOT NULL auto_increment,server_cat_name text NOT NULL,PRIMARY KEY  (server_cat_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_serverlist_submission(submit_id int(11) NOT NULL auto_increment,game text NOT NULL,ip text NOT NULL,port text NOT NULL,gsid text NOT NULL,PRIMARY KEY  (submit_id)) ENGINE=MyISAM;",
);

$eplug_link      = TRUE;
$eplug_link_name = "Game Servers";
$eplug_link_url  = e_PLUGIN."aacgc_serverlist/Server_Categories.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
