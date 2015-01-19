<?php
    session_start();
    include('config.php');
?>
<?php
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
    }
    
?>