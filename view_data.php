<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
if (!isset($_GET['id'])) {
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
        <h3>View Raw Data</h3>
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
                        <?php
                        $table_name = $record['prefixName'] . "_prescout";
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $table_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        }
                        if (mysql_num_rows($columns_query) > 0) {
                            while ($row = mysql_fetch_assoc($columns_query)) {
                                echo("<th>" . $row['Field'] . "</th>");
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $table_query = mysql_query("SELECT * FROM " . $table_name);
                    if (!$table_query) {
                        die(mysql_error());
                    }
                    while ($datum = mysql_fetch_assoc($table_query)) {
                        echo("<tr>");
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $table_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        }
                        if (mysql_num_rows($columns_query) > 0) {
                            while ($row = mysql_fetch_assoc($columns_query)) {
                                $key = $row['Field'];
                                echo("<td scope=\"row\">" . $datum[$key] . "</td>");
                            }
                        }
                        echo("</tr>");
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Live Scouting Data</h2>
        </div>
        <div class="panel-body" style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <?php
                        $table_name = $record['prefixName'] . "_data";
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $table_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        }
                        if (mysql_num_rows($columns_query) > 0) {
                            while ($row = mysql_fetch_assoc($columns_query)) {
                                echo("<th>" . $row['Field'] . "</th>");
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $table_query = mysql_query("SELECT * FROM " . $table_name);
                    if (!$table_query) {
                        die(mysql_error());
                    }
                    while ($datum = mysql_fetch_assoc($table_query)) {
                        echo("<tr>");
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $table_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        }
                        if (mysql_num_rows($columns_query) > 0) {
                            while ($row = mysql_fetch_assoc($columns_query)) {
                                $key = $row['Field'];
                                echo("<td scope=\"row\">" . $datum[$key] . "</td>");
                            }
                        }
                        echo("</tr>");
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