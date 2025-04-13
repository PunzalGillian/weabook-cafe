<?php
session_start();

include("connection.php");
include("functions.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$firstNameErr = $lastNameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);

    if (empty($firstName)) {
        $firstNameErr = "First Name is required";
    }

    if (empty($lastName)) {
        $lastNameErr = "Last Name is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    }

    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (!preg_match("/.{8,}/", $password)) {
        $passwordErr = "Password should be a minimum of 8 characters";
    }

    if (empty($confirmPassword)) {
        $confirmPasswordErr = "Confirm Password is required";
    } elseif ($password !== $confirmPassword) {
        $confirmPasswordErr = "Passwords do not match";
    }

    if (empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        // Check if the user with the given email already exists
        $result = mysqli_query($con, "SELECT id FROM users WHERE email = '$email'");
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // User with the given email already exists
            echo "Error: User with this email already exists.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Save to database
            $user_id = random_num(20);

            // Execute the query to insert into users table
            $query = "INSERT INTO users (user_id, first_name, second_name, email, password) VALUES ('$user_id', '$firstName', '$lastName', '$email', '$hashedPassword')";
            $result = mysqli_query($con, $query);

            if ($result) {
                // Redirect to login.php after successful registration
                header("Location: login.php");
                die;
            } else {
                echo "Error: Failed to register user.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="logandsign.css"> <!-- Link to the common styles -->
</head>

<body>
    <form action="" method="post" onsubmit="return validateForm()">
        <h2 style="text-align: center; color: #fff;">Sign Up</h2>
        <div class="name-fields">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
            <span class="error"><?php echo $firstNameErr; ?></span>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
            <span class="error"><?php echo $lastNameErr; ?></span>
        </div>
        <label for="email">Email:*</label>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <span class="error"><?php echo $emailErr; ?></span>
        <br>
        <label for="password">Password:*</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <span class="error"><?php echo $passwordErr; ?></span>
        <br>
        <!-- Add a confirm password field for better user experience -->
        <label for="confirmPassword">Confirm Password:*</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
        <span class="error"><?php echo $confirmPasswordErr; ?></span>
        <br>
        <input type="checkbox" id="terms" name="terms" required>
        <label style="color: #fff; " for="terms" class="terms-label">I accept <a href="#terms-section">terms and conditions</a></label>
        <br>
        <input type="submit" value="Submit">
        <p class="login-link"><span style="color: #fff;">Already have an account?</span> <a href="login.php">Login here</a></p>

        <script type="text/javascript">
            function validateForm() {
                var firstName = document.getElementById('firstName').value;
                var lastName = document.getElementById('lastName').value;
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirmPassword').value;

                if (firstName === '' || lastName === '' || email === '' || password === '' || confirmPassword === '') {
                    alert('Please fill in all the required fields.');
                    return false;
                }

                if (password !== confirmPassword) {
                    alert('Passwords do not match.');
                    return false;
                }

                // Password complexity requirements
                var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                if (!passwordRegex.test(password)) {
                    alert('Password should be a minimum of 8 characters, 1 number, and 1 special character.');
                    return false;
                }

                if (!document.getElementById('terms').checked) {
                    alert('Please accept the Terms of Use & Privacy Policy.');
                    return false;
                }

                // Allow the form submission to proceed
                return true;
            }
        </script>
    </form>
</body>

</html>
