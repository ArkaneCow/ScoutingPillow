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
$teamNumber = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teamNumber']));
$talkedTo = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['talkedTo']));
$goals = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['goals']));
$manipulator = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['manipulator']));
$wheels = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['wheels']));
$auto = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['auto']));
if (!isset($auto) || $auto != '1') {
    $auto = '0';
}
$autoStrategy = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoStrategy']));
$autoMobility = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoMobility']));
if (!isset($autoMobility) || $autoMobility != '1') {
    $autoMobility = '0';
}
$autoPushTotes = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoPushTotes']));
$autoStackTotes = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoStackTotes']));
$autoPushContainers = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['autoPushContainers']));
$coop = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['coop']));
if (!isset($coop) || $coop != '1') {
    $coop = '0';
}
$teleStrategy = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teleStrategy']));
$teleStackTotes = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teleStackTotes']));
$teleScoringPlatform = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teleScoringPlatform']));
if (!isset($teleScoringPlatform) || $teleScoringPlatform != '1') {
    $teleScoringPlatform = '0';
}
$telePushContainer = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['telePushContainer']));
if (!isset($telePushContainer) || $telePushContainer != '1') {
    $telePushContainer = '0';
}
$teleNoodleContainer = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['teleNoodleContainer']));
if (!isset($teleNoodleContainer) || $teleNoodleContainer != '1') {
    $teleNoodleContainer = '0';
}
$time = time();
$upload_file = "";
if ($_FILES['media']['name']) {
    $upload_dir = "media/";
    $upload_file = $upload_dir . $time . basename($_FILES['media']['name']);
    move_uploaded_file($_FILES['media']['tmp_name'], $upload_file);
}
$additionalComments = mysql_real_escape_string(preg_replace("/[^A-Za-z0-9-\?\!\$\#\@\(\)\"\'\.\:\;\\@\,\_ \=\/\<\> ]/",'',$_POST['additionalComments']));
$prescout_name = $record['prefixName'] . "_prescout";
$pictures = $upload_file; 
$db_query = "INSERT INTO " . $prescout_name . "(teamNumber, talkedTo, goals, manipulator, wheels, auto, autoStrategy, autoMobility, autoPushTotes, autoStackTotes, autoPushContainers, coop, teleStrategy, teleStackTotes, teleScoringPlatform, telePushContainer, teleNoodleContainer, pictures, additionalComments) VALUES('" . $teamNumber . "','" . $talkedTo . "','" . $goals . "','" . $manipulator . "','" . $wheels . "','" . $auto . "','" . $autoStrategy . "','" . $autoMobility . "','" . $autoPushTotes . "','" . $autoStackTotes . "','" . $autoPushContainers . "','" . $coop . "','" . $teleStrategy . "','" . $teleStackTotes . "','" . $teleScoringPlatform . "','" . $telePushContainer . "','" . $teleNoodleContainer . "','" . $pictures . "','" . $additionalComments . "')";
if (!mysql_query($db_query)) {
    die(mysql_error());
}
header('Location: index.php');
?>