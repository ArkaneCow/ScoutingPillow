<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
    header('Location: index.php');
}
?>
<?php

if (!isset($_GET['id'])) {
    header('Location: index.php');
}
$field_query = mysql_query("SELECT * FROM events WHERE id=" . $_GET['id']);
if (mysql_num_rows($field_query) != 1) {
    header('Location: index.php');
}
$record = mysql_fetch_array($field_query);
$teams_name = $record['prefixName'] . "_teams";
$teams_query = mysql_query("INSERT INTO " . $teams_name . "(teamNumber, teamName) VALUES(" . $_POST['teamNumber'] . "," . $_POST['teamName'] . ")");
if (!teams_query) {
    die(mysql_error());
}
header('Location: team_list.php?id=' . $_GET['id']);
?>