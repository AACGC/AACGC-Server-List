<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Server List               #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



//-----------------------------------------------

$servers = $sql -> db_Count("aacgc_serverlist_submission");
$text .= "
<div style='padding-bottom: 2px;'>
<img src='".e_PLUGIN."aacgc_serverlist/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt=''>Servers Submissions: ".$servers."
</div>";


//-----------------------------------------------


?>