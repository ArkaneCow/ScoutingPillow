<?php
    session_start();
    include('config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Scouting Pillow</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar navbar-static-top navbar-default" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="index.php">Scouting Pillow</a>
                <?php
                    if (isset($_SESSION['user'])) {
                        
                    } else {
                        
                    }
                ?>
            </div>
        </div>