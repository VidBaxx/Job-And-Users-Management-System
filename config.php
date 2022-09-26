<?php 
	$db = mysqli_connect('localhost', 'root', '', 'jms_db');

	// initialize variables
	$username = "";
	$user_type = "";
	$job_name = "";
	$time_modified = "";
	$status = "";
	$email = "";
	$job_desc="";
	$id = 0;
	$update = false;

    if (isset($_POST['update_user'])) {
	   $id = $_POST['id'];
	   $username = $_POST['username'];
	   $user_type = $_POST['user_type'];
	   $email = $_POST['email'];

	mysqli_query($db, "UPDATE users SET username='$username',user_type='$user_type',email='$email' WHERE id=$id");
	$_SESSION['message'] = "User updated!"; 
	header('location: index.php');
}

if (isset($_POST['update_job'])) {
	   $id = $_POST['id'];
	   $status = $_POST['status'];
		$job_name = $_POST['job_name'];
		$job_desc=$_POST['job_desc'];
		$time_modified  = date('Y-m-d', strtotime($_POST['time_modified']));

	mysqli_query($db, "UPDATE jobinfo SET job_name='$job_name',job_desc='$job_desc',time_modified='$time_modified',status='$status' WHERE id=$id");
	$_SESSION['message'] = "Job updated!"; 
	header('location: index.php');
}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM users WHERE id=$id");
	$_SESSION['message'] = "User deleted!"; 
	header('location: index.php');
}
if (isset($_GET['del_job'])) {
	$id = $_GET['del_job'];
	mysqli_query($db, "DELETE FROM jobinfo WHERE id=$id");
	$_SESSION['message'] = "Job deleted!"; 
	header('location: index.php');
}
?>
