<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
if (!isset($_GET['id'])) {
    header('Location: view_events.php');
}
$field_query = mysql_query("SELECT * FROM events WHERE id=" . $_GET['id']);
if (mysql_num_rows($field_query) != 1) {
    header('Location: view_events.php');
}
$record = mysql_fetch_array($field_query);
$teams_name = $record['prefixName'] . "_teams";
$data_name = $record['prefixName'] . "_data";
$prescout_name = $record['prefixName'] . "_prescout"
?>
<?php
include('header.php');
?>
<script type="text/javascript" src="/js/jquery.tablesorter.js"></script> 
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#ranktable").tablesorter();
    }
    );
</script>
<div class="container">
    <div class="page-header">
        <h3>Team Rankings</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Team Contribution Rankings</h2>
        </div>
        <div class="panel-body">
            <table class="table tablesorter" id="ranktable">
                <thead>
                    <tr>
                        <th>Rank #</th>
                        <th>Team #</th>
                        <th>Avg Pts</th>
                        <th>Min Pts</th>
                        <th>Max Pts</th>
                        <th>Tote Pts</th>
                        <th>Container Pts</th>
                        <th>Human Pts</th>
                        <th>Landfill Pts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rank_count = 1;
                    $db_query = mysql_query("SELECT teamNumber, AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) AS avgScore, MIN((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) minScore, MAX((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) maxScore, AVG(2 * (tote0 + tote1 + tote2 + tote3 + tote4 + tote5)) toteScore, AVG(container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4) containerScore, AVG(pickupHuman * 2) humanScore, AVG(pickupLand * 2) landfillScore FROM " . $data_name . " GROUP BY teamNumber ORDER BY avgScore DESC");
                    while ($team = mysql_fetch_array($db_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        echo($rank_count);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo($team['teamNumber']);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['avgScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['minScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['maxScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['toteScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['containerScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['humanScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo(number_format(floatval($team['landfillScore']), 1));
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $team['teamNumber'] . "\" class=\"btn\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>View</a>");
                        echo("</td>");
                        echo("</tr>");
                        $rank_count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>
