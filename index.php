
<?php 
require'functions.php';
 if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

 ?>
<?php include('config.php') ?>

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
<?php
require 'db.php';
// $_SESSION["id"] = 1; // User's session
// $sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM setting WHERE id = 1"));
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>

<?php
        $id = $user["id"];
        $name = $user["name"];
        $image = $user["image"];
        ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://use.fontawesome.com/473d0abda0.js"></script>
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<meta name="description" content="This is the about page">
	<title>USER MANAGEMENT</title>
    <style type="text/css">
.homeShow{
    background: linear-gradient(rgba(120, 55, 96, 0.8), rgba(100, 32, 40, 0.8));
    height: 100vh;
    -webkit-background-size: cover;
    background-size: cover;
    background-position: center center;
    padding: 2px 5px;
    width: 180%;
    display: flex;
    padding: 10px;
}
.logo {
    float: left;
}
.logo img {
    width: 50px;
    height: 50px;
    position: relative;
    top: 5;
}
.welcome-text {
    position: absolute;
    width: 600px;
    height: 300px;
    margin: 20% 15%;
    text-align: center;
}
.welcome-text h1 {
    text-align: center;
    color: #fff;
    text-transform: uppercase;
    font-size: 60px;
}
.welcome-text h1 span {
    color: #00fecb;
}
.welcome-text a {
    border: 1px solid #fff;
    padding: 10px 25px;
    text-decoration: none;
    text-transform: uppercase;
    font-size: 14px;
    margin-top: 20px;
    display: inline-block;
    color: #fff;
}
.welcome-text a:hover {
    background: #fff;
    color: #333;
}
        table{
            text-align: left;
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
    </style>

</head>
<body>

	<div class="container">
		      
		<div class="sideNav">
			<div id="name">
				<div id="display-image">
        <img src="images/<?php echo $image; ?>"  width = 125 height = 100 title="<?php echo $image; ?>">
    		</div>
				<h1><?php echo $name; ?></h1>
			</div>
			<div id="navBar">
				<ul>
				<div class="navItem active"> <i class="fa fa-home" aria-hidden="true" id="homeShow">Home</i> </div>
                <div class="navItem"> <i class="fa fa-user" aria-hidden="true" id="userShow">Users</i> </div>
				<div class="navItem"> <i class="fa fa-list" aria-hidden="true" id="recShow">Records </i></div>
				<div class="navItem"><i class="fa fa-wrench" aria-hidden="true" id="setShow"></i> Settings</div>
			</ul>
			</div>
			<div id="logout">
                 <?php if (isset($_SESSION['success'])) : ?>
            <?php
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                        
                    ?>
                     <?php endif ?>
            	
			</div>
            <header>
        <span class="logo">
                    <h1 id="heading">HomePage</h1>
                </span>
            <span class="userProfile" id="userprofile">
                <img src="images/noprofil.jpg">
            
                <?php  if (isset($_SESSION['user'])) : ?>
                    <strong><?php echo $_SESSION['user']['username']; ?></strong>

                    <small>
                        <i  style="color: white;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                        <br>
                        
                    </small>

                <?php endif ?>
                <a class="fa fa-sign-out" aria-hidden="true" href="index.php?logout='1'">Logout</a>
            </span>
    </header>
    
       
    

<div class="contentContainer">
		
	<div id="sections">
        <div id="home_page"  class="homeShow" >
                        <div class="wrapper">
                            <div class="logo">
                                <img src="images/logo.png" alt="">
                            </div>
                    <div class="welcome-text">
                            <h1>
                    We are <span>Creative</span></h1>
                    <a href="https://wa.me/254799427421">Contact US</a>
    </div>
        </div>
    </div>
		<div id="userSec" class="users"  style="display: none;">
            <div>
				<a href="create_user.php" class="fa fa-plus" id="myBtn">New User</a>
				<!-- <div id="myModal" class="modal">
					<div id="modal-Content" class="newUser-modal">
						<span class="close">&times;</span>
                    </div> -->
                </div>

			<!-- user display modal	 -->
		<div class="vuserModal">
						<?php $results = mysqli_query($db, "SELECT * FROM users");
                         ?>
						<h2>USers Available</h2>

            <table>
                <thead>
                    <tr>
                        <th>user Name</th>
                        <th>Email</th>
                        <th colspan="2">Action </th>
                    </tr>
                </thead>

                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_user.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                    </td>
                    <td>
                        <a href="config.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>


	<!-- records section	 -->	

<div id="recsShow" class="records" style="display: none;">
				<div class="vuserModal">
                        <?php $results = mysqli_query($db, "SELECT * FROM jobInfo"); ?>
                        <h2>Jobs Available</h2>

            <table style="font-size: 1.2em;">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>job Name</th>
                        <th>job Description</th>
                        <th>Time Updated</th>
                        <th>Status</th>
                        <th colspan="2">Action </th>
                    </tr>
                </thead>

                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['time_done']; ?></td>
                    <td><?php echo $row['job_name']; ?></td>
                    <td><?php echo $row['job_desc']; ?></td>
                    <td><?php echo $row['time_modified']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="edit_job.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                    </td>
                    <td>
                        <a href="config.php?del_job=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
		
</div>
		<!-- setting section -->
		
		<div id="set_show"  class="setShow"style="display: none;">
			
			<form action="" id="form" method="post"  enctype="multipart/form-data" >
				<div class="input-group">
                    <input type="hidden" class="input-group" name="id" value="<?php echo $id; ?>">
			          <input type="text" class="input-group" name="name" value="<?php echo $name; ?>">
			          <input type="file" class="input-group" name="image" id = "" accept=".jpg, .jpeg, .png">
			          <i class = "fa fa-camera" style = "color: #fff;"></i>
			        </div>
                     <button id="image" class="btn" type="submit" name="upload">Save</button> 

			</form>
		</div>	
		</div>
         <div class="footer">
                        <h2> &copy; KikiEdward 2022</h2>
                </div>       	
	</div>
        
        </div>
	</div>
                
	<script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
<script src="js/script.js"></script>
</body>
</html>
<?php

    if(isset($_FILES["image"]["name"])){
      $id = $_POST["id"];
      $name = $_POST["name"];

      $imageName = $_FILES["image"]["name"];
      $imageSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      // Image validation
      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)){
        echo
        "
        <script>
          alert('Invalid Image Extension');
          document.location.href = '../jbms';
        </script>
        ";
      }
      elseif ($imageSize > 1200000){
        echo
        "
        <script>
          alert('Image Size Is Too Large');
          document.location.href = '../jbms';
        </script>
        ";
      }
      else{
        $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
        $newImageName .= '.' . $imageExtension;
        $query = "UPDATE setting SET image = '$newImageName',name='$name' WHERE id = $id";
        mysqli_query($conn, $query);
        move_uploaded_file($tmpName, 'images/' . $newImageName);
        echo
        "
        <script>
        document.location.href = '../jbms';
        </script>
        ";
      }
    }
    ?>