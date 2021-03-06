<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user']) || $_SESSION['rank'] > 2) {
    header('Location: index.php');
}
if (!isset($_GET['id']) || !isset($_GET['team'])) {
    header('Location: index.php');
}
?>
<?php
include('header.php');
?>
<div class="container">
    <?php
    $event_id = $_GET['id'];
    $db_query = mysql_query("SELECT * FROM events WHERE id=" . $event_id);
    if (mysql_num_rows($db_query) != 1) {
        header('Location: index.php');
    }
    $record = mysql_fetch_array($db_query);
    ?>
    <div class="page-header">
        <?php
        $team_table = $record['prefixName'] . "_teams";
        $match_table = $record['prefixName'] . "_matches";
        $team_query = mysql_query("SELECT * FROM " . $team_table . " WHERE teamNumber=" . $_GET['team']);
        if (!$team_query) {
            die(mysql_error());
        }
        $team_name = mysql_fetch_array($team_query);
        echo("<h3>" . $team_name['teamName'] . "</h3>");
        ?>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Pre Scouting Data</h2>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <?php
            $table_name = $record['prefixName'] . "_prescout";
            $team_num = $_GET['team'];
            $data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE teamNumber=" . $team_num);
            if (!$data_query) {
                die(mysql_error());
            }
            while ($datum = mysql_fetch_array($data_query)) {
                echo("<table class=\"table\">");
                echo("<thead>");
                echo("<tr>");
                echo("<th>Field</th>");
                echo("<th>Value</th>");
                echo("</tr>");
                echo("</thead>");
                echo("<tbody>");
                $columns_query = mysql_query("SHOW COLUMNS FROM " . $table_name);
                if (!$columns_query) {
                    die(mysql_error());
                }
                while ($row = mysql_fetch_assoc($columns_query)) {
                    echo("<tr>");
                    $key = $row['Field'];
                    echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                    if (strcmp($key, "pictures") == 0 && isset($datum[$key]) && $datum[$key] != '0') {
                        $value = "<a href=\"" . $datum[$key] . "\"><img src=\"" . $datum[$key] . "\" style=\"max-height: 350px;\" /></a>";
                    } else {
                        $value = $datum[$key];
                    }
                    echo("<td scope=\"row\">" . $value . "</td>");
                    echo("</tr>");
                }
                echo("</tbody>");
                echo("</table>");
            }
            ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                Team Matches
            </h2>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Match #</th>
                        <th>Blue 1</th>
                        <th>Blue 2</th>
                        <th>Blue 3</th>
                        <th>Red 1</th>
                        <th>Red 2</th>
                        <th>Red 3</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $match_query = mysql_query("SELECT * FROM " . $match_table . " WHERE red1=" . $team_num . " OR red2=" . $team_num . " OR red3=" . $team_num . " OR blue1=" . $team_num . " OR blue2=" . $team_num . " OR blue3=" . $team_num);
                    if (!$match_query) {
                        die(mysql_error());
                    }
                    while ($match_record = mysql_fetch_array($match_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        echo($match_record['id']);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $event_id . "&team=" . $match_record['blue1'] . "\" class=\"btn btn-primary\" style=\"min-width: 70px;\">" . $match_record['blue1'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $event_id . "&team=" . $match_record['blue2'] . "\" class=\"btn btn-primary\" style=\"min-width: 70px;\">" . $match_record['blue2'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $event_id . "&team=" . $match_record['blue3'] . "\" class=\"btn btn-primary\" style=\"min-width: 70px;\">" . $match_record['blue3'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $event_id . "&team=" . $match_record['red1'] . "\" class=\"btn btn-danger\" style=\"min-width: 70px;\">" . $match_record['red1'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $event_id . "&team=" . $match_record['red2'] . "\" class=\"btn btn-danger\" style=\"min-width: 70px;\">" . $match_record['red2'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_team.php?id=" . $event_id . "&team=" . $match_record['red3'] . "\" class=\"btn btn-danger\" style=\"min-width: 70px;\">" . $match_record['red3'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"view_match.php?id=" . $event_id . "&match=" . $match_record['id'] . "\" class=\"btn\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>View</a>");
                        echo("</td>");
                        echo("</tr>");
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if ($_SESSION['rank'] < 3) {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">
                    Summary Statistics
                </h2>
            </div>
            <div class="panel-body" style="overflow-x: auto;">
                <table class="table">
                    <thead>
                    <th>Field</th>
                    <th>Data</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">Total Point Contribution</td>
                            <td scope="row">
                                <?php
                                $variable = "total_score";
                                echo("<div id=stat_" . $variable . ">");
                                echo("<script type=\"text/javascript\">");
                                echo("$(document).ready(function() {"
                                . "var gen_button = $('<button/>', {"
                                . "text: 'Generate',"
                                . "class: 'btn',"
                                . "id: 'generate_" . $variable . "',"
                                . "click: function() { $('#stat_" . $variable . "').load('crunch_score.php?id=" . $_GET['id'] . "&team=" . $team_num . "'); }"
                                . "});"
                                . "$('#stat_" . $variable . "').append(gen_button);"
                                . "});");
                                echo("</script>");
                                echo("</div>");
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">Tote Points</td>
                            <td scope="row">
                                <?php
                                $variable = "tote_score";
                                echo("<div id=stat_" . $variable . ">");
                                echo("<script type=\"text/javascript\">");
                                echo("$(document).ready(function() {"
                                . "var gen_button = $('<button/>', {"
                                . "text: 'Generate',"
                                . "class: 'btn',"
                                . "id: 'generate_" . $variable . "',"
                                . "click: function() { $('#stat_" . $variable . "').load('crunch_tote.php?id=" . $_GET['id'] . "&team=" . $team_num . "'); }"
                                . "});"
                                . "$('#stat_" . $variable . "').append(gen_button);"
                                . "});");
                                echo("</script>");
                                echo("</div>");
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">Container Points</td>
                            <td scope="row">
                                <?php
                                $variable = "container_score";
                                echo("<div id=stat_" . $variable . ">");
                                echo("<script type=\"text/javascript\">");
                                echo("$(document).ready(function() {"
                                . "var gen_button = $('<button/>', {"
                                . "text: 'Generate',"
                                . "class: 'btn',"
                                . "id: 'generate_" . $variable . "',"
                                . "click: function() { $('#stat_" . $variable . "').load('crunch_container.php?id=" . $_GET['id'] . "&team=" . $team_num . "'); }"
                                . "});"
                                . "$('#stat_" . $variable . "').append(gen_button);"
                                . "});");
                                echo("</script>");
                                echo("</div>");
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Live Scouting Statistics</h2>
            </div>
            <div class="panel-body" style="overflow-x: auto;">
                <table class="table">
                    <thead>
                    <th>Field</th>
                    <th>Data</th>
                    </thead>
                    <tbody>
                        <?php
                        $data_name = $record['prefixName'] . "_data";
                        $team_num = $_GET['team'];
                        $data_columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$data_columns_query) {
                            die(mysql_error());
                        }
                        $ignore_columns = array("id", "enteredBy", "matchNumber", "teamNumber", "botNumber", "isDead", "isShow", "autoComments", "mobility", "teleComments", "start", "totePossess");
                        while ($var = mysql_fetch_assoc($data_columns_query)) {
                            $variable = $var['Field'];
                            $skip = false;
                            foreach ($ignore_columns as $ignore_item) {
                                if (strcmp($ignore_item, $variable) == 0) {
                                    $skip = true;
                                }
                            }
                            if ($skip) {
                                continue;
                            }
                            echo("<tr>");
                            echo("<td scope=\"row\">");
                            echo($variable);
                            echo("</td>");
                            echo("<td scope=\"row\">");
                            echo("<div id=stat_" . $variable . ">");
                            echo("<script type=\"text/javascript\">");
                            echo("$(document).ready(function() {"
                            . "var gen_button = $('<button/>', {"
                            . "text: 'Generate',"
                            . "class: 'btn',"
                            . "id: 'generate_" . $variable . "',"
                            . "click: function() { $('#stat_" . $variable . "').load('crunch_column.php?id=" . $_GET['id'] . "&team=" . $team_num . "&field=" . $variable . "'); }"
                            . "});"
                            . "$('#stat_" . $variable . "').append(gen_button);"
                            . "});");
                            echo("</script>");
                            echo("</div>");
                            echo("</td>");
                            echo("</tr>");
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    } //end live scouting statistics
    ?>
</div>
<?php
include('footer.php');
?>