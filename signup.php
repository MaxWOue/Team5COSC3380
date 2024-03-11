<?php
    include("classes/connect.php");
    include("classes/signup.php");
    
    $email = "";
    $first_name = "";
    $last_name = "";
    $password = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $signup = new Signup();
        $result = $signup->evaluate($_POST);
        
        if ($result != ""){
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "The following error occured:<br><br>";
            echo $result;
            echo "</div>";
        } 
            
        $email = $_POST['email'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
    }
    
    
?>

<html>
    <head>
        <title>Museum of Fine Arts | Signup</title>
    </head>
    <style>
        body {
                font-family: tahoma;
                background-color: #F5F2F0;
                background-image: url('image/bg6.png');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }
        #Bar{
            height:100px;
            background-color:#C5EBAA;
            color: black; 
            font-size: 40px;
            padding:4px;
            font-weight:bold;
            text-align: center;
            }
        #Bar_Login{
            background-color:#C5EBAA;
            width:400px;
            margin:auto;
            margin-top:50px;
            padding:10px;
            padding-top:50px;
            text-align: center;
            border-radius: 10px;
            font-weight:bold;
            }
        #text{
            height:40px;
            width:300px;
            border-radius: 10px;
            border:solid 1px #888;
            padding: 2px;
            font-size: 14px;
        }
        #button{
            width: 300px;
            height: 40px;
            border-radius: 10px;
            font-weight: bold;
            background-color:#A5DD9B;
            color:black;
        }
        #create{
            background-color:#A5DD9B;
            color:black;
            font-size: 20px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            }
    </style>
    <body style="font-family: tahoma;background-color:#F5F2F0;">
        <div id="Bar"> 
            <div> 
            Museum of Fine Arts
            </div>
        </div>
        <div id="Bar_Login"> 
            Create a MyMuseum account<br><br>
            <form method="post" action="">
                <input value = "<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First Name"><br><br>
                <input value = "<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last Name"><br><br>
                <input value = "<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>                
                <input name="password" type="password" id="text" placeholder="Password"><br><br>
                <input name="re-password" type="password" id="text" placeholder="Re-enter Password"><br><br>
                <input type="submit" id="button" value="Create a new account"><br><br><br>
            </form>
                <input type="submit" id="create" value="Back to Login"><br><br>

        </div>
        

    </body>
</html>