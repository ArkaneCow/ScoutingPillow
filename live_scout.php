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
    include('footer.php');
?>