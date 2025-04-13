<?php
session_start();

include("connection.php");
include("functions.php");

$error = ""; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if ($user && password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $userID;
                header("Location: /weabook cafe/parent-folder/index.php");
                die;
            } else {
                $error = "Invalid email or password. Please try again.";
            }
        } else {
            $error = "Error: " . $query . "<br>" . mysqli_error($con);
        }
    } else {
        $error = "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="logandsign.css"> <!-- Link to the common styles -->
</head>
<body>
    <form action="" method="post">
        <h2 style="text-align: center; color: #fff;">Login</h2>
        <?php if (!empty($error)) { ?>
            <div style="color: #fff; text-align: center;"><?php echo $error; ?></div>
        <?php } ?>
        <label for="email">Email:*</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <br>
        <label for="password">Password:*</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <br>
        <input type="submit" value="Log In">
        <p style="color: #fff;">Don't have an account? <a href="signup.php">Register</a></p>
    </form>
</body>
</html>
