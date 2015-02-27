<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
    header('Location: index.php');
}
$new_event = $_POST['eventName'];
$new_prefix = str_replace(' ', '_', $new_event);
if (isset($new_event)) {
    $db_query = "INSERT INTO events(eventName, prefixName) VALUES('" . $new_event . "', '" . $new_prefix . "')";
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
    $matches_name = $new_prefix . "_matches";
    $db_query = "CREATE TABLE " . $matches_name . "(id int(11) NOT NULL, red1 int(4) NOT NULL, red2 int(4) NOT NULL, red3 int(4) NOT NULL, blue1 int(4) NOT NULL, blue2 int(4) NOT NULL, blue3 int(4) NOT NULL, PRIMARY KEY(id))";
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
    $data_name = $new_prefix . "_data";
    $db_query = "CREATE TABLE " . $data_name . "(id int(11) NOT NULL AUTO_INCREMENT, enteredBy int(11) NOT NULL, matchNumber int(4) NOT NULL, teamNumber int(4) NOT NULL, botNumber tinyint(1) NOT NULL, isDead tinyint(1) NOT NULL, isShow tinyint(1) NOT NULL, start tinyint(1) NOT NULL, yellowScored tinyint(1) NOT NULL, yellowPossess tinyint(1) NOT NULL, yellowStack0 tinyint(1) NOT NULL, yellowStack1 tinyint(1) NOT NULL, yellowStack2 tinyint(1) NOT NULL, autoContainerMoved tinyint(1) NOT NULL, stepContainerMoved tinyint(1) NOT NULL, mobility tinyint(1) NOT NULL, greyToteMoved tinyint(1) NOT NULL, autoComments text, totePossess tinyint(1) NOT NULL, tote0 tinyint(1) NOT NULL, tote1 tinyint(1) NOT NULL, tote2 tinyint(1) NOT NULL, tote3 tinyint(1) NOT NULL, tote4 tinyint(1) NOT NULL, tote5 tinyint(1) NOT NULL, containerPossess tinyint(1) NOT NULL, container0 tinyint(1) NOT NULL, container1 tinyint(1) NOT NULL, container2 tinyint(1) NOT NULL, container3 tinyint(1) NOT NULL, container4 tinyint(1) NOT NULL, container5 tinyint(1) NOT NULL, noodleTrash tinyint(1) NOT NULL, noodleLand tinyint(1) NOT NULL, noodleOther tinyint(1) NOT NULL, coopTote0 tinyint(1) NOT NULL, coopTote1 tinyint(1) NOT NULL, coopTote2 tinyint(1) NOT NULL, coopTote3 tinyint(1) NOT NULL, pickupLand tinyint(1) NOT NULL, pickupOther tinyint(1) NOT NULL, pickupHuman tinyint(1) NOT NULL, teleComments text, PRIMARY KEY(id))";
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
    $teams_name = $new_prefix . "_teams";
    $db_query = "CREATE TABLE " . $teams_name . "(id int(11) NOT NULL AUTO_INCREMENT, teamNumber int(4) NOT NULL, teamName varchar(100) NOT NULL, PRIMARY KEY(id))";
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
    $prescout_name = $new_prefix . "_prescout";
    $db_query = "CREATE TABLE " . $prescout_name . "(id int(11) NOT NULL AUTO_INCREMENT, enteredBy int(11) NOT NULL, teamNumber int(4) NOT NULL, talkedTo varchar(100) NOT NULL, goals text NOT NULL, manipulator varchar(100) NOT NULL, wheels varchar(100) NOT NULL, auto tinyint(1) NOT NULL, autoStrategy text, autoMobility tinyint(1), autoPushTotes tinyint(1), autoStackTotes tinyint(1), autoPushContainers tinyint(1), coop tinyint(1) NOT NULL, teleStrategy text, teleStackTotes tinyint(1) NOT NULL, teleScoringPlatform tinyint(1) NOT NULL, telePushContainer tinyint(1) NOT NULL, teleNoodleContainer tinyint(1) NOT NULL, programmingLanguage varchar(20) NOT NULL, humanStation varchar(20) NOT NULL, pictures varchar(100), additionalComments text, PRIMARY KEY(id))";
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
}
header('Location: manage_events.php');
?>