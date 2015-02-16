<?php
session_start();
include('config.php');
?>
<?php
include('header.php');
?>
<div class ="container">
    <div class ="page-header">
        <h3>Register</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Register</h2>
        </div>
        <div class="panel-body">
            <form action="register.php" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="email-addon">@</span>
                    <input type="text" name="email" class="form-control" placeholder="Email" aria-describedby="email-addon">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="password-addon">*</span>
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="password-addon">
                </div>
                <div class="radio">
                    <label><input type="radio" name="rank" value="1">Admin</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="rank" value="2">Data Analyst</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="rank" value="3">Scouter</label>
                </div>
                <br>
                <input type="submit" value="Register" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>