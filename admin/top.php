<?php
  require('../connection.php');
  require('../function.php');
  if(isset($_SESSION['USER_LOGIN']))
        {
        $user_id=$_SESSION['USER_ID'];
        $res=mysqli_query($con,"SELECT * FROM `admin` where `id`='$user_id'");
        $row=mysqli_fetch_assoc($res);
        }else{
            ?>
            <script>
                window.location.href='login/index.php';
            </script>
            <?php
        }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>IRD | ADMIN</title>
    <meta name="title" content="Adex">
    <meta name="description" content="This is a business agency html template made by codewithsadee">

    <!-- 
        - favicon
    -->
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <img src="../assets/images/irdlogo.jpg" alt="" width="50">
            
            <div class="logo-name" style="margin-left: 1rem;"><span style="font-size: 15px;">ပြည်တွင်းအခွန်များဦးစီးဌာန</span></div>
        </a>
        <ul class="side-menu">
            <li><a href="index.php"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li><a href="new_user.php"><i class='bx bxs-user'></i>New User</a></li>
            <li><a href="about.php"><i class=" bx bxs-eject"></i>About IRD</a></li>
            <li class=""><a href="duty.php"><i class=" bx bxs-eject"></i>IRD Duty|Tax Purpose</a></li>
            <li><a href="tax_sytem.php"><i class=" bx bxs-eject"></i>Tax Collection System</a></li>
            <li><a href="tax_history.php"><i class=" bx bxs-eject"></i>Tax Collection History</a></li>
        </ul>
        <ul class="side-menu">
        <?php
        if(isset($_SESSION['USER_LOGIN']))
        {
        $user_id=$_SESSION['USER_ID'];
        $res=mysqli_query($con,"SELECT * FROM `admin` where `id`='$user_id'");
        $row=mysqli_fetch_assoc($res);
        ?>
            <li>
                <a href="login/logout.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        <?php
        
        }else{
          ?>
          <li>
                <a href="login/index.php" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Login
                </a>
            </li>
        <?php
        }
      ?>
            
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <div id="datetime"></div>

            <script>
                function updateDateTime() {
                    const datetimeElement = document.getElementById('datetime');
                    const now = new Date();
                    const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
                    const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
                    const dateString = now.toLocaleDateString(undefined, dateOptions);
                    const timeString = now.toLocaleTimeString(undefined, timeOptions);
                    datetimeElement.textContent = dateString + ' ' + timeString;
                }

                // Update the date and time every second (1000 milliseconds)
                setInterval(updateDateTime, 1000);

                // Initial update
                updateDateTime();
            </script>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <!-- <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a> -->
        </nav>

        <!-- End of Navbar -->