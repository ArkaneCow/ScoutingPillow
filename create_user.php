<?php
    session_start();
    include('config.php');
?>
<?php
    if (!isset($_SESSION['user']) || $_SESSION['rank'] > 1) {
        header('Location: index.php');
    }
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $new_rank = $_POST['rank'];
    if (isset($new_email) && isset($new_password) && isset($new_rank)) {
        $db_query = "INSERT INTO users(email, rank, password) VALUES('" . $new_email . "'," . $new_rank . ", md5('" . $new_password . "'))";
        if (!mysql_query($db_query)) {
            die(mysql_error());
        }
    }
    header('Location: manage_users.php');
?>