<?php //login.php page
// input fields for username and password

include('server.php');
include ('includes/header-form.php');
?>
<div id="wrapper">
<h1 class="center">Login</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <fieldset>
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <button type="submit" class="btn" name="login_user">Login</button>

        <button type="button" onclick="window.location.href='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'">Reset</button>

        <?php include ('errors.php');?>
    </fieldset>
</form>

<h3>Not a member?</h3>
<span class="block"><a href="register.php">Register here!</a></span>

</div><!-- close wrapper -->
</body>
</html>