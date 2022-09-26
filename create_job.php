<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Job</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <style>
        .header {
            background: #003366;
        }
        button[name=register_btn] {
            background: #003366;
        }

    
    </style>
</head>
<body>
    <header>
        <h2>Create New Job</h2>
    </header>
    <div id="sections">
    <form method="post" action="create_job.php">

        <?php echo display_error(); ?>

        <div class="input-group">
            <label>Job Name</label>
            <input type="text" name="job_name" value="<?php echo $job_name; ?>">
        </div>
        <div class="input-group">
        <label>Job Description</label>
            <input type="text" name="job_desc" value="<?php echo $job_desc; ?>">
        </div>
        <div class="input-group">
            <label>job Status</label>
            <select name="job_type" id="job_type" >
                <option value=""></option>
                <option value="done">Done</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="job_btn">Create Job</button>
        </div>
    </form>
</div>
</body>
</html>