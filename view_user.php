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
        <h3>
            View User
        </h3>
    </div>
    <?php
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $db_query = mysql_query("SELECT * FROM users WHERE id=" . $user_id);
        if (mysql_num_rows($db_query) == 1) {
            $record = mysql_fetch_array($db_query);
            echo("<div class=\"panel panel-default\">");
            echo("<div class=\"panel-heading\">");
            echo("<h2 class=\"panel-title\">User Info</h2>");
            echo("</div>");
            echo("<div class=\"panel-body\">");
            echo("<table class=\"table\">");
            echo("<thead>");
            echo("<tr>");
            echo("<th>#</th>");
            echo("<th>Email</th>");
            echo("<th>Role</th>");
            if ($_SESSION['rank'] <= 1 || $_SESSION['id'] == $_GET['id']) {
                echo("<th>Password</th>");
                echo("<th>Google</th>");
            }
            echo("</tr>");
            echo("</thead>");
            echo("<tbody>");
            echo("<tr>");
            echo("<td scope=\"row\">" . $record['id'] . "</td>");
            echo("<td scope=\"row\">" . $record['email'] . "</td>");
            $rank = $record['rank'];
            $role = "";
            if ($rank == 0) {
                $role = "Overlord";
            } else if ($rank == 1) {
                $role = "Admin";
            } else if ($rank == 2) {
                $role = "Data Analyst";
            } else if ($rank == 3) {
                $role = "Scouter";
            }
            echo("<td scope=\"row\">" . $role . "</td>");
            if ($_SESSION['rank'] <= 1 || $_SESSION['id'] == $_GET['id']) {
                echo("<td scope=\"row\">");
                echo("<button type=\"button\" class=\"btn btn-warning\">");
                echo("<span class=\"glyphicon glyphicon-asterisk\" aria-hidden'\"true\"></span>Change Password");
                echo("</button>");
                echo("</td>");
                echo("<td scope=\"row\">");
                if (isset($record['openid'])) {
                    echo("<button type=\"button\" class=\"btn btn-success disabled\">");
                    echo("<span class=\"glyphicon glyphicon-ok\" aria-hidden'\"true\"></span>Connected");
                    echo("</button>");
                } else {
                    echo("<button type=\"button\" class=\"btn btn-danger\">");
                    echo("<span class=\"glyphicon glyphicon-plus\" aria-hidden'\"true\"></span>Connect Google");
                    echo("</button>");
                }
                echo("</td>");
            }
            echo("</tr>");
            echo("</tbody>");
            echo("</table>");
            echo("</div>");
            echo("</div>");
            if ($_SESSION['rank'] <= 1 || $_SESSION['id'] == $_GET['id']) {
                echo("<div class=\"panel panel-default\">");
                echo("<div class=\"panel-heading\">");
                echo("<h2 class=\"panel-title\">Event Info</h2>");
                echo("</div>");
                echo("<div class=\"panel-body\">");

                echo("</div>");
                echo("</div>");
            }
        }
    }
    ?>
</div>
<?php
include('footer.php');
?>