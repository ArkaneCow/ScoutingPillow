<?php
    include('header.php');
?>
<?php
    if (!isset($_SESSION['user'])) {
        header('Location: login_page.php');
    }
?>
<?php
    include('footer.php');
?>