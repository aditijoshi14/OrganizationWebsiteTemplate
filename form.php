<?php
    $nameErr = $emailErr = $messageErr = "";
    $name = $email = $subject = $message = "";
    
	$to = "youraccount@domain.com"; // enter your email address here
	
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["name"])){
        $nameErr = "Your name is required.";
    } else {
        $name = $_POST["name"];
    
        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
            $nameErr = "Your name should only contain letters and white space.";
        }
    }
    
    if(empty($_POST["email"])){
        $emailErr = "Your email is required.";
    }else{
        $email = $_POST["email"];
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "You email address is in invalid format.";
        }
    }
    
    if(empty($_POST["subject"])){
        $subject = "No subject";
    }else{
        $subject = $_POST["subject"];
    }
    
    if(empty($_POST["message"])){
        $messageErr = "Message is required.";
    }else{
        $message = $_POST["message"];
    }
}

	$messageSent = "From: ". $name . "\r\n\r\n" ."Email: ". $email . "\r\n\r\n". $message;

    if(!strcmp($nameErr, "") && !strcmp($emailErr, "") && !strcmp($messageErr, "")){
        if(mail($to, $subject, $messageSent)){
            echo "Thank you for contacting us. <br> <br> Your message was successfully sent.";
        }else{
            echo "Connection Error. <br> <br> We are sorry to inform you that your message was not sent at this moment.";
        }
    }else{
        echo "We are sorry to inform you that your message was not sent at this moment. <br> <br>". $nameErr. "<br> <br>". $emailErr . "<br> <br>". $messageErr;
    }
?>