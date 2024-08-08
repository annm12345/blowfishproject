<?php
  require('connection.php');
  require('function.php');
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tags
  -->
  <title>ပြည်တွင်းအခွန်များဦးစီးဌာန</title>
  <meta name="title" content="Adex">
  <meta name="description" content="This is a business agency html template made by codewithsadee">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;700&display=swap" rel="stylesheet">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-bg.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-slide-1.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-slide-2.jpg">
  <link rel="preload" as="image" href="./assets/images/hero-slide-3.jpg">

</head>

<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="./assets/images/myanmar.png" width="74" height="24" alt="Adex home" class="logo-light">
      
        

        <img src="./assets/images/myanmar.png" width="74" height="24" alt="Adex home" class="logo-dark">        
      </a>
      <h3>ပြည်တွင်းအခွန်များဦးစီးဌာန</h3>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">
            <img src="./assets/images/myanmar.png" width="74" height="24" alt="Adex home">
            <p>ဘဏ္ဍာရေးနှင့်စီမံကိန်းဝန်ကြီးဌာန</p> <br>
            <p>ပြည်တွင်းအခွန်များဦးစီးဌာန</p>
          </a>
          

          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>
       

        <ul class="navbar-list">

          <li>
            <a href="index.php" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="tax_teraties.php" class="navbar-link">Tax Treaties</a>
          </li>

          <li>
            <a href="policy.php" class="navbar-link">Policy & Law</a>
          </li>
          <!-- 
          <li>
            <a href="#" class="navbar-link">Blog</a>
          </li> 
          -->

          <li>
            <a href="contact.php" class="navbar-link">Contact</a>
          </li>

        </ul>

        <div class="wrapper">
          <a href="mailto:info@email.com" class="contact-link">info@email.com</a>

          <a href="tel:001234567890" class="contact-link">00 (123) 456 78 90</a>
        </div>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-dribbble"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>
      <?php
        if(isset($_SESSION['USER_LOGIN']))
        {
        $user_id=$_SESSION['USER_ID'];
        $res=mysqli_query($con,"SELECT * FROM `user` where `id`='$user_id'");
        $row=mysqli_fetch_assoc($res);
        ?>
        <a class="navbar-link"><?php echo $row['name'] ?></a>
        <a href="login/logout.php" class="btn btn-primary">Logout</a>
        <?php
        
        }else{
          ?>
          <a href="login/index.php" class="btn btn-primary">Login</a>
        <?php
        }
      ?>

      

      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
      </button>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>

  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="section hero has-bg-image" aria-label="home"
        style="background-image: url('./assets/images/hero-bg.jpg')">
        <div class="container">

          <div class="hero-content">

            <h1 class="h1 hero-title">Crafting project specific solutions with expertise.</h1>

            <p class="hero-text">
              We’re a creative company that focuses on establishing long-term relationships with customers.
            </p>

            <div class="btn-wrapper">
            <?php
            if(isset($_SESSION['USER_LOGIN']))
            {
              ?>
              <button  class="btn btn-primary" id="ird_btn">အခွန်ထမ်းမှတ်ပုံတင်ရန်</button>
              <?php
            }else{
              ?>
              <a href="login/index.php" class="btn btn-primary">အခွန်ထမ်းမှတ်ပုံတင်ရန်</a>
              <?php
            }
            ?>
            <style>
              .popup-container {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
                z-index: 1000; /* Adjust the z-index value */
            }

            .popup-content {
                background: #fff;
                padding: 2rem;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                z-index: 1001; /* Ensure the popup content appears above the overlay */
            }

              /* .btn {
                  padding: 10px;
                  background-color: #007bff;
                  color: #fff;
                  text-decoration: none;
                  border-radius: 5px;
                  cursor: pointer;
              }

              .btn:hover {
                  background-color: #0056b3;
              } */

              table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-bottom: 20px;
              }

              table, th, td {
                  border: 1px solid #ddd;
              }

              th, td {
                  padding: 5px;
                  text-align: left;
                  min-width: 200px;
                  word-wrap: break-word;
                   /* Set a minimum width for empty cells */
              }
              td:nth-child(2) {
                  max-width: 100px; /* Set a maximum width for the second td */
                  overflow: hidden;
                  text-overflow: ellipsis; /* Add ellipsis for overflow text */
              }
              td.id{
                min-width: 30px; 
              }

              input[type="submit"] {
                  padding: 7px;
                  background-color: #007bff;
                  color: #fff;
                  border: none;
                  border-radius: 5px;
                  cursor: pointer;
              }
              input[type="text"],input[type="email"],input[type="tel"],input[type="date"] {
                  outline:none;
              }
              

              input[type="submit"]:hover {
                  background-color: #0056b3;
              }
              @media only screen and (max-width: 600px) {
                .popup-content {
                    background: #fff;
                    padding: 1rem;
                    /* Ensure the popup content appears above the overlay */
                }
                h2{
                  font-size: 14px;
                }
            th, td {
              padding:3px;
                min-width: 100px; /* Adjust minimum width for small screens */
                font-size: 12px; /* Adjust font size for small screens */
            }
            td:nth-child(2) {
                  max-width: 75px; /* Set a maximum width for the second td */
                  overflow: hidden;
                  text-overflow: ellipsis; /* Add ellipsis for overflow text */
              }
              td.id{
                min-width: 15px; 
              }
        }

            </style>
            <div class="popup-container" id="popupContainer">
                <div class="popup-content">
                    <button onclick="closePopup()">Close</button>
                    <!-- Your tax payer form content goes here -->
                    <h5 style="text-align:right;">patakha - (kathakha) - 11a</h5>
                    <h2>The Government of the Republic of the Union of Myanmar</h2>
                    <h2>Annual Commercial Tax Return</h2>
                    <?php
                    if(isset($_SESSION['USER_LOGIN']))
                    {
                    $user_id=$_SESSION['USER_ID'];}
                    ?>
                    <form action="tax_payer.php?id=<?php echo $user_id ?>" method="post">
                      <table>
                        <tr>
                          <td class="id">1</td>
                          <td>Type of Taxpayer</td>
                          <td><select name="taxpayer" id="" required>
                            <option value="">Select Type of taxpayer</option>
                            <option value="Salary income tax">Salary income tax</option>
                            <option value="Commercial tax">Commercial tax</option>
                            <option value="Buildings">Buildings</option>
                            <option value="Gold /jewelry">Gold /jewelry</option>
                            <option value="Personal professional Job">Personal professional Job</option>
                          </select></td>
                        </tr>
                        <tr>
                          <td class="id">2</td>
                          <td>Residency</td>
                          <td><input type="text" name="Residency" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">3</td>
                          <td>Company Name</td>
                          <td><input type="text" name="Company" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">4</td>
                          <td>Taxpayer Identification Number (TIN)</td>
                          <td><input type="text" name="TIN" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">5</td>
                          <td>Date of Commencement of Operation</td>
                          <td><input type="date" name="date_commencement" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">6</td>
                          <td> Business Contact Address</td>
                          <td><input type="text" name="Business_address" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">7</td>
                          <td>Office Contact Phone Number</td>
                          <td><input type="tel" name="office_phone" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">8</td>
                          <td>Contact Email Address</td>
                          <td><input type="email" name="email" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">9</td>
                          <td>Industry Code</td>
                          <td><input type="text" name="industry_code" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">10</td>
                          <td>Income Year</td>
                          <td><input type="text" name="income_year" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">11</td>
                          <td>Business Income</td>
                          <td><input type="text" name="income" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">12</td>
                          <td>Total Quarterly Advance Tax Payments</td>
                          <td><input type="text" name="total" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">13</td>
                          <td>Amount of Tax Overpaid Last Year Carried Forward To This Year</td>
                          <td><input type="text" name="last_amount" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">14</td>
                          <td>Date</td>
                          <td><input type="date" name="date" id="" required></td>
                        </tr>
                        <tr>
                          <td class="id">15</td>
                          <td>Responsible Person</td>
                          <td><input type="text" name="responsible_person" id="" required></td>
                        </tr>
                      </table>
                      <input type="submit" value="Save" name="fill_form">
                    </form>
                    <!-- Add your form elements here -->
                    
                </div>
            </div>
            <script>
              document.getElementById("ird_btn").addEventListener("click", function () {
                // Show the popup
                document.getElementById("popupContainer").style.display = "flex";
              });

              function closePopup() {
                // Close the popup
                document.getElementById("popupContainer").style.display = "none";
              }

            </script>

              

              <!-- <a href="#" class="btn btn-outline">Contact Us</a> -->

            </div>

          </div>

          <div class="hero-slider" data-slider>

            <div class="slider-inner">
              <ul class="slider-container" data-slider-container>

                <li class="slider-item">

                  <figure class="img-holder" style="--width: 575; --height: 550;">
                    <img src="./assets/images/banner.jpg" width="575" height="550" alt="" class="img-cover">
                  </figure>

                </li>

                <li class="slider-item">

                  <div class="hero-card">
                    <figure class="img-holder" style="--width: 575; --height: 550;">
                      <img src="./assets/images/banner2.jpg" width="575" height="550" alt="hero banner"
                        class="img-cover">
                    </figure>

                    <button class="play-btn" aria-label="play adex intro">
                      <ion-icon name="play" aria-hidden="true"></ion-icon>
                    </button>
                  </div>

                </li>

                <li class="slider-item">

                  <figure class="img-holder" style="--width: 575; --height: 550;">
                    <img src="./assets/images/banner3.jpg" width="575" height="550" alt="" class="img-cover">
                  </figure>

                </li>

              </ul>
            </div>

            <button class="slider-btn prev" aria-label="slide to previous" data-slider-prev>
              <ion-icon name="arrow-back"></ion-icon>
            </button>

            <button class="slider-btn next" aria-label="slide to next" data-slider-next>
              <ion-icon name="arrow-forward"></ion-icon>
            </button>

          </div>

        </div>
      </section>


