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
    <div class="page-header">
        <h3>Scouting Events</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Events</h2>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db_query = mysql_query("SELECT * FROM events");
                        while ($record = mysql_fetch_array($db_query)) {
                            echo("<tr>");
                            echo("<td>" . $record['id'] . "</td>");
                            echo("<td>" . $record['eventName'] . "</td>");
                            echo("<td>");
                            echo("<a href=\"pre_scout.php?id=" . $record['id'] . "\" class=\"btn\">Pre Scout</a>");
                            echo("<a href=\"live_scout.php?id=" . $record['id'] . "\" class=\"btn\">Live Scout</a>");
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