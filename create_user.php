<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL - Create user</title>
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
        <h2>Admin - create user</h2>
    </header>
    <div id="sections">
    <form method="post" action="create_user.php">

        <?php echo display_error(); ?>

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
            <select name="user_type" id="user_type" >
                <option value="<?php echo $user_type; ?>"></option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
                    <button class="btn" type="submit" name="register_btn">Register</button>
        </div>
    </form>
</div>
</body>
</html>