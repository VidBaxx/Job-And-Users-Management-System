<?php include('config.php') ?>
<?php
require 'connection.php';
// $_SESSION["id"] = 1; // User's session
// $sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM setting WHERE id = 1"));
        $id = $user["id"];
        $name = $user["name"];
        $image = $user["image"];
?>
<?php 
include('functions.php');



if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="https://use.fontawesome.com/473d0abda0.js"></script>
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
		body{
			font-family: 'Quicksand', sans-serif;
			padding: 15px;
			box-sizing: border-box;
			margin: 0;
			width: 100%;
			min-height: 50%;

		}
	.header {
		width: 100%;
		display: flex;
		flex-direction: row;
		justify-content: space-around;
	}
	button[name=register_btn] {
		background: #003366;
	}

		a{
			list-style-type: none;
			color: black;
			text-decoration: none;
		}
		.user_Profile{
			background-color: #26ebda;
			width:150px;
			height: 4em;
			border-radius: 10px;
			display: block;
			padding: 5px;
			
		}
		.content{
			width: 100%;
			min-height: 50%;
		}
table{
	border-collapse: collapse;
    margin: 25px 0;
    font-size: 1.5em;
    font-family: sans-serif;
   	width:100%;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
th {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
tr {
	padding: 12px 15px;
    border-bottom: 1px solid #dddddd;
}

 tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

 tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.footer{
	position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: whitesmoke;
  color: black;
  text-align: center;
}
h2{
	text-align: center;
}
.logo2{
	position: absolute;
	top: 5px;
	left: 5px;
	font-size: 12px;
	display: inline-block
}
.logo2 img{
	width: 70px;
	height: 70px;
}
.content{
	margin-top: 30px;
}

</style>

</head>
<body>
	<span class="logo2">
			<img src="images/<?php echo $image; ?>" title="<?php echo $image; ?>">
    		</div>
				
		</span>
	<header>
		<span class="logo">
			<h1><?php echo $name; ?></h1>
		</span>
		
		<div class="userProfile">
			<img src="images/noprofil.jpg" >
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<div id="lout">
            <a class="fa fa-sign-out" aria-hidden="true" href="home.php?logout='1'">Logout</a>	
			</div>
					</small>

				<?php endif ?>
	</header>
	</div>
	<div class="content">
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		
		<div id="newJobs" class="jobs"  style="display:;">
            <div>
				<a href="create_job.php" class="fa fa-plus" id="myBtn">New Job</a>
				<!-- <div id="myModal" class="modal">
					<div id="modal-Content" class="newUser-modal">
						<span class="close">&times;</span>
                    </div> -->
                </div>

			<!-- user display modal	 -->
		<div class="vuserModal">
						<?php $results = mysqli_query($db, "SELECT * FROM jobInfo"); ?>
						<h2>Jobs Available</h2>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Time</th>
                        <th>job Name</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['time_done']; ?></td>
                    <td><?php echo $row['job_name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

		
	</div>

			<div class="footer">
                        <h2>🤍 &copy; KikiEdward 2022</h2>
                </div>     
		</div>
		
</body>
</html>