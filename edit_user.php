<?php  include('config.php'); ?>
<?php  include('functions.php'); ?>

<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM users WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$username = $n['username'];
			$user_type = $n['user_type'];
			$email = $n['email'];
		}
	}
?>
<html>
<head>	
	<title>Edit User</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>
	<?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
    </div>
    <?php endif ?>
	<a href="index.php">Home</a>
	<br/><br/>
	<div id="sections">
	<form method="post" action="config.php">

        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>User type</label>
            <select value="<?php echo $user_type; ?>" name="user_type" id="user_type" >
                <option ></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="input-group">
                    <input type="submit" id="btn" name="update_user" value="Update">
        </div>
    </form>
</div>
</body>
</html>