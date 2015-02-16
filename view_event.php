<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
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
        <h3>View Event</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Event Info</h2>
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
                    <tr>
                        <td scope="row">Name</td>
                        <td scope="row">
                            <?php
                            echo($record['eventName']);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Matches</td>
                        <td scope="row">
                            <?php
                            echo("<a href=\"view_matches.php?id=" . $record['id'] . "\" class=\"btn\">Matches</a>");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Teams</td>
                        <td scope="row">
                            <?php
                            echo("<a href=\"#\" class=\"btn\">Teams</a>");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row">Data</td>
                        <td scope="row">
                            <?php
                            echo("<a href=\"view_data.php?id=" . $record['id'] . "\" class=\"btn\">Raw Data</a>");
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> 
    </div>
</div>
<?php
include('footer.php');
?>