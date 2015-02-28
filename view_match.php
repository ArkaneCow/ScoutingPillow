<?php
session_start();
include('config.php');
?>
<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
if (!isset($_GET['id']) || !isset($_GET['match'])) {
    header('Location: index.php');
}
?>
<?php
include('header.php');
?>
<div class="container">

</div>
<?php
include('footer.php');
?>