<?php //index.php
// this index page is our homepage
// after creating this index.php, you will not be able to access it unless you login as  user or register first, then login

session_start();

include('config.php');

// if the user has not loggin in correctly, they will be directed to the login page

if(!isset($_SESSION['username'])) {
    $_SESSION['msg'] = 'You must login first!';
    header('Location:login.php');
}

if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('Location:login.php');
}

include('includes/header.php');

// Notification message
// if successful, welcome the end user

if(isset($_SESSION['success'])) :?>

<div class="success">
    <h3>
        <?php echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    </h3>
</div> <!-- end div success -->
<?php endif ; 

if(isset($_SESSION['username'])) :?>

<div class="welcome-logout">
    <h3> Hello
        <?php echo $_SESSION['username'] ;?>
    </h3>
<p><a href="index.php?logout='1'">Log Out</a></p>
</div> <!-- end welcome logout div -->
<?php endif ; ?>
</header>

<div id="wrapper">
<h1>Welcome to the hompage!</h1>

</div> <!-- end wrapper -->

<?php
include('includes/footer.php');
?>

