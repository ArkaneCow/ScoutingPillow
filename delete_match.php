<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
    header('Location: index.php');
}
if (isset($_GET['id'])) {
    $delete_event = $_GET['id'];
    $delete_id = $_GET['match'];
    $event_query = mysql_query("SELECT * FROM events WHERE id=" . $delete_event);
    if (!$event_query) {
        die(mysql_error());
    }
    $match_record = mysql_fetch_array($event_query);
    $match_table = $match_record['prefixName'] . "_matches";
    $db_query = "DELETE FROM " . $match_table . " WHERE id = " . $delete_id;
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
}
header('Location: match_list.php?id=' . $delete_event);
?>