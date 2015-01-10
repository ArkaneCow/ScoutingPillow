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
<div class="container">
    <div class="page-header">
        <h3>
            View User
        </h3>
    </div>
    <?php
        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];
            $db_query = mysql_query("SELECT * FROM users WHERE id=" . $user_id);
            if (mysql_num_rows($db_query) == 1) {
                $record = mysql_fetch_array($db_query);
            }
        }
    ?>
</div>
<?php
    include('footer.php');
?>