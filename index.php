<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: login_page.php');
}
?>
<?php
include('header.php');
?>

<div class="container">
    <div class="page-header">
        <h3>Dashboard</h3>
    </div>
    <?php
    if ($_SESSION['rank'] <= 1) {
        echo("<div class=\"panel panel-default\">");
        echo("<div class=\"panel-heading\">");
        echo("<h2 class=\"panel-title\">Users</h2>");
        echo("</div>");
        echo("<div class=\"panel-body\">");
        echo("<a class=\"btn btn-lg\" href=\"manage_users.php\" role=\"button\">Manage Users</a>");
        echo("<a class=\"btn btn-lg\" href=\"manage_registers.php\" role=\"button\">Registrations</a>");
        echo("</div>");
        echo("</div>");
        echo("<div class=\"panel panel-default\">");
        echo("<div class=\"panel-heading\">");
        echo("<h2 class=\"panel-title\">Events</h2>");
        echo("</div>");
        echo("<div class=\"panel-body\">");
        echo("<a class=\"btn btn-lg\" href=\"manage_events.php\" role=\"button\">Manage Events</a>");
        echo("</div>");
        echo("</div>");
    }
    if ($_SESSION['rank'] <= 3) {
        echo("<div class=\"panel panel-default\">");
        echo("<div class=\"panel-heading\">");
        echo("<h2 class=\"panel-title\">Scouting</h2>");
        echo("</div>");
        echo("<div class=\"panel-body\">");
        echo("<a class=\"btn btn-lg\" href=\"view_events.php\" role=\"button\">View Events</a>");
        echo("</div>");
        echo("</div>");
    }
    ?>
</div>
<?php
include('footer.php');
?>