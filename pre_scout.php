<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
if (!isset($_GET['id'])) {
    header('Location: index.php');
}
?>
<?php
include('header.php');
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
        <h3>Pre Scouting</h3>
        <br>
        <h4>
            <?php
            echo($record['eventName']);
            ?>
        </h4>
    </div>
    <?php
    echo("<form action=\"pre_submit.php?id=" . $_GET['id'] . "\" method=\"post\" enctype=\"multipart/form-data\">");
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Pre Scouting</h2>
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
                        <td class="col-md-10" scope="row">Team Number</td>
                        <td class="col-md-2" scope="row">
                            <?php
                            if (isset($_GET['team'])) {
                                echo("<input type=\"number\" class=\"form-control number-field\" value=\"" . $_GET['team'] . "\" min=\"0\" max=\"10000\" name=\"teamNumber\">");
                            } else {
                                echo("<input type=\"number\" class=\"form-control number-field\" value=\"0\" min=\"0\" max=\"10000\" name=\"teamNumber\">");
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Talked To</td>
                        <td class="col-md-2" scope="row"><input type="text" name="talkedTo" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Primary/Secondary Goals</td>
                        <td class="col-md-2" scope="row">
                            <textarea class="form-control" rows="3" name="goals"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Manipulator</td>
                        <td class="col-md-2" scope="row"><input type="text" name="manipulator" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Wheels</td>
                        <td class="col-md-2" scope="row"><input type="text" name="wheels" class="form-control"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Autonomous Functionality</td>
                        <td class="col-md-2" scope="row">
                            <div align="center" class="checkbox">
                                <input type="checkbox" class="checkbox-field" style="position: relative;" name="auto" value="1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Autonomous Strategy</td>
                        <td class="col-md-2" scope="row">
                            <textarea class="form-control" rows="3" name="autoStrategy"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Autonomous Mobility</td>
                        <td class="col-md-2" scope="row">
                            <div align="center" class="checkbox">
                                <input type="checkbox" class="checkbox-field" style="position: relative;" name="autoMobility" value="1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Do you push totes in Auto?</td>
                        <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="autoPushTotes"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Do you stack totes in Auto?</td>
                        <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="autoStackTotes"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Do you push containers in Auto?</td>
                        <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="autoStackTotes"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Coopertition</td>
                        <td class="col-md-2" scope="row">
                            <div align="center" class="checkbox">
                                <input type="checkbox" class="checkbox-field" style="position: relative;" name="coop" value="1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Teleop Strategy</td>
                        <td class="col-md-2" scope="row">
                            <textarea class="form-control" rows="3" name="teleStrategy"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Do you stack totes in Teleop?</td>
                        <td class="col-md-2" scope="row"><input type="number" class="form-control number-field" value="0" min="0" max="10" name="teleStackTotes"></td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Can you go on the scoring platform in Teleop?</td>
                        <td class="col-md-2" scope="row">
                            <div align="center" class="checkbox">
                                <input type="checkbox" class="checkbox-field" style="position: relative;" name="teleScoringPlatform" value="1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Can you push containers in Teleop?</td>
                        <td class="col-md-2" scope="row">
                            <div align="center" class="checkbox">
                                <input type="checkbox" class="checkbox-field" style="position: relative;" name="telePushContainer" value="1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Can you put noodles in containers in Teleop?</td>
                        <td class="col-md-2" scope="row">
                            <div align="center" class="checkbox">
                                <input type="checkbox" class="checkbox-field" style="position: relative;" name="teleNoodleContainer" value="1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-md-10" scope="row">Additional Comments</td>
                        <td class="col-md-2" scope="row">
                            <textarea class="form-control" rows="3" name="additionalComments"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Media</h2>
        </div>
        <div class="panel-body">
            <input type="file" name="media" class="btn btn-primary">
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