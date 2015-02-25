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
$teamNumber = $_POST['teamNumber'];
$talkedTo = $_POST['talkedTo'];
$goals = $_POST['goals'];
$manipulator = $_POST['manipulator'];
$wheels = $_POST['wheels'];
$auto = $_POST['auto'];
if (!isset($auto) || $auto != '1') {
    $auto = '0';
}
$autoStrategy = $_POST['autoStrategy'];
$autoMobility = $_POST['autoMobility'];
if (!isset($autoMobility) || $autoMobility != '1') {
    $autoMobility = '0';
}
$autoPushTotes = $_POST['autoPushTotes'];
$autoStackTotes = $_POST['autoStackTotes'];
$autoPushContainers = $_POST['autoPushContainers'];
$coop = $_POST['coop'];
if (!isset($coop) || $coop != '1') {
    $coop = '0';
}
$teleStrategy = $_POST['teleStrategy'];
$teleStackTotes = $_POST['teleStackTotes'];
$teleScoringPlatform = $_POST['teleScoringPlatform'];
if (!isset($teleScoringPlatform) || $teleScoringPlatform != '1') {
    $teleScoringPlatform = '0';
}
$telePushContainer = $_POST['telePushContainer'];
if (!isset($telePushContainer) || $telePushContainer != '1') {
    $telePushContainer = '0';
}
$teleNoodleContainer = $_POST['teleNoodleContainer'];
if (!isset($teleNoodleContainer) || $teleNoodleContainer != '1') {
    $teleNoodleContainer = '0';
}
$time = time();
$upload_file = "";
if ($_FILES['media']['name']) {
    $upload_dir = "media/";
    $upload_file = $upload_dir . $time . basename($_FILES['media']['name']);
    $imageFileType = pathinfo($upload_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES['media']['tmp_name']);
    move_uploaded_file($_FILES['media']['tmp_name'], $upload_file);
}
$additionalComments = $_POST['additionalComments'];
$prescout_name = $record['prefixName'] . "_prescout";
$pictures = $upload_file; 
$db_query = "INSERT INTO " . $prescout_name . "(teamNumber, talkedTo, goals, manipulator, wheels, auto, autoStrategy, autoMobility, autoPushTotes, autoStackTotes, autoPushContainers, coop, teleStrategy, teleStackTotes, teleScoringPlatform, telePushContainer, teleNoodleContainer, pictures, additionalComments) VALUES('" . $teamNumber . "','" . $talkedTo . "','" . $goals . "','" . $manipulator . "','" . $wheels . "','" . $auto . "','" . $autoStrategy . "','" . $autoMobility . "','" . $autoPushTotes . "','" . $autoStackTotes . "','" . $autoPushContainers . "','" . $coop . "','" . $teleStrategy . "','" . $teleStackTotes . "','" . $teleScoringPlatform . "','" . $telePushContainer . "','" . $teleNoodleContainer . "','" . $pictures . "','" . $additionalComments . "')";
if (!mysql_query($db_query)) {
    die(mysql_error());
}
header('Location: index.php');
?>