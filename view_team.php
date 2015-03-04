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
    <?php
    //TODO: move to new php file and use iframe + button to generate statistics request and sanitize every get/post
    if ($_SESSION['rank'] < 3) {
        ?>
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
                            echo("$(window).load(function() {"
                                    . "var gen_button = $('<button/>', {"
                                    . "text: 'Generate',"
                                    . "class: 'btn',"
                                    . "id: 'generate_" . $variable . "',"
                                    . "click: function() { $('#stat_" . $variable . "').load('crunch_column.php?id=" . $_GET['id'] . "&team=" . $team_num . "&field=" . $variable . "'); }"
                                    . "});"
                                    . "});\n"
                                    . "$('#stat_" . $variable . "').append(gen_btn);");
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