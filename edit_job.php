<?php  include('config.php'); ?>
<?php  include('functions.php'); ?>


<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM jobinfo WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$job_name = $n['job_name'];
			$status = $n['status'];
			$job_desc = $n['job_desc'];
		}
	}
?>
<html>
<head>	
	<title>Edit Job</title>
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
            <label>JOb Name</label>
            <input type="text" name="job_name" value="<?php echo $job_name; ?>">
        </div>
        <div class="input-group">
            <label>Time</label>
            <input type="date" name="time_modified" value="<?php echo $time_modified; ?>">
        </div>
        <div class="input-group">
        <label>Job Description</label>
            <input type="text" name="job_desc" value="<?php echo $job_desc; ?>">         
        </div>
        <input type="text" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Job Status</label>
            <select  name="status" id="status" >
                <option value="<?php echo $status; ?>" ></option>
                <option value="Done">Done</option>
                <option value="Pending">Pending</option>
            </select>
        </div>
        <div class="input-group">
                    <?php if ($update == true): ?>
                    <button class="btn" type="submit" name="update_job" style="background: #556B2F;">update</button>
                    <?php endif ?>
                </div>
    </form>
</div>
</body>
</html>