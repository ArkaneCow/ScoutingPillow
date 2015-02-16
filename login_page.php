<?php
session_start();
include('config.php');
?>
<?php
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>
<?php
include('header.php');
?>

<div class="container">
    <div class="page-header">
        <h3>Login</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">with credentials</h2>
        </div>
        <div class="panel-body">
            <form action="login.php" method="post">
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="email-addon">@</span>
                    <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="email-addon">
                </div>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="password-addon">*</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="password-addon">
                </div>
                <br>
                <input type="submit" value="Login" class="btn btn-primary">
                <a href="register_page.php" class="btn btn-primary">Register</a>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">with Google</h2>
        </div>
        <div class="panel-body">
            <?php
            require_once('openid.php');
            $openid = new LightOpenID("localhost");
            $openid->identity = 'https://www.google.com/accounts/o8/id';
            $openid->required = array(
                'contact/email'
            );
            $openid->returnUrl = "login.php";
            ?>
            <a class="btn btn-primary btn-danger" href="<?php echo $openid->authUrl() ?>"> Login with Google</a>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>