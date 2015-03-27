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
            <table class="table">
                <thead>
                    <tr>
                        <th>Match #</th>
                        <th><a href="#blue1" style="color: black;" >Blue 1</a></th>
                        <th><a href="#blue2" style="color: black;" >Blue 2</a></th>
                        <th><a href="#blue3" style="color: black;" >Blue 3</a></th>
                        <th><a href="#red1" style="color: black;" >Red 1</a></th>
                        <th><a href="#red2" style="color: black;" >Red 2</a></th>
                        <th><a href="#red3" style="color: black;" >Red 3</a></th>
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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Match Avg Pt Predictions</h2>
        </div>
        <div class="panel-body">
            <table class="table">
                <thread>
                    <th>Blue 1</th>
                    <th>Blue 2</th>
                    <th>Blue 3</th>
                    <th>Red 1</th>
                    <th>Red 2</th>
                    <th>Red 3</th>
                </thread>
                <tbody>
                    <tr>
                        <td scope="row">
                            <?php
                            $bluepredict1_query = mysql_query("SELECT AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['blue1']);
                            $bluepredict1_record = mysql_fetch_array($bluepredict1_query);
                            $bluepredict1_score = intval($bluepredict1_record['score']);
                            echo($bluepredict1_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $bluepredict2_query = mysql_query("SELECT AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['blue2']);
                            $bluepredict2_record = mysql_fetch_array($bluepredict2_query);
                            $bluepredict2_score = intval($bluepredict2_record['score']);
                            echo($bluepredict2_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $bluepredict3_query = mysql_query("SELECT AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['blue3']);
                            $bluepredict3_record = mysql_fetch_array($bluepredict3_query);
                            $bluepredict3_score = intval($bluepredict3_record['score']);
                            echo($bluepredict3_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $redpredict1_query = mysql_query("SELECT AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['red1']);
                            $redpredict1_record = mysql_fetch_array($redpredict1_query);
                            $redpredict1_score = intval($redpredict1_record['score']);
                            echo($redpredict1_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $redpredict2_query = mysql_query("SELECT AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['red2']);
                            $redpredict2_record = mysql_fetch_array($redpredict2_query);
                            $redpredict2_score = intval($redpredict2_record['score']);
                            echo($redpredict2_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $redpredict3_query = mysql_query("SELECT AVG((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['red3']);
                            $redpredict3_record = mysql_fetch_array($redpredict3_query);
                            $redpredict3_score = intval($redpredict3_record['score']);
                            echo($redpredict3_score);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="container">
                <thead>
                <th>Blue Predict Total</th>
                <th>Red Predict Total</th>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">
                            <?php
                            echo($bluepredict1_score + $bluepredict2_score + $bluepredict3_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            echo($redpredict1_score + $redpredict2_score + $redpredict3_score);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Match Results</h2>
        </div>
        <div class="panel-body">
            <table class="table">
                <thread>
                    <th>Blue 1</th>
                    <th>Blue 2</th>
                    <th>Blue 3</th>
                    <th>Red 1</th>
                    <th>Red 2</th>
                    <th>Red 3</th>
                </thread>
                <tbody>
                    <tr>
                        <td scope="row">
                            <?php
                            $blue1_query = mysql_query("SELECT ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['blue1'] . " AND matchNumber=" . $_GET['match']);
                            $blue1_record = mysql_fetch_array($blue1_query);
                            $blue1_score = intval($blue1_record['score']);
                            echo($blue1_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $blue2_query = mysql_query("SELECT ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['blue2'] . " AND matchNumber=" . $_GET['match']);
                            $blue2_record = mysql_fetch_array($blue2_query);
                            $blue2_score = intval($blue2_record['score']);
                            echo($blue2_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $blue3_query = mysql_query("SELECT ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['blue3'] . " AND matchNumber=" . $_GET['match']);
                            $blue3_record = mysql_fetch_array($blue3_query);
                            $blue3_score = intval($blue3_record['score']);
                            echo($blue3_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $red1_query = mysql_query("SELECT ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['red1'] . " AND matchNumber=" . $_GET['match']);
                            $red1_record = mysql_fetch_array($red1_query);
                            $red1_score = intval($red1_record['score']);
                            echo($red1_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $red2_query = mysql_query("SELECT ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['red2'] . " AND matchNumber=" . $_GET['match']);
                            $red2_record = mysql_fetch_array($red2_query);
                            $red2_score = intval($red2_record['score']);
                            echo($red2_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            $red3_query = mysql_query("SELECT ((2*(tote0 + tote1 + tote2 + tote3 + tote4 + tote5) + 6*noodleTrash + container0*1*4 + container1*2*4 + container2*3*4 + container3*4*4 + container4*5*4 + container5*6*4)) score FROM " . $data_name . " WHERE teamNumber=" . $teams_record['red3'] . " AND matchNumber=" . $_GET['match']);
                            $red3_record = mysql_fetch_array($red3_query);
                            $red3_score = intval($red3_record['score']);
                            echo($red3_score);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="container">
                <thead>
                <th>Blue Total</th>
                <th>Red Total</th>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">
                            <?php
                            echo($blue1_score + $blue2_score + $blue3_score);
                            ?>
                        </td>
                        <td scope="row">
                            <?php
                            echo($red1_score + $red2_score + $red3_score);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default" id="blue1">
        <div class="panel-heading">
            <h2 class="panel-title">Blue 1</h2>
        </div>
        <div class="panel-body">
            <table class="table">
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
            <table class="table">
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
            <table class="table">
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
            <table class="table">
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
            <table class="table">
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
            <table class="table">
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