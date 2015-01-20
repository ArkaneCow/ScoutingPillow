<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
$enteredBy = $POST['enteredBy'];
$matchNumber = $POST['matchNumber'];
$teamNumber = $POST['teamNumber'];
$botNumber = $POST['botNumber'];
$isDead = $POST['isDead'];
if (!isset($isDead) || $isDead != '1') {
    $isDead = '0';
}
$isShow = $POST['isShow'];
if (!isset($isShow) || $isShow != '1') {
    $isShow = '0';
}
$start = $POST['start'];
$yellowScored = $POST['yellowScored'];
$yellowPossess = $POST['yellowPossess'];
$yellowStack0 = $POST['yellowStack0'];
if (!isset($yellowStack0) || $yellowStack0 != '1') {
    $yellowStack0 = '0';
}
$yellowStack1 = $POST['yellowStack1'];
if (!isset($yellowStack1) || $yellowStack1 != '1') {
    $yellowStack1 = '0';
}
$yellowStack2 = $POST['yellowStack2'];
if (!isset($yellowStack2) || $yellowStack2 != '1') {
    $yellowStack2 = '0';
}
$autoContainerMoved = $POST['autoContainerMoved'];
$stepContainerMoved = $POST['stepContainerMoved'];
$mobility = $POST['mobility'];
if (!isset($mobility) || $mobility != '1') {
    $mobility = '0';
}
$greyToteMoved = $POST['greyToteMoved'];
$autoComments = $POST['autoComments'];
$totePossess = $POST['totePossess'];
$tote0 = $POST['tote0'];
$tote1 = $POST['tote1'];
$tote2 = $POST['tote2'];
$tote3 = $POST['tote3'];
$tote4 = $POST['tote4'];
$tote5 = $POST['tote5'];
$containerPossess = $POST['containerPossess'];
$container0 = $POST['container0'];
$container1 = $POST['container1'];
$container2 = $POST['container2'];
$container3 = $POST['container3'];
$container4 = $POST['container4'];
$container5 = $POST['container5'];
$noodleTrash = $POST['noodleTrash'];
$noodleLand = $POST['noodleLand'];
$noodleOther = $POST['noodleOther'];
$coopTote0 = $POST['coopTote0'];
$coopTote1 = $POST['coopTote1'];
$coopTote2 = $POST['coopTote2'];
$coopTote3 = $POST['coopTote3'];
$pickupLand = $POST['pickupLand'];
$pickupOther = $POST['pickupOther'];
$pickupHuman = $POST['pickupHuman'];
$teleComments = $POST['teleComments'];
$db_query = "";
if (!mysql_query($db_query)) {
    die(mysql_error());
}
?>