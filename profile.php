<?php

    session_start();

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");

    //check if user is logged in
    if(isset($_SESSION['museum_userid']) && is_numeric($_SESSION['museum_userid']))
    {
        $id = $_SESSION['museum_userid'];
        $login = new Login();

        $result = $login->check_login($id);
        if($result)
        {
            //retrieve user data
            $user = new User();
            $user_data = $user->get_data($id);

            if(!$user_data){
                header("Location: login.php");
                die;
            }
        } 
        else {
            header("Location: login.php");
            die;
        }
    } else {
        header("Location: login.php");
        die;
    }

// print_r($user_data);

?>

<!DOCTYPE html>
    <head>
    <title>User Profile Settings</title>
    <link href="https://fonts.googleapis.com/css2?family=Franklin+Gothic:wght@400;500;600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
    <style>
        body {
            font-family: 'Franklin Gothic', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .textbox {
            background-color: #aaa8d4; /* Background color for the big text box */
            padding: 20px; /* Padding around the big text box */
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-weight: bold;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        button {
            background-color: #442b63;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .profile-pic-container {
            position: relative; 
            width: 150px;
            height: 150px;
            border-radius: 50%; 
            border: 3px solid #442b63; 
            margin: 0 auto 20px; 
            overflow: hidden;
        }

        .profile-pic-container img {
            width: 100%;
            height: auto;
            display: block;
        }

        .profile-pic-text {
            position: absolute;
            top: 50%; 
            left: 0; 
            transform: translateY(-50%);
            width: 100%;
            text-align: center;
            font-size: 16px;
            color: #442b63;
        }
        </style>
    </head>
    <body>
        <div class="textbox">
            <div class="container"> 
                <h1>Profile Settings</h1>
                <div class="profile-pic-container">
                    <!-- <img src="default-profile-pic.jpg" alt="Profile Picture"> -->
                    <div class="profile-pic-text">Profile Picture</div>
                </div>
                <form id="profileForm">
                    <div class="form-group form-group-split">
                        <div>
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required>
                        </div>
                        <div>
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmEmail">Confirm Email Address</label>
                        <input type="email" id="confirmEmail" name="confirmEmail" placeholder="Confirm your email address" required>
                    </div>
                    <div class="button-group">
                        <button type="submit">Update Info</button>
                        <button type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
