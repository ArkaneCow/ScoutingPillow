<?php

session_start();
include('config.php');
?>
<?php

if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
    header('Location: index.php');
}
if (isset($_GET['id'])) {
    $delete_id = $_GET['id'];
    $db_query = "DELETE FROM registers WHERE id = " . $delete_id;
    if (!mysql_query($db_query)) {
        die(mysql_error());
    }
}
header('Location: manage_registers.php');
?>