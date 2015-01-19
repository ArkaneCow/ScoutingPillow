<?php
    session_start();
    include('config.php');
?>
<?php
    if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
        header('Location: index.php');
    }
?>
<?php
    include('header.php');
?>
<div class="container">
    <div class="page-header">
        <h3 class="panel-heading">Manage Events</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Manage Events</h2>
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
                            echo("<td scope=\"row\">" . $record['id'] . "</td>");
                            echo("<td scope=\"row\">" . $record['eventName'] . "</td>");
                            echo("<td scope=\"row\">");
                            echo("<a class=\"btn\" href=\"view_event.php?id=" . $record['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>View</a>");
                            echo("<a class=\"btn\" href=\"delete_event.php?id=" . $record['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>Delete</a>");
                            echo("</td>");
                            echo("</tr>");
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Create Event</h2>
        </div>
        <div class="panel-body">
            <form action="create_event.php" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="event-addon">+</span>
                    <input type="text" name="eventName" class="form-control" placeholder="Event Name" aria-describedby="event-addon">
                </div>
                <br>
                <input type="submit" value="Create Event" class="btn">
            </form>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>