<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
    header('Location: index.php');
}
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    $find_query = mysql_query("SELECT * FROM events WHERE id=" . $delete_id);
    if (mysql_num_rows($find_query) == 1) {
        $record = mysql_fetch_array($find_query);
        $prefix_name = $record['prefixName'];
        $matches_name = $prefix_name . "_matches";
        $data_name = $prefix_name . "_data";
        $teams_name = $prefix_name . "_teams";
        $prescout_name = $prefix_name . "_prescout";
        $db_query = "DROP TABLE " . $matches_name;
        if (!mysql_query($db_query)) {
            die(mysql_error());
        }
        $db_query = "DROP TABLE " . $data_name;
        if (!mysql_query($db_query)) {
            die(mysql_error());
        }
        $db_query = "DROP TABLE " . $teams_name;
        if (!mysql_query($db_query)) {
            die(mysql_error());
        }
        $db_query = "DROP TABLE " . $prescout_name;
        if (!mysql_query($db_query)) {
            die(mysql_error());
        }
        $db_query = "DELETE FROM events WHERE id=" . $delete_id;
        if (!mysql_query($db_query)) {
            die(mysql_error());
        }
    }
}
header('Location: manage_events.php');
?>