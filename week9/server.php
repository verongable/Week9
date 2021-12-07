<?php //our server page - where we connect to our database
// session is a way to store information, variables to be used accross several pages
session_start();
include('config.php');
// this is where we ill eventually place our include for our header.php
// Connect to the database

$iConn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myError(__FILE__,__LINE__,mysqli_connect_error()));

// Register the user
// if(isset reg_user)

if(isset($_POST['reg_user'])) {
    $first_name = mysqli_real_escape_string($iConn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($iConn, $_POST['last_name']);
    $email = mysqli_real_escape_string($iConn, $_POST['email']);
    $username= mysqli_real_escape_string($iConn, $_POST['username']);
    $password_1 = mysqli_real_escape_string($iConn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($iConn, $_POST['password_2']);

// we want the end user to fill everything out 
// if it is empty, we are going to use a new function array_push()

if(empty($first_name)) {
    array_push($errors, 'First name is required!');
}
if(empty($last_name)) {
    array_push($errors, 'Last name is required!');
}
if(empty($email)) {
    array_push($errors, 'Email is required!');
}
if(empty($username)) {
    array_push($errors, 'Username is required!');
}
if(empty($password_1)) {
    array_push($errors, 'Password is required!');
}
if($password_1 !== $password_2) {
    array_push($errors, 'Passwords do not match!');
}

// we are checking the username and password, and selecting it from the table

$user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1 ";

$result = mysqli_query($iConn, $user_check_query) or die(myError(__FILE__,__LINE__,mysqli_error($iConn)));

$rows = mysqli_fetch_assoc($result);

if($rows) {
    if($rows['username'] == $username) {
        array_push($errors, 'Username already exists!');
    }

    if($rows['email'] == $email) {
        array_push($errors, 'Email already exists!');
    }
} // close big rows

// if everything is okay, if we don't have errors

if(count($errors) == 0 ) {
// introduce new function md5() - this fuction will spit out in your database a 32 hex character value for your password
$password = md5($password_1);

//we must insert out registration data into the table inside of our database, this will happen by using the INSERT
$query = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$first_name','$last_name', '$email', '$username', '$password')";

mysqli_query($iConn, $query);

$_SESSION['username'] = $username;
$_SESSION['success'] = $success;

header('Location:login.php');

} // end count

}  // end if isset reg_user

// now, we have to communicate to the login.php page

if(isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($iConn, $_POST['username']);
    $password = mysqli_real_escape_string($iConn, $_POST['password']);

    if(empty($username)) {
        array_push($errors, 'Username is required!');
    }
    if(empty($password)) {
        array_push($errors, 'Password is required!');
    }

// we are going to count the errors - and if they equal 0, we are happy, if not, we're not

if(count($errors) == 0) {
    $password = md5($password);

    // we have to make sure there is only one username and one password
    // we will be selecting out information from our table

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $results = mysqli_query($iConn, $query);

    // if our username and password is equal to one, life is good

    if(mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = $success;
        // GOT RID OF CLOSE COUNT here
        
    //if we are successful, we will be directed to the index.php page
    header('Location:index.php');

} else {
    array_push($errors, 'Wrong username/password combo!');
}

} // closing if count

} // end isset login