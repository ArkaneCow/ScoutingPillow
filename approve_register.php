<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
    header('Location: index.php');
}
if (isset($_GET['id'])) {
    $add_id = $_GET['id'];
    $reg_query = mysql_query("SELECT * FROM registers WHERE id = " . $add_id);
    if (!$reg_query) {
        die(mysql_error());
    }
    $record = mysql_fetch_array($reg_query);
    $reg_email = $record['email'];
    $reg_rank = $record['rank'];
    $reg_pass = $record['password'];
    $reg_open = $record['openid'];
    $user_add = mysql_query("INSERT INTO users(email, rank, password, openid) VALUES('" . $reg_email . "'," . $reg_rank . ",'" . $reg_pass . "','" . $reg_open . "')");
    if (!$user_add) {
        die(mysql_error());
    }
    $delete_id = $_GET['id'];
    $db_query = "DELETE FROM registers WHERE id = " . $delete_id;
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
}
header('Location: manage_registers.php');
?>