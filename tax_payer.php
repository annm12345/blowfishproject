<?php
require('connection.php');
require('function.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['id'])) {
    $user_id = get_safe_value($con, $_GET['id']);

    if (isset($_POST['fill_form'])) {
        $taxpayer = get_safe_value($con, $_POST['taxpayer']);
        $residency = get_safe_value($con, $_POST['Residency']);
        $company_name = get_safe_value($con, $_POST['Company']);
        $tin = get_safe_value($con, $_POST['TIN']);
        $date_commencement = get_safe_value($con, $_POST['date_commencement']);
        $business_address = get_safe_value($con, $_POST['Business_address']);
        $office_phone = get_safe_value($con, $_POST['office_phone']);
        $email = get_safe_value($con, $_POST['email']);
        $industry_code = get_safe_value($con, $_POST['industry_code']);
        $income_year = get_safe_value($con, $_POST['income_year']);
        $business_income = get_safe_value($con, $_POST['income']);
        $total_quarterly_advance_tax_payments = get_safe_value($con, $_POST['total']);
        $last_amount_carried_forward = get_safe_value($con, $_POST['last_amount']);
        $date = get_safe_value($con, $_POST['date']);
        $responsible_person = get_safe_value($con, $_POST['responsible_person']);

        // Perform necessary database operations with the collected data
        // For example, you can insert this data into the database

        // Example SQL query to insert data into a table named 'tax_payer_data'
        $sql = "INSERT INTO tax_payer_data (user_id, taxpayer, residency, company_name, tin, date_commencement, business_address, office_phone, email, industry_code, income_year, business_income, total_quarterly_advance_tax_payments, last_amount_carried_forward, `date`, responsible_person) VALUES ('$user_id', '$taxpayer', '$residency', '$company_name', '$tin', '$date_commencement', '$business_address', '$office_phone', '$email', '$industry_code', '$income_year', '$business_income', '$total_quarterly_advance_tax_payments', '$last_amount_carried_forward', '$date', '$responsible_person')";
        // Execute the query
        mysqli_query($con, $sql);
        $tax_id = mysqli_insert_id($con);
        function generateRandomKey($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKMNLOPQRSTUVWXYZ!@#$%^&*';
            $randomKey = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomKey .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            return $randomKey;
        }
        
        // Usage example
        $generated_key = generateRandomKey(4);
        mysqli_query($con,"INSERT INTO `key_check`( `tax_id`, `key`) VALUES ('$tax_id','$generated_key')");


      
        
        require 'PHPMailer_master/src/Exception.php';
        require 'PHPMailer_master/src/PHPMailer.php';
        require 'PHPMailer_master/src/SMTP.php';
        
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
            $mail->Body = $company_name . ' ၏အခွန်ထမ်းမှတ်ပုံတင်ဖြည့်သွင်းခြင်း အောင်မြင်ပါသည်။ ကျေးဇူးပြု၍ generated key အား လုံခြုံရေးအရ မည်သူတစ်ဦးတစ်ယောက်ကိုမျှ မပြန်ရန် တောင်းဆိုပါတယ်။ <br>လုပ်ငန်းစဉ်နံပါတ်: ' . $tax_id . '<br>လုံခြုံရေးနံပါတ်: ' . $generated_key;
        
            $mail->send();
            echo 'Email has been sent successfully!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
            


            
        ?>
        <script>
            alert('အခွန်ထမ်းမှတ်ပုံတင်ခြင်းအောင်မြင်ပါသည်။');
            window.location.href='index.php';
        </script>
        <?php

        
        
        
        exit();
    }
}
?>
