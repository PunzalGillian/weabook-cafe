<?php

function check_login($con)
{
    if (isset($_SESSION['user_id']) && isset($_SESSION['password'])) {
        $id = $_SESSION['user_id'];
        $password = $_SESSION['password'];

        $query = "SELECT * FROM users WHERE user_id = '$id' AND password = '$password' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect to login
    header("Location: /weabook cafe/logsign/login.php");
    die;
}


function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}

