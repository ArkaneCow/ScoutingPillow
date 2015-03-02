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
if (!isset($_POST['match']) || !isset($_POST['red1']) || !isset($_POST['red2']) || !isset($_POST['red3']) || !isset($_POST['blue1']) || !isset($_POST['blue2']) || !isset($_POST['blue3'])) {
    header('Location: match_list.php?id=' . $_GET['id']);
}
$field_query = mysql_query("SELECT * FROM events WHERE id=" . $_GET['id']);
if (mysql_num_rows($field_query) != 1) {
    header('Location: index.php');
}
$record = mysql_fetch_array($field_query);
$match_name = $record['prefixName'] . "_matches";
$match_query = mysql_query("INSERT INTO " . $match_name . "(id, red1, red2, red3, blue1, blue2, blue3) VALUES(" . $_POST['match'] . "," . $_POST['red1'] . "," . $_POST['red2'] . "," . $_POST['red3'] . "," . $_POST['blue1'] . "," . $_POST['blue2'] . "," . $_POST['blue3'] . ")");
if (!match_query) {
    die(mysql_error());
}
header('Location: match_list.php?id=' . $_GET['id']);
?>