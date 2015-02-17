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
        <h3>Registers</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Pending Registrations</h2>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $register_query = mysql_query("SELECT * FROM registers");
                    if (!$register_query) {
                        die(mysql_error());
                    }
                    while ($record = mysql_fetch_array($register_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        echo($record['id']);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo($record['email']);
                        echo("</td>");
                        echo("<td scope=\"row\">");
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
                        echo($role);
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"approve_register.php?id=" . $record['id'] . "\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-ok\" aria-hidden'\"true\"></span>Approve</a>");
                        echo("<a href=\"delete_register.php?id=" . $record['id'] . "\" class=\"btn btn-danger\"><span class=\"glyphicon glyphicon-remove\" aria-hidden'\"true\"></span>Deny</a>");
                        echo("</td>");
                        echo("<tr>");
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