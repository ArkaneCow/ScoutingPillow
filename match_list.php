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
$match_name = $record['prefixName'] . "_matches";
?>
<?php
include('header.php');
?>
<div class="container">
    <div class="page-header">
        <h3>Match List</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Match List</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Match #</th>
                        <th>Red 1</th>
                        <th>Red 2</th>
                        <th>Red 3</th>
                        <th>Blue 1</th>
                        <th>Blue 2</th>
                        <th>Blue 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db_query = mysql_query("SELECT * FROM " . $match_name);
                    while ($match = mysql_fetch_array($db_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        echo $match['id'];
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['red1'] . "&match=" . $match['id'] . "\" class=\"btn btn-danger\">" . $match['red1'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['red2'] . "&match=" . $match['id'] . "\" class=\"btn btn-danger\">" . $match['red2'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['red3'] . "&match=" . $match['id'] . "\" class=\"btn btn-danger\">" . $match['red3'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['blue1'] . "&match=" . $match['id'] . "\" class=\"btn btn-primary\">" . $match['blue1'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['blue2'] . "&match=" . $match['id'] . "\" class=\"btn btn-primary\">" . $match['blue2'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['blue3'] . "&match=" . $match['id'] . "\" class=\"btn btn-primary\">" . $match['blue3'] . "</a>");
                        echo("</td>");
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