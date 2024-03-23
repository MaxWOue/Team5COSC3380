<?php
    session_start();
    if (isset($_POST['logout'])) {
        header("Location: logout.php");
        exit;
    }
    $result = false;

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");

    //check if user is logged in
    if(isset($_SESSION['museum_userid']) && is_numeric($_SESSION['museum_userid'])){

        $id = $_SESSION['museum_userid'];
        $login = new Login();

        $result = $login->check_login($id);

        if($result){
            //get userdata
            $user = new User();
            $user_data = $user->get_data($id);

            if(!$user_data){
                header("Location: login.php");
                die;
            }

        } else {
            header("Location: login.php");
            die;
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Database - Admin Portal</title>
    <style>
        /* Basic styling for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url('texture-1909992_1280.webp')
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Portal</h1>
        <p>Welcome to the admin portal of the museum database.</p>
        <p>Here, administrators can access and manage all aspects of the museum database.</p>
    </div>
</body>
</html>
