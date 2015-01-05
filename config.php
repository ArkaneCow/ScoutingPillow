<?php
    $db_connection = mysql_connect('localhost', 'root', '');
    if (!$db_connection) {
        die('Could not connect to database ' . mysql_error());
    }
    mysql_select_db("scoutingpillow", $db_connection);
?>