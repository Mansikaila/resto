<?php
include("connection/connect.php");
session_start();
error_reporting(0);
$message = "";
$success = "";
$show_reset_form = false;

if (isset($_POST['login_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginquery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $loginquery);
    $row = mysqli_fetch_array($result);

    if ($row) {
        $_SESSION["user_id"] = $row['u_id'];
        
        header("Location: index.php");
        exit;
    } else {
        $message = "Invalid Username or Password!";
    }
}

if (isset($_POST['forgot_submit'])) {
    $username = $_POST['username']; 
    $query = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['reset_email'] = $user['email']; 
        $show_reset_form = true;
    } else {
        $message = "Username not found!";
    }
}

if (isset($_POST['reset_submit'])) {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($new_pass == $confirm_pass) {
        $email = $_SESSION['reset_email'];
        $update = mysqli_query($db, "UPDATE users SET password='$new_pass' WHERE email='$email'");
        if ($update) {
            unset($_SESSION['reset_email']);
            $success = "Password reset successful.";
        } else {
            $message = "Error updating password.";
        }
    } else {
        $message = "Passwords do not match.";
        $show_reset_form = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login / Forgot Password</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px #ccc; width: 300px; }
        input[type="text"], input[type="password"], input[type="submit"], input[type="button"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        #buttn { background-color: #1e5910; color: white; border: none; cursor: pointer; }
        .cancel-btn { background-color: #d9534f; color: white; border: none; cursor: pointer; }
        .link { margin-top: 10px; text-align: center; }
        .link a { color: #1e5910; text-decoration: none; cursor: pointer; display: block; margin-top: 5px; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="box">
    <?php if ($show_reset_form): ?>
        <h2>Reset Password</h2>
        <form method="post">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="submit" name="reset_submit" id="buttn" value="Reset Password">
<!--            <a href="index.php"><input type="button" class="cancel-btn" value="Cancel"></a>-->
        </form>
    <?php elseif (isset($_GET['forgot'])): ?>
        <h2>Forgot Password</h2>
        <form method="post">
            <input type="text" id="forgot_username" name="username" placeholder="Enter your username" required>
            <input type="submit" name="forgot_submit" id="buttn" value="Next">
<!--            <a href="index.php"><input type="button" class="cancel-btn" value="Cancel"></a>-->
        </form>
        <div class="link"><a href="login.php">Back to Login</a></div>
    <?php else: ?>
        <h2>Login</h2>
        <form method="post">
            <input type="text" id="login_username" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login_submit" id="buttn" value="Login">
            <a href="index.php"><input type="button" class="cancel-btn" value="Cancel"></a>
        </form>
        <div class="link">
            <a id="forgot_link">Forgot Password?</a>
            <a href="registration.php">Sign Up</a>
        </div>
    <?php endif; ?>

    <?php if ($message): ?><div style="color:red;"><?php echo $message; ?></div><?php endif; ?>
    <?php if ($success): ?><div style="color:green;"><?php echo $success; ?></div><?php endif; ?>
</div>

<?php if ($success): ?>
<script>
    alert("<?php echo strip_tags($success); ?>");
    window.location.href = "login.php";
</script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#login_username').focus();

        $('#forgot_link').on('click', function(e) {
            e.preventDefault();
            var username = $('#login_username').val();
            window.location.href = '?forgot=1&username=' + encodeURIComponent(username);
        });

        const urlParams = new URLSearchParams(window.location.search);
        const uname = urlParams.get('username');
        if (uname) {
            $('#forgot_username').val(uname);
        }
    });
</script>

</body>
</html>
