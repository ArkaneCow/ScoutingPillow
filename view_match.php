<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
if (!isset($_GET['id']) || !isset($_GET['match'])) {
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
    $matches_name = $record['prefixName'] . "_matches";
    $data_name = $record['prefixName'] . "_data";
    ?>
    <div class="page-header">
        <h3>View Match</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Match Participants</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Match #</th>
                        <th>Blue 1</th>
                        <th>Blue 2</th>
                        <th>Blue 3</th>
                        <th>Red 1</th>
                        <th>Red 2</th>
                        <th>Red 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $teams_query = mysql_query("SELECT * FROM " . $matches_name . " WHERE id=" . $_GET['match']);
                    if (!$teams_query) {
                        die(mysql_error());
                    }
                    $teams_record = mysql_fetch_array($teams_query);
                    echo("<tr>");
                    echo("<td scope=\"row\">");
                    echo($teams_record['id']);
                    echo("</td>");
                    echo("<td scope=\"row\">");
                    echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $teams_record['blue1'] . "\" class=\"btn btn-primary\" style=\"min-width: 70px;\">" . $teams_record['blue1'] . "</a>");
                    echo("</td>");
                    echo("<td scope=\"row\">");
                    echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $teams_record['blue2'] . "\" class=\"btn btn-primary\" style=\"min-width: 70px;\">" . $teams_record['blue2'] . "</a>");
                    echo("</td>");
                    echo("<td scope=\"row\">");
                    echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $teams_record['blue3'] . "\" class=\"btn btn-primary\" style=\"min-width: 70px;\">" . $teams_record['blue3'] . "</a>");
                    echo("</td>");
                    echo("<td scope=\"row\">");
                    echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $teams_record['red1'] . "\" class=\"btn btn-danger\" style=\"min-width: 70px;\">" . $teams_record['red1'] . "</a>");
                    echo("</td>");
                    echo("<td scope=\"row\">");
                    echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $teams_record['red2'] . "\" class=\"btn btn-danger\" style=\"min-width: 70px;\">" . $teams_record['red2'] . "</a>");
                    echo("</td>");
                    echo("<td scope=\"row\">");
                    echo("<a href=\"view_team.php?id=" . $_GET['id'] . "&team=" . $teams_record['red3'] . "\" class=\"btn btn-danger\" style=\"min-width: 70px;\">" . $teams_record['red3'] . "</a>");
                    echo("</td>");
                    echo("<tr>");
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="blue1">
        <div class="panel-heading">
            <h2 class="panel-title">Blue 1</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_query = mysql_query("SELECT * FROM " . $data_name . " WHERE matchNumber=" . $_GET['match'] . " AND teamNumber=" . $teams_record['blue1']);
                    if (!$data_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($data_query)) {
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        } $datum = mysql_fetch_array($data_query);
                        while ($row = mysql_fetch_assoc($columns_query)) {
                            echo("<tr>");
                            $key = $row['Field'];
                            echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                            $value = $datum[$key];
                            echo("<td scope=\"row\">" . $value . "</td>");
                            echo("</tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="blue2">
        <div class="panel-heading">
            <h2 class="panel-title">Blue 2</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_query = mysql_query("SELECT * FROM " . $data_name . " WHERE matchNumber=" . $_GET['match'] . " AND teamNumber=" . $teams_record['blue2']);
                    if (!$data_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($data_query)) {
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        } $datum = mysql_fetch_array($data_query);
                        while ($row = mysql_fetch_assoc($columns_query)) {
                            echo("<tr>");
                            $key = $row['Field'];
                            echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                            $value = $datum[$key];
                            echo("<td scope=\"row\">" . $value . "</td>");
                            echo("</tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="blue3">
        <div class="panel-heading">
            <h2 class="panel-title">Blue 3</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_query = mysql_query("SELECT * FROM " . $data_name . " WHERE matchNumber=" . $_GET['match'] . " AND teamNumber=" . $teams_record['blue3']);
                    if (!$data_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($data_query)) {
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        } $datum = mysql_fetch_array($data_query);
                        while ($row = mysql_fetch_assoc($columns_query)) {
                            echo("<tr>");
                            $key = $row['Field'];
                            echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                            $value = $datum[$key];
                            echo("<td scope=\"row\">" . $value . "</td>");
                            echo("</tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="red1">
        <div class="panel-heading">
            <h2 class="panel-title">Red 1</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_query = mysql_query("SELECT * FROM " . $data_name . " WHERE matchNumber=" . $_GET['match'] . " AND teamNumber=" . $teams_record['red1']);
                    if (!$data_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($data_query)) {
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        } $datum = mysql_fetch_array($data_query);
                        while ($row = mysql_fetch_assoc($columns_query)) {
                            echo("<tr>");
                            $key = $row['Field'];
                            echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                            $value = $datum[$key];
                            echo("<td scope=\"row\">" . $value . "</td>");
                            echo("</tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="red2">
        <div class="panel-heading">
            <h2 class="panel-title">Red 2</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_query = mysql_query("SELECT * FROM " . $data_name . " WHERE matchNumber=" . $_GET['match'] . " AND teamNumber=" . $teams_record['red2']);
                    if (!$data_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($data_query)) {
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        } $datum = mysql_fetch_array($data_query);
                        while ($row = mysql_fetch_assoc($columns_query)) {
                            echo("<tr>");
                            $key = $row['Field'];
                            echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                            $value = $datum[$key];
                            echo("<td scope=\"row\">" . $value . "</td>");
                            echo("</tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="red3">
        <div class="panel-heading">
            <h2 class="panel-title">Red 3</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_query = mysql_query("SELECT * FROM " . $data_name . " WHERE matchNumber=" . $_GET['match'] . " AND teamNumber=" . $teams_record['red3']);
                    if (!$data_query) {
                        die(mysql_error());
                    }
                    if (mysql_num_rows($data_query)) {
                        $columns_query = mysql_query("SHOW COLUMNS FROM " . $data_name);
                        if (!$columns_query) {
                            die(mysql_error());
                        } $datum = mysql_fetch_array($data_query);
                        while ($row = mysql_fetch_assoc($columns_query)) {
                            echo("<tr>");
                            $key = $row['Field'];
                            echo("<td scope=\"row\">" . $row['Field'] . "</td>");
                            $value = $datum[$key];
                            echo("<td scope=\"row\">" . $value . "</td>");
                            echo("</tr>");
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