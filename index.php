<?php
    include('header.php');
?>
<?php
    if (!isset($_SESSION['user'])) {
        header('Location: login_page.php');
    }
?>
<div class="container">
    <div class="page-header">
        <h3>Dashboard</h3>
    </div>
</div>
<?php
    include('footer.php');
?>