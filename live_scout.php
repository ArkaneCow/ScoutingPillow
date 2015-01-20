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
    <?php
    $event_id = $_GET['id'];
    $db_query = mysql_query("SELECT * FROM events WHERE id=" . $event_id);
    if (mysql_num_rows($db_query) != 1) {
        header('Location: index.php');
    }
    $record = mysql_fetch_array($db_query);
    ?>
    <div class="page-header">
        <h3>Live Scouting</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
        <?php
        echo("<form action=\"live_submit.php?id=" . $_GET['id'] . "\" method=\"post\">");
        echo("<input type=\"hidden\" name=\"enteredBy\" value=\"" . $_SESSION['id'] . "\">");
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">General Info</h2>
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
                            <td class="col-md-10" scope="row">Match Number</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="1" min="0" max="10000" name="matchNumber"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Team Number</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10000" name="teamNumber"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Bot Number</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="1" min="1" max="6" name="yellowScored"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Dead Bot</td>
                            <td class="col-md-2" scope="row">
                                <div align="center" class="checkbox">
                                    <input type="checkbox" class="checkbox-field" style="position: relative;" name="isDead" value="1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Bot Show</td>
                            <td class="col-md-2" scope="row">
                                <div align="center" class="checkbox">
                                    <input type="checkbox" class="checkbox-field" style="position: relative;" checked="true" name="isShow" value="1">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
                            <td class="col-md-10" scope="row">Autonomous Start</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="1" min="1" max="10" name="start"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Scored Yellow Tote</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="3" name="yellowScored"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Manipulated Yellow Tote</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="3" name="yellowPossess"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Stacked Level 1 Yellow Tote</td>
                            <td class="col-md-2" scope="row">
                                <div align="center" class="checkbox">
                                    <input type="checkbox" class="checkbox-field" style="position: relative;" name="yellowStack0" value="1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Stacked Level 2 Yellow Tote</td>
                            <td class="col-md-2" scope="row">
                                <div align="center" class="checkbox">
                                    <input type="checkbox" class="checkbox-field" style="position: relative;" name="yellowStack1" value="1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Stacked Level 3 Yellow Tote</td>
                            <td class="col-md-2" scope="row">
                                <div align="center" class="checkbox">
                                    <input type="checkbox" class="checkbox-field" style="position: relative;" name="yellowStack2" value="1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Autonomous Recycling Containers Moved</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="autoContainerMoved"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Step Recycling Containers Moved</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="stepContainerMoved"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Mobility</td>
                            <td class="col-md-2" scope="row">
                                <div align="center" class="checkbox">
                                    <input type="checkbox" class="checkbox-field" style="position: relative;" name="mobility" value="1">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Manipulated Grey Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="greyToteMoved"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Autonomous Comments</td>
                            <td class="col-md-2" scope="row">
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-md-10" scope="row">Manipulated Grey Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="totePossess"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 1 Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="tote0"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 2 Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="tote1"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 3 Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="tote2"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 4 Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="tote3"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 5 Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="tote4"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 6 Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="tote5"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Manipulated Recycle Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="containerPossess"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 1 Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="container0"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 2 Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="container1"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 3 Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="container2"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 4 Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="container3"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 5 Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="container4"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 6 Containers</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="4" name="container5"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Noodles - Trash</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="noodleTrash"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Noodles - Landfill</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="noodleLand"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Noodles - Other</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="noodleOther"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 1 Coopertition Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="6" name="coopTote0"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 2 Coopertition Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="6" name="coopTote1"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 3 Coopertition Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="6" name="coopTote2"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Level 4 Coopertition Totes</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="6" name="coopTote3"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Pickup - Landfill</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="pickupLand"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Pickup - Human</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="pickupHuman"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Pickup - Other</td>
                            <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="20" name="pickupOther"></td>
                        </tr>
                        <tr>
                            <td class="col-md-10" scope="row">Teleop Comments</td>
                            <td class="col-md-2" scope="row">
                                <textarea class="form-control" rows="3" name="teleComments"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Submit Form</h2>
            </div>
            <div class="panel-body">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
    </form>
    <script type="text/javascript">
        (function () {
            var button, span, input, inputIndex;
            var inputArray = Array.prototype.slice.call(document.getElementsByTagName("input"), 0);
            for (inputIndex = 0; inputIndex < inputArray.length; inputIndex++) {
                input = inputArray[inputIndex];
                if (input.type.toLowerCase() !== "number")
                    continue;
                button = document.createElement("input");
                button.type = "button";
                button.className = "btn btn-danger";
                button.value = "\u2212";
                button.onclick = (function (inputElement) {
                    return function () {
                        if (!isNaN(parseInt(inputElement.value)))
                            inputElement.value = Math.max(parseInt(inputElement.value) - 1, inputElement.min);
                    };
                })(input);
                span = document.createElement("span");
                span.className = "input-group-btn";
                span.appendChild(button);
                input.parentNode.className = "input-group";
                input.parentNode.insertBefore(span, input);
                button = document.createElement("input");
                button.type = "button";
                button.className = "btn btn-success";
                button.value = "+";
                button.onclick = (function (inputElement) {
                    return function () {
                        if (!isNaN(parseInt(inputElement.value)) && parseInt(inputElement.value) < inputElement.max)
                            inputElement.value = parseInt(inputElement.value) + 1;
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