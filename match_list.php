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
                        <th>Match Number</th>
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
                        echo $match['red1'];
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo $match['red2'];
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo $match['red3'];
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo $match['blue1'];
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo $match['blue2'];
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo $match['blue3'];
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