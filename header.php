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
                        echo("<div class=\"dropdown nav navbar-nav pull-right\">");
                        echo("<button class=\"btn btn-default navbar-btn dropdown-toggle\" type=\button\" id=\"userMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">");
                        echo($_SESSION['user']);
                        echo("<span class=\"caret\"></span>");
                        echo("</button>");
                        echo("<ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"userMenu\">");
                        echo("<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"view_user.php?id=" . $_SESSION['id'] . "\">" . $_SESSION['user'] . "</a></li>");
                        echo("<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"logout.php\">Logout</a></li>");
                        echo("</ul>");
                        echo("</div>");
                    }
                ?>
            </div>
        </div>