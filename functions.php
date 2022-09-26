<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'jms_db');
// variable declaration
$id="";
$username = "";
$email    = "";
$job_name = "";
$job_desc="";
$time_done = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    register();
}// call the register() function if register_btn is clicked
if (isset($_POST['job_btn'])) {
    registerJob();
}


// REGISTER USER
function register(){
    // call these variables with the global keyword to make them available in function
    global $db, $errors, $username, $email;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $username    =  e($_POST['username']);
    $email       =  e($_POST['email']);
    $password_1  =  e($_POST['password_1']);
    $password_2  =  e($_POST['password_2']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) { 
        array_push($errors, "Username is required"); 
    }
    if (empty($email)) { 
        array_push($errors, "Email is required"); 
    }
    if (empty($password_1)) { 
        array_push($errors, "Password is required"); 
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        if (isset($_POST['user_type'])) {
            $user_type = e($_POST['user_type']);
            $query = "INSERT INTO users (username, email, user_type, password) 
                      VALUES('$username', '$email', '$user_type', '$password')";
                      mysqli_query($db,"ALTER TABLE users AUTO_INCREMENT = 1");
            mysqli_query($db, $query);
            $_SESSION['success']  = "New user successfully created!!";
            header('location: index.php');
        }else{
            $query = "INSERT INTO users (username, email, user_type, password) 
                      VALUES('$username', '$email', 'user', '$password')";
            mysqli_query($db, $query);

            // get id of the created user
            $logged_in_user_id = mysqli_insert_id($db);

            $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
            $_SESSION['success']  = "You are now logged in";
            header('location: index.php');              
        }
    }
}
// REGISTER JOB
function registerJob(){
    // call these variables with the global keyword to make them available in function
    global $db, $job_name, $status,$job_desc;

    // receive all input values from the form. Call the e() function
    // defined below to escape form values
    $job_name    =  e($_POST['job_name']);
    $job_desc    =  e($_POST['job_desc']);
    // $time_done  =  e($dob = date('Y-m-d', strtotime($_POST['time_done'])));

        if (isset($_POST['job_type'])) {
            $job_type = e($_POST['job_type']);
            $query = "INSERT INTO jobInfo (job_name, status,job_desc) 
                      VALUES('$job_name', '$job_type','$job_desc')";
                      mysqli_query($db,"ALTER TABLE jobinfo AUTO_INCREMENT = 1");
            mysqli_query($db, $query);
            $_SESSION['success']  = "New job successfully created!!";
            header('location: home.php');
        }
}

// return user array from their id
function getUserById($id){
    global $db;
    $query = "SELECT * FROM users WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}
// escape string
function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo $error .'<br>';
            }
        echo '</div>';
    }
} 
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login(){
    global $db, $username, $errors;

    // grap form values
    $username = e($_POST['username']);
    $password = e($_POST['password']);

    // make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
            // check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] == 'admin') {

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "You are now logged in";
                header('location: index.php');       
            }else{
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success']  = "You are now logged in";

                header('location: home.php');
            }
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}  
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    }else{
        return false;
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: login.php");
}
function isAdmin()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
        return true;
    }else{
        return false;
    }
}