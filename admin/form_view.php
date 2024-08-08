<?php

  require('../connection.php');
  require('../function.php');
  require_once 'Blowfish.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
                      
  require 'PHPMailer_master/src/Exception.php';
  require 'PHPMailer_master/src/PHPMailer.php';
  require 'PHPMailer_master/src/SMTP.php';

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    *{
        background:#fff;
    }
</style>
<body>
    

        <style>
              .popup-container {
                width:100%;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #fff;
                justify-content: center;
                align-items: center;
                z-index: 1000; /* Adjust the z-index value */
            }

            .popup-content {
              position: relative;
                width:100%;
                margin:auto;
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
                  padding: 8px;
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
              td:nth-child(3) {
                  max-width: 100px; /* Set a maximum width for the second td */
                  overflow: hidden;
                  text-overflow: ellipsis; /* Add ellipsis for overflow text */
              }
              td.id{
                min-width: 30px; 
              }
              .btn{
                  padding: 10px;
                  background-color: #007bff;
                  color: #fff;
                  border: none;
                  border-radius: 5px;
                  cursor: pointer;
              }
              .btn:hover{
                background-color: #0056b3;
              }
              input[type="submit"] {
                  padding: 10px;
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
              td:nth-child(3) {
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
            
            
                  <div class="popup-content " id="popup_content">
                    <!-- <button onclick="closePopup()">Close</button> -->
                    <!-- Your tax payer form content goes here -->
                    <a href="index.php" class="btn" style="position:relative;top:10px;right:0;">Home</a>
                    
                    
                    <h2 style="margin-top:1rem;">The Government of the Republic of the Union of Myanmar</h2>
                    <h2>Tax Demand</h2>
                    
                    <button class="btn" style="margin-top:2rem" id="generate_form">Input key</button>

                    <style>
                        /* Style for the dialog */
                      #generateFormDialog {
                          display: none;
                          position: fixed;
                          top: 50%;
                          left: 50%;
                          transform: translate(-50%, -50%);
                          border: 1px solid #ccc;
                          padding: 20px;
                          background-color: #fff;
                          z-index: 1000;
                          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                      }

                      /* Style for the overlay */
                      #overlay {
                          display: none;
                          position: fixed;
                          top: 0;
                          left: 0;
                          width: 100%;
                          height: 100%;
                          background-color: rgba(0, 0, 0, 0.5);
                          z-index: 999;
                      }

                      /* Style for the form inside the dialog */
                      #generateFormDialog form {
                          display: grid;
                          gap: 10px;
                      }

                      #generateFormDialog label {
                          font-weight: bold;
                      }

                      #generateFormDialog input {
                          width: 100%;
                          padding: 8px;
                          box-sizing: border-box;
                      }

                      #generateFormDialog input[type="submit"],
                      #generateFormDialog button {
                          padding: 10px;
                          background-color: #4CAF50;
                          color: #fff;
                          border: none;
                          cursor: pointer;
                      }

                      #generateFormDialog button {
                          background-color: #f44336;
                      }
                    </style>
                    <!-- The dialog box -->
                    
                    <?php

                     use YourNamespace\Blowfish; 
               
                    if(isset($_GET['id']))
                    {
                    $tax_id=$_GET['id'];
                    
                      $res=mysqli_query($con,"SELECT * FROM `tax_payer_data` where id='$tax_id'");
                      if($row=mysqli_fetch_assoc($res)){
                        $key_res=mysqli_query($con,"SELECT * FROM `key_check` where `tax_id`='$tax_id'");
                        $key_row=mysqli_fetch_assoc($key_res);

                      
                      $key = $key_row['key'];
                      $blowfish = new Blowfish($key);
                      $blockSize = 8;
                        
                       
                      $taxpayer = $row['taxpayer'];
                      $residency=$row['residency'];
                      $company_name=$row['company_name'];
                      $tin=$row['tin'];
                      $date_commencement=$row['date_commencement'];
                      $business_address=$row['business_address'];
                      $office_phone=$row['office_phone'];
                      $email=$row['email'];
                      $industry_code=$row['industry_code'];
                      $income_year=$row['income_year'];
                      $business_income=$row['business_income'];
                      $net_tax=0;
                      $total_quarterly_advance_tax_payments=$row['total_quarterly_advance_tax_payments'];
                      $last_amount_carried_forward=$row['last_amount_carried_forward'];
                      $date=$row['date'];
                      $responsible_person=$row['responsible_person'];
                      if($taxpayer=='Salary income tax'){
                        if($business_income<2000001){
                          $total_advanced=0;
                        }else if($business_income<5000001){
                          $total_advanced=$business_income/100*5;
                        }else if($business_income<10000001){
                          $total_advanced=$business_income/100*10;
                        }else if($business_income<20000001){
                          $total_advanced=$business_income/100*15;
                        }else if($business_income<30000001){
                          $total_advanced=$business_income/100*20;
                        }else{
                          $total_advanced=$business_income/100*25;
                        }
                    }else if($taxpayer=='Commercial tax'){
                      $total_advanced=$business_income/100*5;
                    }else if($taxpayer=='Buildings'){
                      $total_advanced=$business_income/100*3;
                    }else if($taxpayer=='Gold /jewelry'){
                      $total_advanced=$business_income/100*1;
                    }else if($taxpayer=='Personal professional Job'){
                      if($business_income<2000001){
                        $total_advanced=0;
                      }else if($business_income<5000001){
                        $total_advanced=$business_income/100*5;
                      }else if($business_income<10000001){
                        $total_advanced=$business_income/100*10;
                      }else if($business_income<20000001){
                        $total_advanced=$business_income/100*15;
                      }else if($business_income<30000001){
                        $total_advanced=$business_income/100*20;
                      }else{
                        $total_advanced=$business_income/100*25;
                      }
                    }
                      $total_allowable_payment=$total_advanced+$last_amount_carried_forward;
                      $balance_due=$total_allowable_payment-0;
                      $panelty=0;
                      $amount_over=0;
                      $submit_date='-';
                      $due_date='-';

                        if($cyb_taxpayer =$blowfish->encryptBlock($taxpayer)){
                          $taxpayer=bin2hex($cyb_taxpayer);
                        }
                        if($cyb_residency=$blowfish->encryptBlock($residency)){
                          $residency=bin2hex($cyb_residency);
                        }
                        if($cyb_company_name=$blowfish->encryptBlock($company_name)){
                          $company_name=bin2hex($cyb_company_name);
                        }
                        if($cyb_tin=$blowfish->encryptBlock($tin)){
                          $tin=bin2hex($cyb_tin);
                        }
                        if($cyb_date_commencement=$blowfish->encryptBlock($date_commencement)){
                          $date_commencement=bin2hex($cyb_date_commencement);
                        }
                        if($cyb_business_address=$blowfish->encryptBlock($business_address)){
                          $business_address=bin2hex($cyb_business_address);
                        }
                        if($cyb_office_phone=$blowfish->encryptBlock($office_phone)){
                          $office_phone=bin2hex($cyb_office_phone);
                        }
                        if($cyb_email=$blowfish->encryptBlock($email)){
                          $email=bin2hex($cyb_email);
                        }
                        if($cyb_industry_code=$blowfish->encryptBlock($industry_code)){
                          $industry_code=bin2hex($cyb_industry_code);
                        }
                        if($cyb_income_year=$blowfish->encryptBlock($income_year)){
                          $income_year=bin2hex($cyb_income_year);
                        }
                        if($cyb_business_income=$blowfish->encryptBlock($business_income)){
                          $business_income=bin2hex($cyb_business_income);
                        }
                        if($cyb_net_tax=$blowfish->encryptBlock($net_tax)){
                          $net_tax=bin2hex($cyb_net_tax);
                        }
                        if($cyb_total_quarterly_advance_tax_payments=$blowfish->encryptBlock($total_quarterly_advance_tax_payments)){
                          $total_quarterly_advance_tax_payments=bin2hex($cyb_total_quarterly_advance_tax_payments);
                        }
                        if($cyb_last_amount_carried_forward=$blowfish->encryptBlock($last_amount_carried_forward)){
                          $last_amount_carried_forward=bin2hex($cyb_last_amount_carried_forward);
                        }
                        if($cyb_date=$blowfish->encryptBlock($date)){
                          $date=bin2hex($cyb_date);
                        }
                        if($cyb_responsible_person=$blowfish->encryptBlock($responsible_person)){
                          $responsible_person=bin2hex($cyb_responsible_person);
                        }
                        if($cyb_total_advanced=$blowfish->encryptBlock($total_advanced)){
                          $total_advanced=bin2hex($cyb_total_advanced);
                        }
                        if($cyb_total_allowable_payment=$blowfish->encryptBlock($total_allowable_payment)){
                          $total_allowable_payment=bin2hex($cyb_total_allowable_payment);
                        }
                        if($cyb_balance_due=$blowfish->encryptBlock($balance_due)){
                          $balance_due=bin2hex($cyb_balance_due);
                        }
                        if($cyb_panelty=$blowfish->encryptBlock($panelty)){
                          $panelty=bin2hex($cyb_panelty);
                        }
                        if($cyb_amount_over=$blowfish->encryptBlock($amount_over)){
                          $amount_over=bin2hex($cyb_amount_over);
                        }
                        if($cyb_submit_date=$blowfish->encryptBlock($submit_date)){
                          $submit_date=bin2hex($cyb_submit_date);
                        }
                        if($cyb_due_date=$blowfish->encryptBlock($due_date)){
                          $due_date=bin2hex($cyb_due_date);
                        }
                      }

                    }

                    
                    if(isset($_GET['generated_key']) && ($_GET['tax_id'])){
                      $generated_key=$_GET['generated_key'];
                      $tax_id=$_GET['tax_id'];
                      $res=mysqli_query($con,"SELECT * FROM `key_check` where tax_id='$tax_id' and `key`='$generated_key'");
                      $check=mysqli_num_rows($res);
                      if($check>0){
                        $taxres=mysqli_query($con,"SELECT * FROM `tax_payer_data` where id='$tax_id'");
                        $row=mysqli_fetch_assoc($taxres);
                        $taxpayer = $row['taxpayer'];
                        $residency=$row['residency'];
                        $company_name=$row['company_name'];
                        $tin=$row['tin'];
                        $date_commencement=$row['date_commencement'];
                        $business_address=$row['business_address'];
                        $office_phone=$row['office_phone'];
                        $email=$row['email'];
                        $industry_code=$row['industry_code'];
                        $income_year=$row['income_year'];
                        $business_income=$row['business_income'];
                        $net_tax=0;
                        $total_quarterly_advance_tax_payments=$row['total_quarterly_advance_tax_payments'];
                        $last_amount_carried_forward=$row['last_amount_carried_forward'];
                        $date=$row['date'];
                        $responsible_person=$row['responsible_person'];
                        if($taxpayer=='Salary income tax'){
                            if($business_income<2000001){
                              $total_advanced=0;
                            }else if($business_income<5000001){
                              $total_advanced=$business_income/100*5;
                            }else if($business_income<10000001){
                              $total_advanced=$business_income/100*10;
                            }else if($business_income<20000001){
                              $total_advanced=$business_income/100*15;
                            }else if($business_income<30000001){
                              $total_advanced=$business_income/100*20;
                            }else{
                              $total_advanced=$business_income/100*25;
                            }
                        }else if($taxpayer=='Commercial tax'){
                          $total_advanced=$business_income/100*5;
                        }else if($taxpayer=='Buildings'){
                          $total_advanced=$business_income/100*3;
                        }else if($taxpayer=='Gold /jewelry'){
                          $total_advanced=$business_income/100*1;
                        }else if($taxpayer=='Personal professional Job'){
                          if($business_income<2000001){
                            $total_advanced=0;
                          }else if($business_income<5000001){
                            $total_advanced=$business_income/100*5;
                          }else if($business_income<10000001){
                            $total_advanced=$business_income/100*10;
                          }else if($business_income<20000001){
                            $total_advanced=$business_income/100*15;
                          }else if($business_income<30000001){
                            $total_advanced=$business_income/100*20;
                          }else{
                            $total_advanced=$business_income/100*25;
                          }
                        }
                       
                        $total_allowable_payment=$total_advanced+$last_amount_carried_forward;
                        $balance_due=$total_allowable_payment-0;
                        $panelty=0;
                        $amount_over=0;
                        $submit_date='-';
                        $due_date='-';
                        
                      }else{
                        $res=mysqli_query($con,"SELECT * FROM `tax_payer_data` where id='$tax_id'");
                        if($row=mysqli_fetch_assoc($res)){
                          $key_res=mysqli_query($con,"SELECT * FROM `key_check` where `tax_id`='$tax_id'");
                          $key_row=mysqli_fetch_assoc($key_res);

                          
                          $key = $key_row['key'];
                          $blowfish = new Blowfish($key);
                          $blockSize = 8;
                            
                           
                          $taxpayer = $row['taxpayer'];
                          $residency=$row['residency'];
                          $company_name=$row['company_name'];
                          $tin=$row['tin'];
                          $date_commencement=$row['date_commencement'];
                          $business_address=$row['business_address'];
                          $office_phone=$row['office_phone'];
                          $email=$row['email'];
                          $industry_code=$row['industry_code'];
                          $income_year=$row['income_year'];
                          $business_income=$row['business_income'];
                          $net_tax=0;
                          $total_quarterly_advance_tax_payments=$row['total_quarterly_advance_tax_payments'];
                          $last_amount_carried_forward=$row['last_amount_carried_forward'];
                          $date=$row['date'];
                          $responsible_person=$row['responsible_person'];
                          if($taxpayer=='Salary income tax'){
                            if($business_income<2000001){
                              $total_advanced=0;
                            }else if($business_income<5000001){
                              $total_advanced=$business_income/100*5;
                            }else if($business_income<10000001){
                              $total_advanced=$business_income/100*10;
                            }else if($business_income<20000001){
                              $total_advanced=$business_income/100*15;
                            }else if($business_income<30000001){
                              $total_advanced=$business_income/100*20;
                            }else{
                              $total_advanced=$business_income/100*25;
                            }
                        }else if($taxpayer=='Commercial tax'){
                          $total_advanced=$business_income/100*5;
                        }else if($taxpayer=='Buildings'){
                          $total_advanced=$business_income/100*3;
                        }else if($taxpayer=='Gold /jewelry'){
                          $total_advanced=$business_income/100*1;
                        }else if($taxpayer=='Personal professional Job'){
                          if($business_income<2000001){
                            $total_advanced=0;
                          }else if($business_income<5000001){
                            $total_advanced=$business_income/100*5;
                          }else if($business_income<10000001){
                            $total_advanced=$business_income/100*10;
                          }else if($business_income<20000001){
                            $total_advanced=$business_income/100*15;
                          }else if($business_income<30000001){
                            $total_advanced=$business_income/100*20;
                          }else{
                            $total_advanced=$business_income/100*25;
                          }
                        }
                          $total_allowable_payment=$total_advanced+$last_amount_carried_forward;
                          $balance_due=$total_allowable_payment-0;
                          $panelty=0;
                          $amount_over=0;
                          $submit_date='-';
                          $due_date='-';
    
                            if($cyb_taxpayer =$blowfish->encryptBlock($taxpayer)){
                              $taxpayer=bin2hex($cyb_taxpayer);
                            }
                            if($cyb_residency=$blowfish->encryptBlock($residency)){
                              $residency=bin2hex($cyb_residency);
                            }
                            if($cyb_company_name=$blowfish->encryptBlock($company_name)){
                              $company_name=bin2hex($cyb_company_name);
                            }
                            if($cyb_tin=$blowfish->encryptBlock($tin)){
                              $tin=bin2hex($cyb_tin);
                            }
                            if($cyb_date_commencement=$blowfish->encryptBlock($date_commencement)){
                              $date_commencement=bin2hex($cyb_date_commencement);
                            }
                            if($cyb_business_address=$blowfish->encryptBlock($business_address)){
                              $business_address=bin2hex($cyb_business_address);
                            }
                            if($cyb_office_phone=$blowfish->encryptBlock($office_phone)){
                              $office_phone=bin2hex($cyb_office_phone);
                            }
                            if($cyb_email=$blowfish->encryptBlock($email)){
                              $email=bin2hex($cyb_email);
                            }
                            if($cyb_industry_code=$blowfish->encryptBlock($industry_code)){
                              $industry_code=bin2hex($cyb_industry_code);
                            }
                            if($cyb_income_year=$blowfish->encryptBlock($income_year)){
                              $income_year=bin2hex($cyb_income_year);
                            }
                            if($cyb_business_income=$blowfish->encryptBlock($business_income)){
                              $business_income=bin2hex($cyb_business_income);
                            }
                            if($cyb_net_tax=$blowfish->encryptBlock($net_tax)){
                              $net_tax=bin2hex($cyb_net_tax);
                            }
                            if($cyb_total_quarterly_advance_tax_payments=$blowfish->encryptBlock($total_quarterly_advance_tax_payments)){
                              $total_quarterly_advance_tax_payments=bin2hex($cyb_total_quarterly_advance_tax_payments);
                            }
                            if($cyb_last_amount_carried_forward=$blowfish->encryptBlock($last_amount_carried_forward)){
                              $last_amount_carried_forward=bin2hex($cyb_last_amount_carried_forward);
                            }
                            if($cyb_date=$blowfish->encryptBlock($date)){
                              $date=bin2hex($cyb_date);
                            }
                            if($cyb_responsible_person=$blowfish->encryptBlock($responsible_person)){
                              $responsible_person=bin2hex($cyb_responsible_person);
                            }
                            if($cyb_total_advanced=$blowfish->encryptBlock($total_advanced)){
                              $total_advanced=bin2hex($cyb_total_advanced);
                            }
                            if($cyb_total_allowable_payment=$blowfish->encryptBlock($total_allowable_payment)){
                              $total_allowable_payment=bin2hex($cyb_total_allowable_payment);
                            }
                            if($cyb_balance_due=$blowfish->encryptBlock($balance_due)){
                              $balance_due=bin2hex($cyb_balance_due);
                            }
                            if($cyb_panelty=$blowfish->encryptBlock($panelty)){
                              $panelty=bin2hex($cyb_panelty);
                            }
                            if($cyb_amount_over=$blowfish->encryptBlock($amount_over)){
                              $amount_over=bin2hex($cyb_amount_over);
                            }
                            if($cyb_submit_date=$blowfish->encryptBlock($submit_date)){
                              $submit_date=bin2hex($cyb_submit_date);
                            }
                            if($cyb_due_date=$blowfish->encryptBlock($due_date)){
                              $due_date=bin2hex($cyb_due_date);
                            }
                      }

                      }
                    }
                    ?>
                    <div id="generateFormDialog">
                        <!-- Your form content goes here -->

                        <form>
                            <label for="generated_key">Security Key:</label>
                            <input type="text" id="tax_id" name="tax_id" value=<?php echo $tax_id ?> style="display:none;">
                            <input type="text" id="generated_key" name="generated_key" >
                            <input type="submit" value="OK">
                            <button type="button" onclick="closeDialog()">Close</button>
                        </form>
                    </div>
                    <script>
                        // Get the button and the dialog
                        var generateFormButton = document.getElementById('generate_form');
                        var generateFormDialog = document.getElementById('generateFormDialog');
                        var overlay = document.getElementById('overlay');

                        // Show the dialog and overlay when the button is clicked
                        generateFormButton.addEventListener('click', function() {
                            generateFormDialog.style.display = 'block';
                            overlay.style.display = 'block';
                        });

                        // Close the dialog and overlay
                        function closeDialog() {
                            generateFormDialog.style.display = 'none';
                            overlay.style.display = 'none';
                        }
                    </script>

                    <!-- The overlay -->
                    <div id="overlay"></div>
          
                    
                      <!-- <table>
                        <tr>
                          <td class="id">1</td>
                          <td>Type of Taxpayer</td>
                          <td><?php echo $taxpayer ?></td>
                        </tr>
                        <tr>
                          <td class="id">2</td>
                          <td>Residency</td>
                          <td><?php echo $residency ?></td>
                        </tr>
                        <tr>
                          <td class="id">3</td>
                          <td>Company Name</td>
                          <td><?php echo $company_name ?></td>
                        </tr>
                        <tr>
                          <td class="id">4</td>
                          <td>Taxpayer Identification Number (TIN)</td>
                          <td><?php echo $tin ?></td>
                        </tr>
                        <tr>
                          <td class="id">5</td>
                          <td>Date of Commencement of Operation</td>
                          <td><?php echo $date_commencement ?></td>
                        </tr>
                        <tr>
                          <td class="id">6</td>
                          <td> Business Contact Address</td>
                          <td><?php echo $business_address ?></td>
                        </tr>
                        <tr>
                          <td class="id">7</td>
                          <td>Office Contact Phone Number</td>
                          <td><?php echo $office_phone ?></td>
                        </tr>
                        <tr>
                          <td class="id">8</td>
                          <td>Contact Email Address</td>
                          <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                          <td class="id">9</td>
                          <td>Industry Code</td>
                          <td><?php echo $industry_code ?></td>
                        </tr>
                        <tr>
                          <td class="id">10</td>
                          <td>Income Year</td>
                          <td><?php echo $income_year ?></td>
                        </tr>
                        <tr>
                          <td class="id">11</td>
                          <td>Business Income</td>
                          <td><?php echo $business_income ?></td>
                        </tr>
                        <tr>
                          <td class="id">12</td>
                          <td>NET TAX BEFORE PAYMENTS</td>
                          <td><?php echo $net_tax ?></td>
                        </tr>
                        <tr>
                          <td class="id">13</td>
                          <td>TOTAL QUARTERLY ADVANCE TAX PAYMENTS</td>
                          <td><?php echo $total_advanced ?></td>
                        </tr>
                        <tr>
                          <td class="id">14</td>
                          <td>Amount of Tax Overpaid Last Year Carried Forward To This Year</td>
                          <td><?php echo $last_amount_carried_forward ?></td>
                        </tr>
                        <tr>
                          <td class="id">15</td>
                          <td>TOTAL ALLOWABLE PAYMENTS MADE DURING THE YEAR (ENTER THE SUM OF LINE 13 AND LINE 14)IF NO PAYMENTS MADE, ENTER ZERO.</td>
                          <td><?php echo $total_allowable_payment ?></td>
                        </tr>
                        <tr>
                          <td class="id">16</td>
                          <td>BALANCE DUE (SUBTRACT LINE 12 FROM LINE 15). IF ZERO OR LESS, ENTER ZERO.</td>
                          <td><?php echo $balance_due ?></td>
                        </tr>
                        <tr>
                          <td class="id">17</td>
                          <td>PENALTY</td>
                          <td><?php echo $panelty ?></td>
                        </tr>
                        <tr>
                          <td class="id">18</td>
                          <td>REMAINING TAX TO BE PAID (ADD LINE 16 AND LINE 17)</td>
                          <td><?php echo $balance_due ?></td>
                        </tr>
                        <tr>
                          <td class="id">19</td>
                          <td>AMOUNT OVERPAID</td>
                          <td><?php echo $amount_over ?></td>
                        </tr>
                        <tr>
                          <td class="id">20</td>
                          <td>RETURN SUMMITTED DATE</td>
                          <td><?php echo $submit_date ?></td>
                        </tr>
                        <tr>
                          <td class="id">21</td>
                          <td>DEMAND SUMMITTED DATE</td>
                          <td><?php echo $date ?></td>
                        </tr>
                        <tr>
                          <td class="id">22</td>
                          <td>DUE DATE FOR TAX PAYMENT</td>
                          <td><?php echo $due_date ?></td>
                        </tr>
                      </table> -->
                      <table>
                        <tr>
                          <td class="id">1</td>
                          <td>Type of Taxpayer</td>
                          <td><?php echo $taxpayer ?></td>
                        </tr>
                        <tr>
                          <td class="id">2</td>
                          <td>Residency</td>
                          <td><?php echo $residency ?></td>
                        </tr>
                        <tr>
                          <td class="id">3</td>
                          <td>Company Name</td>
                          <td><?php echo $company_name ?></td>
                        </tr>
                        <tr>
                          <td class="id">4</td>
                          <td>Taxpayer Identification Number (TIN)</td>
                          <td><?php echo $tin ?></td>
                        </tr>
                        <tr>
                          <td class="id">5</td>
                          <td>Date of Commencement of Operation</td>
                          <td><?php echo $date_commencement ?></td>
                        </tr>
                        <tr>
                          <td class="id">6</td>
                          <td> Business Contact Address</td>
                          <td><?php echo $business_address ?></td>
                        </tr>
                        <tr>
                          <td class="id">7</td>
                          <td>Office Contact Phone Number</td>
                          <td><?php echo $office_phone ?></td>
                        </tr>
                        <tr>
                          <td class="id">8</td>
                          <td>Contact Email Address</td>
                          <td><?php echo $email ?></td>
                        </tr>
                        <tr>
                          <td class="id">9</td>
                          <td>Industry Code</td>
                          <td><?php echo $industry_code ?></td>
                        </tr>
                        <tr>
                          <td class="id">10</td>
                          <td>Income Year</td>
                          <td><?php echo $income_year ?></td>
                        </tr>
                        <tr>
                          <td class="id">11</td>
                          <td>Business Income</td>
                          <td><?php echo $business_income ?></td>
                        </tr>
                        <tr>
                          <td class="id">12</td>
                          <td>Total Quarterly Advance Tax Payments</td>
                          <td><?php echo $total_quarterly_advance_tax_payments ?></td>
                        </tr>
                        <tr>
                          <td class="id">13</td>
                          <td>Amount of Tax Overpaid Last Year Carried Forward To This Year</td>
                          <td><?php echo $last_amount_carried_forward ?></td>
                        </tr>
                        <tr>
                          <td class="id">14</td>
                          <td>Date</td>
                          <td><?php echo $date ?></td>
                        </tr>
                        <tr>
                          <td class="id">15</td>
                          <td>Responsible Person</td>
                          <td><?php echo $responsible_person ?></td>
                        </tr>
                      </table>
 
                    

                    
                    

                      <!-- <button id="download" class="btn">Download PDF</button> -->

                      <script>
                      var element = document.getElementById('popup_content');
                          document.getElementById('download').addEventListener('click', function(event) {
                              event.preventDefault(); // Assuming you want to prevent the default behavior of the button

                              var otp=
                              {
                                margin:1,
                                filename:'tax_payment_form_.pdf',
                                html2canvas:{sacle:2},
                                jsPDF:{unit:'in',format:'A4',orientation:'portrait'}
                              };

                              html2pdf().set(otp).from(element).save();
                          });
                      </script>
                    <!-- Add your form elements here -->
                    
                    <?php
                    if(isset($_GET['generated_key']) && isset($_GET['tax_id'])){
                        $generated_key = $_GET['generated_key'];
                        $tax_id = $_GET['tax_id'];
                        $res = mysqli_query($con, "SELECT * FROM `key_check` where tax_id='$tax_id' and `key`='$generated_key'");
                        $check = mysqli_num_rows($res);
                        if ($check > 0) { ?>
                            <form method="post" action="">
                                <input type="hidden" name="send_email" value="1">
                                <button type="submit" class="btn">Send Submit Form to <?php echo $company_name ?> By Email</button>
                            </form>
                        <?php }
                    }
                    ?>

                    <?php
                    if (isset($_POST['send_email']) && $_POST['send_email'] == 1) {
                      
                      $table_content='
                      <style>
                      table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
          
                        table, th, td {
                            border: 1px solid black;
                        }
          
                        th, td {
                            padding: 8px;
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
                        td:nth-child(3) {
                            max-width: 100px; /* Set a maximum width for the second td */
                            overflow: hidden;
                            text-overflow: ellipsis; /* Add ellipsis for overflow text */
                        }
                        td.id{
                          min-width: 30px; 
                        }
                        .btn{
                            padding: 10px;
                            background-color: #007bff;
                            color: #fff;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }
                        .btn:hover{
                          background-color: #0056b3;
                        }
                        input[type="submit"] {
                            padding: 10px;
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
                        td:nth-child(3) {
                            max-width: 75px; /* Set a maximum width for the second td */
                            overflow: hidden;
                            text-overflow: ellipsis; /* Add ellipsis for overflow text */
                        }
                        td.id{
                          min-width: 15px; 
                        }
                      </style>
                      <table>
                        <tr>
                          <td class="id">1</td>
                          <td>Type of Taxpayer</td>
                          <td>'. $taxpayer .'</td>
                        </tr>
                        <tr>
                          <td class="id">2</td>
                          <td>Residency</td>
                          <td>'. $residency .'</td>
                        </tr>
                        <tr>
                          <td class="id">3</td>
                          <td>Company Name</td>
                          <td>'. $company_name .'</td>
                        </tr>
                        <tr>
                          <td class="id">4</td>
                          <td>Taxpayer Identification Number (TIN)</td>
                          <td>'. $tin .'</td>
                        </tr>
                        <tr>
                          <td class="id">5</td>
                          <td>Date of Commencement of Operation</td>
                          <td>'. $date_commencement .'</td>
                        </tr>
                        <tr>
                          <td class="id">6</td>
                          <td> Business Contact Address</td>
                          <td>'. $business_address .'</td>
                        </tr>
                        <tr>
                          <td class="id">7</td>
                          <td>Office Contact Phone Number</td>
                          <td>'. $office_phone .'</td>
                        </tr>
                        <tr>
                          <td class="id">8</td>
                          <td>Contact Email Address</td>
                          <td>'. $email .'</td>
                        </tr>
                        <tr>
                          <td class="id">9</td>
                          <td>Industry Code</td>
                          <td>'. $industry_code .'</td>
                        </tr>
                        <tr>
                          <td class="id">10</td>
                          <td>Income Year</td>
                          <td>'. $income_year .'</td>
                        </tr>
                        <tr>
                          <td class="id">11</td>
                          <td>Business Income</td>
                          <td>'. $business_income .'</td>
                        </tr>
                        <tr>
                          <td class="id">12</td>
                          <td>NET TAX BEFORE PAYMENTS</td>
                          <td>'. $net_tax .'</td>
                        </tr>
                        <tr>
                          <td class="id">13</td>
                          <td>TOTAL QUARTERLY ADVANCE TAX PAYMENTS</td>
                          <td>'. $total_advanced .'</td>
                        </tr>
                        <tr>
                          <td class="id">14</td>
                          <td>Amount of Tax Overpaid Last Year Carried Forward To This Year</td>
                          <td>'. $last_amount_carried_forward .'</td>
                        </tr>
                        <tr>
                          <td class="id">15</td>
                          <td>TOTAL ALLOWABLE PAYMENTS MADE DURING THE YEAR (ENTER THE SUM OF LINE 13 AND LINE 14)IF NO PAYMENTS MADE, ENTER ZERO.</td>
                          <td>'. $total_allowable_payment .'</td>
                        </tr>
                        <tr>
                          <td class="id">16</td>
                          <td>BALANCE DUE (SUBTRACT LINE 12 FROM LINE 15). IF ZERO OR LESS, ENTER ZERO.</td>
                          <td>'. $balance_due .'</td>
                        </tr>
                        <tr>
                          <td class="id">17</td>
                          <td>PENALTY</td>
                          <td>'. $panelty .'</td>
                        </tr>
                        <tr>
                          <td class="id">18</td>
                          <td>REMAINING TAX TO BE PAID (ADD LINE 16 AND LINE 17)</td>
                          <td>'. $balance_due .'</td>
                        </tr>
                        <tr>
                          <td class="id">19</td>
                          <td>AMOUNT OVERPAID</td>
                          <td>'. $amount_over .'</td>
                        </tr>
                        <tr>
                          <td class="id">20</td>
                          <td>RETURN SUMMITTED DATE</td>
                          <td>'. $submit_date .'</td>
                        </tr>
                        <tr>
                          <td class="id">21</td>
                          <td>DEMAND SUMMITTED DATE</td>
                          <td>'. $date .'</td>
                        </tr>
                        <tr>
                          <td class="id">22</td>
                          <td>DUE DATE FOR TAX PAYMENT</td>
                          <td>'. $due_date .'</td>
                        </tr>
                      </table>';
                      
                      $mail = new PHPMailer(true);
        
                      try {
                          //Server settings
                          $mail->isSMTP();
                          $mail->Host       = 'smtp.gmail.com';  // Specify the SMTP server
                          $mail->SMTPAuth   = true;               // Enable SMTP authentication
                          $mail->Username   = 'aungnyinyimin32439@gmail.com';   // SMTP username
                          $mail->Password   = 'gdbcegflheqtzjjd';    // SMTP password
                          $mail->SMTPSecure = 'tls';              // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                          $mail->Port       = 587;                // TCP port to connect to, use 587 for TLS, 465 for SSL
                          
                          //Recipients
                          $mail->setFrom('aungnyinyimin32439@gmail.com', 'beautiful life');
                          $mail->addAddress($email);
                      
                          //Content
                          $mail->isHTML(true);
                          $mail->Subject = 'Keep that generated key safety';
                          $mail->Body = '<html><body>'.$table_content.'</body></html>';
                      
                          $mail->send();
                          echo 'Email has been sent successfully!';
                      } catch (Exception $e) {
                          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                      }
                    }
                    ?>
                </div>
            </div>
            
              <!-- Button to trigger the conversion -->
            

              <!-- <a href="#" class="btn btn-outline">Contact Us</a> -->

            </div>
            

          </div>
          
</body>

                    