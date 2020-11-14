<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if(isset($_POST['send'])){
    $back = $_SERVER['HTTP_REFERER'];
require   $_SERVER['DOCUMENT_ROOT']."/include/SHOPDIRECTDB.php";
$conn = new mysqli($DBHost,$DBUser, $DBPassword,$DBName);
            if ($conn->connect_error){
              die("Connection Failed". $conn->connect_error);
            
            }
           //retrieve setting info
           $table = "u1_smtp";
            $sql = "SELECT * FROM {$table}  ";
            $query = $conn->query($sql);
            
            while($row=$query->fetch_array()){
                $smtphost = $row['host'];
                $smtpusername = $row['username'];
                $smtppassword = $row['password'];
                $smtpport = $row['port'];
                $smtpsubject = $row['subject'];
            }

    $email = $_POST['email'] ? $_POST['email'] : "" ;
    $subject = $_POST['subject'] ?  $_POST['subject'] : "" ;
    $message = $_POST['message'] ? $_POST['message'] : "" ;

    $filename = "abutech";
    $location = 'attachment/' . $filename;
    move_uploaded_file($_FILES['attachment']['tmp_name'], $location);

    //Load composer's autoloader
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host =  $smtphost;                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username =  $smtpusername;     // Your Email/ Server Email
        $mail->Password =  $smtppassword;                     // Your Password
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port =  $smtpport ;                                   

        //Send Email
        $mail->setFrom($smtpusername);
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo($smtpusername);
        
        //Attachment
        /*if(!empty($filename)){
            $mail->addAttachment($location, $filename); 
            
        }*/
       
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $_SESSION['message'] = 'Message has been sent';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
    }

   echo "<script>
                alert('Message Successful Sent');
                window.location.href='$back';   
                </script>";
}
else{
    $_SESSION['message'] = 'Please fill up the form first';
    echo "<script>
                window.location.href='$back';   
                </script>";
}