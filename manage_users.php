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
        <h3>Users</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Manage Users</h2>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db_query = mysql_query("SELECT * FROM users");
                        while ($record = mysql_fetch_array($db_query)) {
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
                            echo("<td scope=\"row\">");
                            echo("<a class=\"btn\" href=\"view_user.php?id=" . $record['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>View</a>");
                            if ($record['rank'] != 0) {
                                echo("<a class=\"btn\" href=\"delete_user.php?id=" . $record['id'] . "\" role=\"button\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>Remove</a>");
                            }
                            echo("</td>");
                            echo("</tr>");
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class ="page-header">
        <h3>Register</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Create User</h2>
        </div>
        <div class="panel-body">
            <form action="create_user.php" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="email-addon">@</span>
                    <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="email-addon">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="password-addon">*</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="password-addon">
                </div>
                <div class="radio">
                    <label><input type="radio" name="rank" value="1">Admin</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="rank" value="2">Data Analyst</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="rank" value="3">Scouter</label>
                </div>
                <br>
                <input type="submit" value="Create" class="btn">
            </form>
        </div>
    </div>
</div>
<?php
    include('footer.php');
?>