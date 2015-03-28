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
$prescout_name = $record['prefixName'] . "_prescout"
?>
<?php
include('header.php');
?>
<div class="container">
    <div class="page-header">
        <h3>Team List</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Team List</h2>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Team #</th>
                        <th>Team Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db_query = mysql_query("SELECT * FROM " . $teams_name);
                    while ($team = mysql_fetch_array($db_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        echo($team['teamNumber']);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo($team['teamName']);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $team['teamNumber'] . "\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>View</a>");
                        $prescout_query = mysql_query("SELECT * FROM " . $prescout_name . " WHERE teamNumber=" . $team['teamNumber']);
                        if (mysql_num_rows($prescout_query) > 0) {
                            echo("<a href=\"pre_scout.php?id=" . $_GET['id'] . "&team=" . $team['teamNumber'] . "\" class=\"btn btn-success\">Prescout</a>");
                        } else {
                            echo("<a href=\"pre_scout.php?id=" . $_GET['id'] . "&team=" . $team['teamNumber'] . "\" class=\"btn btn-danger\">Prescout</a>");
                        }
                        echo("</td>");
                        echo("</tr>");
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if ($_SESSION['rank'] < 2) {
        ?>
        <?php
        echo("<form action=\"add_team.php?id=" . $_GET['id'] . "\" method=\"post\">");
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Add Team</h2>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Team #</th>
                            <th>Team Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">
                                <input type="number" min="1" max="9999" value="1" class="form-control number-field" name="teamNumber" />
                            </td><td scope="row">
                                <input type="text" class="form-control number-field" name="teamName" />
                            </td>
                            <td>
                                <input type="submit" value="Add" class="btn btn-primary" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        echo("</form>");
        ?>
        <?php
    } // end add match block
    ?>
</div>
<?php
include('footer.php');
?>
