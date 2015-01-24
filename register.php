<?php

session_start();
include('config.php');
?>
<?php

$register_email = $_POST['email'];
$register_password = $_POST['password'];
$register_rank = $_POST['rank'];
if (isset($register_email) && isset($register_password) && isset($register_rank)) {
    $db_query = "INSERT INTO registers(email, rank, password) VALUES('" . $register_email . "'," . $register_rank . ", md5('" . $register_password . "'))";
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
}
?>
<?php

header('Location: index.php');
?>