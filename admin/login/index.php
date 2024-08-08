<?php
  require('../../connection.php');
  require('../../function.php');
  $msg='';
  if(isset($_POST['signup'])){
    $name=get_safe_value($con,$_POST['name']);
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);
    date_default_timezone_set('Asia/Yangon');
    $added_on=date('Y-m-d H:i:s');

    $res=mysqli_query($con,"SELECT * FROM `admin` where `email`='$email'");
    $check=mysqli_num_rows($res);
    if($check>0){
        ?>
        <script>
            alert('Your email already exist!');
        </script>
        <?php
        
    }else{
        mysqli_query($con,"INSERT INTO `admin`(`name`, `email`, `password`, `date`) VALUES ('$name','$email','$password','$added_on')");
        ?>
        <script>
            alert('Sucessfully Registered!');
        </script>
        <?php
    }
  }
  if(isset($_POST['signin'])){
    $email=get_safe_value($con,$_POST['email']);
    $password=get_safe_value($con,$_POST['password']);

    $res=mysqli_query($con,"SELECT * FROM `admin` where `email`='$email' and `password`='$password'");
    $check=mysqli_num_rows($res);
    if($check>0){
        $row=mysqli_fetch_assoc($res);
        $_SESSION['USER_LOGIN']='yes';
        $_SESSION['USER_EMAIL']=$row['email'];
        $_SESSION['USER_ID']=$row['id'];
        ?>
        <script>
           
            alert('sucessfully login!');
            window.location.href='../index.php';
        </script>
        <?php
        
    }else{
        ?>
        <script>
            alert('please enter correct login detail!');
        </script>
        <?php
    
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>ပြည်တွင်းအခွန်များဦးစီးဌာန</title>
    <meta name="title" content="Adex">
    <meta name="description" content="This is a business agency html template made by codewithsadee">

    <!-- 
        - favicon
    -->
    <link rel="shortcut icon" href="../../favicon.svg" type="image/svg+xml">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST">
                <h1>Create Account</h1>
                <!-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> -->
                <span>or use your email for registeration</span>
                <input type="text" placeholder="Name" name="name" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="submit" value="Sign up" class="btn" name="signup">
            </form>
            <div>
                <?php
                echo $msg;
                ?>
            </div>
        </div>
        <div class="form-container sign-in">
            <form method="POST">
                <h1>Sign In</h1>
                <!-- <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> -->
                <span>or use your email password</span>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="password" required>
                <a href="#">Forget Your Password?</a>
                <input type="submit" value="Sign In" class="btn" name="signin">
            </form>
            <div>
                <?php
                echo $msg;
                ?>
            </div>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>