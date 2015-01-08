<?php
    session_start();
    include('config.php');
?>
<?php
    if (!isset($_SESSION['user'])) {
        header("Location: login_page.php");
    }
?>
<?php
    include('header.php');
?>

<div class="container">
    <div class="page-header">
        <h3>Dashboard</h3>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#home" role="tab" data-toggle="tab">Home</a></li>
        <?php
            if ($_SESSION['rank'] <= 1) {
                //user and event tabs
                echo("<li><a href=\"#users\" role=\"tab\" data-toggle=\"tab\">Users</a></li>");
                echo("<li><a href=\"#events\" role=\"tab\" data-toggle=\"tab\">Events</a></li>");
            }
            if ($_SESSION['rank'] <= 2) {
                //data tab
                echo("<li><a href=\"#data\" role=\"tab\" data-toggle=\"tab\">Data</a></li>");
            }
            if ($_SESSION['rank'] <= 3) {
                //scouting tab
                echo("<li><a href=\"#scout\" role=\"tab\" data-toggle=\"tab\">Scout</a></li>");
            }
        ?>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="home">
            
        </div>
        <?php
            if ($_SESSION['rank'] <= 1) {
                //user and event tabs
                echo("<div class=\"tab-pane\" id=\"users\">");
                echo("</div>");
                echo("<div class=\"tab-pane\" id=\"events\">");
                echo("</div>");
            }
            if ($_SESSION['rank'] <= 2) {
                //data tab
                echo("<div class=\"tab-pane\" id=\"data\">");
                echo("</div>");
            }
            if ($_SESSION['rank'] <= 3) {
                //scouting tab
                echo("<div class=\"tab-pane\" id=\"scout\">");
                echo("</div>");
            }
        ?>
    </div>
</div>
<?php
    include('footer.php');
?>