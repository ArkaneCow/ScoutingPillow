<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
$field_query = mysql_query("SELECT * FROM events WHERE id=" . $_GET['id']);
if (mysql_num_rows($field_query) != 1) {
    header('Location: live_scout.php');
}
$record = mysql_fetch_array($field_query);
$enteredBy = $_POST['enteredBy'];
$matchNumber = $_POST['matchNumber'];
$teamNumber = $_POST['teamNumber'];
$botNumber = $_POST['botNumber'];
$isDead = $_POST['isDead'];
if (!isset($isDead) || $isDead != '1') {
    $isDead = '0';
}
$isShow = $_POST['isShow'];
if (!isset($isShow) || $isShow != '1') {
    $isShow = '0';
}
$start = $_POST['start'];
$yellowScored = $_POST['yellowScored'];
$yellowPossess = $_POST['yellowPossess'];
$yellowStack0 = $_POST['yellowStack0'];
if (!isset($yellowStack0) || $yellowStack0 != '1') {
    $yellowStack0 = '0';
}
$yellowStack1 = $_POST['yellowStack1'];
if (!isset($yellowStack1) || $yellowStack1 != '1') {
    $yellowStack1 = '0';
}
$yellowStack2 = $_POST['yellowStack2'];
if (!isset($yellowStack2) || $yellowStack2 != '1') {
    $yellowStack2 = '0';
}
$autoContainerMoved = $_POST['autoContainerMoved'];
$stepContainerMoved = $_POST['stepContainerMoved'];
$mobility = $_POST['mobility'];
if (!isset($mobility) || $mobility != '1') {
    $mobility = '0';
}
$greyToteMoved = $_POST['greyToteMoved'];
$autoComments = $_POST['autoComments'];
$totePossess = $_POST['totePossess'];
$tote0 = $_POST['tote0'];
$tote1 = $_POST['tote1'];
$tote2 = $_POST['tote2'];
$tote3 = $_POST['tote3'];
$tote4 = $_POST['tote4'];
$tote5 = $_POST['tote5'];
$containerPossess = $_POST['containerPossess'];
$container0 = $_POST['container0'];
$container1 = $_POST['container1'];
$container2 = $_POST['container2'];
$container3 = $_POST['container3'];
$container4 = $_POST['container4'];
$container5 = $_POST['container5'];
$noodleTrash = $_POST['noodleTrash'];
$noodleLand = $_POST['noodleLand'];
$noodleOther = $_POST['noodleOther'];
$coopTote0 = $_POST['coopTote0'];
$coopTote1 = $_POST['coopTote1'];
$coopTote2 = $_POST['coopTote2'];
$coopTote3 = $_POST['coopTote3'];
$pickupLand = $_POST['pickupLand'];
$pickupOther = $_POST['pickupOther'];
$pickupHuman = $_POST['pickupHuman'];
$teleComments = $_POST['teleComments'];
$data_name = $record['prefixName'] . "_data";
$db_query = "INSERT INTO " . $data_name . "(enteredBy, matchNumber, teamNumber, botNumber, isDead, isShow, start, yellowScored, yellowPossess, yellowStack0, yellowStack1, yellowStack2, autoContainerMoved, stepContainerMoved, mobility, greyToteMoved, autoComments, totePossess, tote0, tote1, tote2, tote3, tote4, tote5, containerPossess, container0, container1, container2, container3, container4, container5, noodleTrash, noodleLand, noodleOther, coopTote0, coopTote1, coopTote2, coopTote3, pickupLand, pickupOther, pickupHuman, teleComments) VALUES('" . $enteredBy . "','" . $matchNumber . "','" . $teamNumber . "','" . $botNumber . "','" . $isDead . "','" . $isShow . "','" . $start . "','" . $yellowScored . "','" . $yellowPossess . "','" . $yellowStack0 . "','" . $yellowStack1 . "','" . $yellowStack2 . "','" . $autoContainerMoved . "','" . $stepContainerMoved . "','" . $mobility . "','" . $greyToteMoved . "','" . $autoComments . "','" . $totePossess . "','" . $tote0 . "','" . $tote1 . "','" . $tote2 . "','" . $tote3 . "','" . $tote4 . "','" . $tote5 . "','" . $containerPossess . "','" . $container0 . "','" . $container1 . "','" . $container2 . "','" . $container3 . "','" . $container4 . "','" . $container5 . "','" . $noodleTrash . "','" . $noodleLand . "','" . $noodleOther . "','" . $coopTote0 . "','" . $coopTote1 . "','" . $coopTote2 . "','" . $coopTote3 . "','" . $pickupLand . "','" . $pickupOther . "','" . $pickupHuman . "','" . $teleComments . "')";
if (!mysql_query($db_query)) {
    die(mysql_error());
}
header('Location: index.php');
?>