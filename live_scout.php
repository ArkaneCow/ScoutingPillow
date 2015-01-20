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
                            <td class="col-md-6" scope="row">Scored Yellow Tote</td>
                            <td scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="3" name="yellowScored"></td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Manipulated Yellow Tote</td>
                            <td scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="3" name="yellowPossess"></td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Stacked Level 1 Yellow Tote</td>
                            <td scope="row">
                                <div align="center" class="checkbox">
                                    <label>
                                        <input type="checkbox" name="yellowStack0" value="1">
                                        Level 1
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Stacked Level 2 Yellow Tote</td>
                            <td scope="row">
                                <div align="center" class="checkbox">
                                    <label>
                                        <input type="checkbox" name="yellowStack1" value="1">
                                        Level 2
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Stacked Level 3 Yellow Tote</td>
                            <td scope="row">
                                <div align="center" class="checkbox">
                                    <label>
                                        <input type="checkbox" name="yellowStack2" value="1">
                                        Level 3
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Autonomous Containers Moved</td>
                            <td scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="autoContainerMoved"></td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Step Containers Moved</td>
                            <td scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="stepContainerMoved"></td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Mobility</td>
                            <td scope="row">
                                <div align="center" class="checkbox">
                                    <label>
                                        <input type="checkbox" name="mobility" value="1">
                                        Mobile
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Manipulated Grey Totes</td>
                            <td scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="6" name="greyToteMoved"></td>
                        </tr>
                        <tr>
                            <td class="col-md-6" scope="row">Autonomous Comments</td>
                            <td scope="row">
                                <textarea class="form-control" rows="3" name="autoComments"></textarea>
                            </td>
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