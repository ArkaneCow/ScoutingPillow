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
$teams_name = $record['prefixName'] . "_teams";
?>
<?php
include('header.php');
?>
<div class="container">
    <div class="page-header">
        <h3>Team List</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Team List</h2>
        </div>
        <div class="panel-body">
            <table class="container">
                <thead>
                    <tr>
                        <th>Team #</th>
                        <th>Team Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db_query = mysql_query("SELECT * FROM " . $teams_name);
                    while ($match = mysql_fetch_array($db_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        
                        echo("</td>");
                        echo("</tr>");
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if ($_SESSION['rank'] < 2) {
        ?>
        <?php
        echo("<form action=\"add_match.php?id=" . $_GET['id'] . "\" method=\"post\">");
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Add Match</h2>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Match #</th>
                            <th>Red 1</th>
                            <th>Red 2</th>
                            <th>Red 3</th>
                            <th>Blue 1</th>
                            <th>Blue 2</th>
                            <th>Blue 3</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">
                                <input type="number" min="1" max="9999" value="<?php echo($last_match + 1); ?>" class="form-control number-field" name="match" />
                            </td>
                            <td scope="row">
                                <input type="number" min="1" max="9999" class="form-control number-field" name="red1" />
                            </td>
                            <td scope="row">
                                <input type="number" min="1" max="9999" class="form-control number-field" name="red2" />
                            </td>
                            <td scope="row">
                                <input type="number" min="1" max="9999" class="form-control number-field" name="red3" />
                            </td>
                            <td scope="row">
                                <input type="number" min="1" max="9999" class="form-control number-field" name="blue1" />
                            </td>
                            <td scope="row">
                                <input type="number" min="1" max="9999" class="form-control number-field" name="blue2" />
                            </td>
                            <td scope="row">
                                <input type="number" min="1" max="9999" class="form-control number-field" name="blue3" />
                            </td>
                            <td>
                                <input type="submit" value="Add" class="btn btn-primary" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
        echo("</form>");
    ?>
        <?php
    } // end add match block
    ?>
</div>
<?php
include('footer.php');
?>