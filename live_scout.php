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
<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
}
?>
<div class="container">
    <div class="page-header">
        <h3>Live Scouting</h3>
    </div>
    <?php
    $event_id = $_GET['id'];
    $db_query = mysql_query("SELECT * FROM events WHERE id=" . $event_id);
    if (mysql_num_rows($db_query) != 1) {
        header('Location: index.php');
    }
    $record = mysql_fetch_array($db_query);
    ?>
    <form action="live_submit.php">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Autonomous</h2>
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
                            <td scope="row">Scored Yellow Tote</td>
                            <td scope="row"><input type="number" class="form-control" value="0" min="0" max="3" name="scoredYellow"></td>
                        </tr>
                        <tr>
                            <td scope="row">Manipulated Yellow Tote</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Stacked Level 1 Yellow Tote</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Stacked Level 2 Yellow Tote</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Stacked Level 3 Yellow Tote</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Containers Scored</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Mobility</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Manipulated Grey Totes</td>
                            <td scope="row"></td>
                        </tr>
                        <tr>
                            <td scope="row">Autonomous Comments</td>
                            <td scope="row"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Teleop</h2>
            </div>
            <div class="panel-body">
                
            </div>
        </div>
    </form>
    <script type="text/javascript">
        (function () {
            var button, span, input, inputIndex;
            var inputArray = Array.prototype.slice.call(document.getElementsByTagName("input"), 0);
            for (inputIndex = 0; inputIndex < inputArray.length; inputIndex++) {
                input = inputArray[inputIndex];
                if (input.type.toLowerCase() !== "number") continue;
                button = document.createElement("input");
                button.type = "button";
                button.className = "btn btn-default";
                button.value = "\u2212";
                button.onclick = (function (inputElement) {
                    return function () {
                        if (!isNaN(parseInt(inputElement.value))) inputElement.value = Math.max(parseInt(inputElement.value) - 1, 0);
                    };
                })(input);
                span = document.createElement("span");
                span.className = "input-group-btn";
                span.appendChild(button);
                input.parentNode.className = "input-group";
                input.parentNode.insertBefore(span, input);
                button = document.createElement("input");
                button.type = "button";
                button.className = "btn btn-default";
                button.value = "+";
                button.onclick = (function (inputElement) {
                    return function () {
                        if (!isNaN(parseInt(inputElement.value)) && parseInt(inputElement.value) < inputElement.max) inputElement.value = parseInt(inputElement.value) + 1;
                    };
                })(input);
                span = document.createElement("span");
                span.className = "input-group-btn";
                span.appendChild(button);
                input.parentNode.insertBefore(span, input.nextSibling);
            }
        })();
    </script>
</div>
<?php
include('footer.php');
?>