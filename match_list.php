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
                        <th>Match #</th>
                        <th>Blue 1</th>
                        <th>Blue 2</th>
                        <th>Blue 3</th>
                        <th>Red 1</th>
                        <th>Red 2</th>
                        <th>Red 3</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db_query = mysql_query("SELECT * FROM " . $match_name);
                    $last_match = 0;
                    while ($match = mysql_fetch_array($db_query)) {
                        echo("<tr>");
                        echo("<td scope=\"row\">");
                        echo $match['id'];
                        if ($match['id'] > $last_match) {
                            $last_match = $match['id'];
                        }
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['blue1'] . "&match=" . $match['id'] . "&bot=4\" class=\"btn btn-primary\">" . $match['blue1'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['blue2'] . "&match=" . $match['id'] . "&bot=5\" class=\"btn btn-primary\">" . $match['blue2'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['blue3'] . "&match=" . $match['id'] . "&bot=6\" class=\"btn btn-primary\">" . $match['blue3'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['red1'] . "&match=" . $match['id'] . "&bot=1\" class=\"btn btn-danger\">" . $match['red1'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['red2'] . "&match=" . $match['id'] . "&bot=2\" class=\"btn btn-danger\">" . $match['red2'] . "</a>");
                        echo("</td>");
                        echo("<td scope=\"row\">");
                        echo("<a href=\"live_scout.php?id=" . $_GET['id'] . "&team=" . $match['red3'] . "&match=" . $match['id'] . "&bot=3\" class=\"btn btn-danger\">" . $match['red3'] . "</a>");
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