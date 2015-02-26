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
$enteredBy = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['enteredBy']);
$matchNumber = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['matchNumber']);
$teamNumber = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teamNumber']);
$botNumber = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['botNumber']);
$isDead = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['isDead']);
if (!isset($isDead) || $isDead != '1') {
    $isDead = '0';
}
$isShow = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['isShow']);
if (!isset($isShow) || $isShow != '1') {
    $isShow = '0';
}
$start = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['start']);
$yellowScored = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['yellowScored']);
$yellowPossess = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['yellowPossess']);
$yellowStack0 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['yellowStack0']);
if (!isset($yellowStack0) || $yellowStack0 != '1') {
    $yellowStack0 = '0';
}
$yellowStack1 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['yellowStack1']);
if (!isset($yellowStack1) || $yellowStack1 != '1') {
    $yellowStack1 = '0';
}
$yellowStack2 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['yellowStack2']);
if (!isset($yellowStack2) || $yellowStack2 != '1') {
    $yellowStack2 = '0';
}
$autoContainerMoved = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoContainerMoved']);
$stepContainerMoved = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['stepContainerMoved']);
$mobility = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['mobility']);
if (!isset($mobility) || $mobility != '1') {
    $mobility = '0';
}
$greyToteMoved = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['greyToteMoved']);
$autoComments = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoComments']);
$totePossess = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['totePossess']);
$tote0 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['tote0']);
$tote1 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['tote1']);
$tote2 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['tote2']);
$tote3 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['tote3']);
$tote4 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['tote4']);
$tote5 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['tote5']);
$containerPossess = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['containerPossess']);
$container0 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['container0']);
$container1 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['container1']);
$container2 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['container2']);
$container3 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['container3']);
$container4 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['container4']);
$container5 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['container5']);
$noodleTrash = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['noodleTrash']);
$noodleLand = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['noodleLand']);
$noodleOther = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['noodleOther']);
$coopTote0 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['coopTote0']);
$coopTote1 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['coopTote1']);
$coopTote2 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['coopTote2']);
$coopTote3 = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['coopTote3']);
$pickupLand = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['pickupLand']);
$pickupOther = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['pickupOther']);
$pickupHuman = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['pickupHuman']);
$teleComments = preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teleComments']);
$data_name = $record['prefixName'] . "_data";
$db_query = "INSERT INTO " . $data_name . "(enteredBy, matchNumber, teamNumber, botNumber, isDead, isShow, start, yellowScored, yellowPossess, yellowStack0, yellowStack1, yellowStack2, autoContainerMoved, stepContainerMoved, mobility, greyToteMoved, autoComments, totePossess, tote0, tote1, tote2, tote3, tote4, tote5, containerPossess, container0, container1, container2, container3, container4, container5, noodleTrash, noodleLand, noodleOther, coopTote0, coopTote1, coopTote2, coopTote3, pickupLand, pickupOther, pickupHuman, teleComments) VALUES('" . $enteredBy . "','" . $matchNumber . "','" . $teamNumber . "','" . $botNumber . "','" . $isDead . "','" . $isShow . "','" . $start . "','" . $yellowScored . "','" . $yellowPossess . "','" . $yellowStack0 . "','" . $yellowStack1 . "','" . $yellowStack2 . "','" . $autoContainerMoved . "','" . $stepContainerMoved . "','" . $mobility . "','" . $greyToteMoved . "','" . $autoComments . "','" . $totePossess . "','" . $tote0 . "','" . $tote1 . "','" . $tote2 . "','" . $tote3 . "','" . $tote4 . "','" . $tote5 . "','" . $containerPossess . "','" . $container0 . "','" . $container1 . "','" . $container2 . "','" . $container3 . "','" . $container4 . "','" . $container5 . "','" . $noodleTrash . "','" . $noodleLand . "','" . $noodleOther . "','" . $coopTote0 . "','" . $coopTote1 . "','" . $coopTote2 . "','" . $coopTote3 . "','" . $pickupLand . "','" . $pickupOther . "','" . $pickupHuman . "','" . $teleComments . "')";
if (!mysql_query($db_query)) {
    die(mysql_error());
}
header('Location: index.php');
?>