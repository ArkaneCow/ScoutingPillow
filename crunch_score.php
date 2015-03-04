<?php

session_start();
include('config.php');
?>
<?php

if ($_SESSION['rank'] > 2) {
    header('Location: index.php');
}
?>
<?php
$event_name = $_GET['id'];
$event_query = mysql_query("SELECT * FROM events WHERE id=" . $event_name);
$event = mysql_fetch_array($event_query);
$data_name = $event['prefixName'] . "_data";
$team_number = $_GET['team'];
$variable = "score";
$csv_path = "/var/tmp/" . $_GET['team'] . $variable . time() . ".csv";
$png_path = "media/" . $_GET['team'] . $variable . ".png";
$clean_command = "rm /var/tmp/*csv";
exec($clean_command);
$data_query = "(SELECT 'matchNumber','" . $variable . "') UNION (SELECT matchNumber, ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4))" . $variable . " FROM " . $data_name . " WHERE teamNumber=" . $_GET['team'] . " INTO OUTFILE '" . $csv_path . "' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\\n')";
if (!mysql_query($data_query)) {
    echo($data_query);
    die(mysql_error());
}
$r_command = "Rscript /var/www/ScoutingPillow/r/crunch-column-rr.R " . $csv_path . " " . $png_path;
exec($r_command);
echo("<img src=" . $png_path . " />");
echo("</td>");
echo("</tr>");
?>