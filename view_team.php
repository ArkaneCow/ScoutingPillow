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
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Field
                        </th>
                        <th>
                            Value
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $table_name = $record['prefixName'] . "_prescout";
                    $columns_query = mysql_query("SHOW COLUMNS FROM " . $table_name);
                    if (!$columns_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($columns_query) > 0) {
                        $team_num = $_GET['team'];
                        $data_query = mysql_query("SELECT * FROM " . $table_name . " WHERE teamNumber=" . $team_num);
                        if (!$data_query) {
                            die(mysql_error());
                        }
                        if (mysql_num_rows($data_query)) {
                            $datum = mysql_fetch_array($data_query);
                            while ($row = mysql_fetch_assoc($columns_query)) {
                                echo("<tr>");
                                $key = $row['Field'];
                                echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                                if (strcmp($key, "pictures") == 0 && isset($datum[$key]) && $datum[$key] != '0') {
                                    $value = "<a href=\"" . $value . "\"><img src=\"" . $datum[$key] . "\" style=\"max-height: 350px;\" /></a>";
                                } else {
                                    $value = $datum[$key];
                                }
                                echo("<td scope=\"row\">" . $value . "</td>");
                                echo("</tr>");
                            }
                        }
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