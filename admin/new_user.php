<?php
require('top.php'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
                      
require 'PHPMailer_master/src/Exception.php';
require 'PHPMailer_master/src/PHPMailer.php';
require 'PHPMailer_master/src/SMTP.php';
if(isset($_GET['id']) && isset($_GET['action']) && isset($_GET['email'])){
    $id=$_GET['id'];
    $action=$_GET['action'];
    $email=$_GET['email'];
    if($action=='setotp'){
        function generateRandomKey($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKMNLOPQRSTUVWXYZ!@#$%^&*';
            $randomKey = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomKey .= $characters[rand(0, strlen($characters) - 1)];
            }
        
            return $randomKey;
        }
        
        // Usage example
        $generated_key = generateRandomKey(8);
        mysqli_query($con,"UPDATE `user` SET `password`='$generated_key' WHERE `id`='$id'");
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
                          $mail->Body = '<html><body><p>Your password by admin : '.$generated_key.'</body></html>';
                      
                          $mail->send();
                          echo 'Email has been sent to User!';
                      } catch (Exception $e) {
                          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                      }

    }
}
?>

    <style>
        table {
        width: 80%;
        margin:auto;
        margin-top:2rem;
        border-collapse: collapse;
        margin-bottom: ;
        }
        
        th, td {
        padding: 1.5rem;
        text-align: left;
        border-bottom: 1px solid #ddd;
        }
        
        th {
        background-color: #f2f2f2;
        color: #333;
        }
        
        tr:nth-child(even) {
        background-color: #f2f2f2;
        }
        
        @media screen and (max-width: 600px) {
        table {
            border: 0;
        }
        th, td {
            border-bottom: 1px solid #ddd;
        }
        }
    </style>
    <table>
    <thead>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        
            $res=mysqli_query($con,"SELECT * FROM `user` WHERE `password`=''");
            if(mysqli_num_rows($res)){
                while($row=mysqli_fetch_assoc($res)){
                    

                
        ?>
        <tr>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><a href="new_user.php?id=<?php echo $row['id'] ?>&action=setotp&email=<?php echo $row['email'] ?>" style="text-decoration:none;background:green;color:#fff;padding:1rem;border-radius:0.5rem;">Comfirm User</a></td>
        </tr>
        <?php
                }
            }
        
        ?>
    </tbody>
    </table>

        </main>

    </div>

    <script src="index.js"></script>
</body>

</html>