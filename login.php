<?php

session_start();
include('config.php');
?>
<?php

$email_check = $_POST['email'];
$password_check = $_POST['password'];
$db_query = mysql_query("SELECT * FROM users WHERE email = '" . $email_check . "'");
if (mysql_num_rows($db_query) == 1) {
    $record = mysql_fetch_array($db_query);
    if (md5($password_check) == $record['password']) {
        $_SESSION['user'] = $email_check;
        $_SESSION['rank'] = $record['rank'];
        $_SESSION['id'] = $record['id'];
    }
}
header('Location: index.php');
?>