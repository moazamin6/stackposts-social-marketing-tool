<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail( $data ){
	$mail = new PHPMailer(true);

	$smtp = db_get("*", TB_SMTP, ["status" => 1], "rand");

	try {
	    if(get_option("sender_protocol", 1) == 2 && !empty($smtp)){
		    $mail->SMTPDebug = false;
		    $mail->isSMTP();
		    $mail->Host       = $smtp->server;
		    $mail->SMTPAuth   = true; 
		    $mail->Username   = $smtp->username;
		    $mail->Password   = $smtp->password;
		    $mail->SMTPSecure = $smtp->encryption;
		    $mail->Port       = $smtp->port;
		}

		$mail->setFrom( get_option("sender_email", "example@gmail.com") , get_option("sender_name", "Stackposts"));

		if(isset($data['to']) && is_array($data['to']) && !empty($data['to'])){
			foreach ($data['to'] as $key => $value) {
				if(isset($value['email']) && isset($value['name'])){
					$mail->addAddress($value['email'], $value['name']);
				}

				if(isset($value['email']) && !isset($value['name'])){
					$mail->addAddress($value['email']);
				}
			}
		}

	    //Attachments
	    if(isset($data['attachment'])){
	    	if(is_array($data['attachment'])){
	    		foreach ($data['attachment'] as $attachment) {
	    			$mail->addAttachment($attachment);
	    		}
	    	}

	    	if(is_string($data['attachment'])){
	    		$mail->addAttachment($data['attachment']);
	    	}
	    }
	   
	    //Content
	    $mail->isHTML(true);
	    $mail->CharSet = "UTF-8";
	    $mail->Subject = $data['subject'];
	    $mail->Body    = $data['content'];
	    $mail->AltBody = strip_tags($data['content']);

	    $mail->send();
	    return [
	    	"status" => "success",
	    	"message" => __("Success")
	    ];
	} catch (Exception $e) {
		return [
	    	"status" => "success",
	    	"message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
	    ];
	}
}

function system_email( $uid, $type, $data = [] ){
	$user = db_get("*", TB_USERS, ["id" => $uid]);
	if(!empty($user)){
        $subject = "";
        $content = "";
        switch ($type) {
            case 'activation':
                $subject = get_option('activation_email_subject', 'Hello {fullname}! Activation your account');
                $content = get_option('activation_email_content', "Welcome to {website_name}! <br/><br/>Hello {fullname},  <br/><br/>Thank you for joining! We're glad to have you as community member, and we're stocked for you to start exploring our service. <br/>All you need to do is activate your account: <br/><a href='{activation_link}' target='_blank'>{activation_link}</a> <br/><br/>Thanks and Best Regards!");
                break;

            case 'welcome':
                $subject = get_option('welcome_email_subject', 'Hi {fullname}! Getting Started with Our Service');
                $content = get_option('welcome_email_content', "Hello {fullname}! <br/><br/>Congratulations! <br/><br/>You have successfully signed up for our service. <br/>You have got a trial package, starting today. <br/>We hope you enjoy this package! We love to hear from you, <br/><br/>Thanks and Best Regards!");
                break;

            case 'forgot_password':
                $subject = get_option('forgot_password_email_subject', 'Hi {fullname}! Password Reset');
                $content = get_option('email_forgot_password_content', "Hi {fullname}! <br/><br/>Somebody (hopefully you) requested a new password for your account. <br/>No changes have been made to your account yet. <br/><br/>You can reset your password by click this link: <br/><a href='{recovery_password_link}' target='_blank'>{recovery_password_link}</a>. <br/><br/>If you did not request a password reset, no further action is required. <br/><br/>Thanks and Best Regards!");
                break;

            case 'renewal_reminders':
                $subject = get_option('renewal_reminders_email_subject', "Hi {fullname}, Here's a little Reminder your Membership is expiring soon...");
                $content = get_option('renewal_reminders_email_content', "Dear {fullname}, <br/><br/>Your membership with your current package will expire in {days_left} days. <br/><br/>We hope that you will take the time to renew your membership and remain part of our community. It couldn't be easier - just click here to renew: {pricing_page} <br/><br/>Thanks and Best Regards!");
                break;

            case 'payment_done':
                $subject = get_option('payment_success_email_subject', "Hi {fullname}, Thank you for your payment");
                $content = get_option('payment_success_email_content', "Hi {fullname}, <br/><br/>You just completed the payment successfully on our service. <br/>Thank you for being awesome, we hope you enjoy your package. <br/><br/>Thanks and Best Regards!");
                break;
        }

		$content = mb_convert_encoding($content, "UTF-8");
        $content = htmlspecialchars_decode($content, ENT_QUOTES);

        $email_content = view('Core\Mail\Views\Template\Dora\index', [ "subject" => $subject, "content" => $content ]);

        $subject = str_replace("{fullname}", $user->fullname, $subject);
        $subject = str_replace("{email}", $user->email, $subject);
        $subject = str_replace("{expiration_date}", date_show( $user->expiration_date ), $subject);
        $subject = str_replace("{website_name}", get_option("website_title", "#1 Social Media Management & Analysis Platform"), $subject);
        $subject = str_replace("{website_link}", base_url(), $subject);
        $subject = str_replace("{pricing_page}", base_url("pricing"), $subject);
        $subject = str_replace("{pricing_page}", base_url("pricing"), $subject);

        $email_content = str_replace("{fullname}", $user->fullname, $email_content);
        $email_content = str_replace("{email}", $user->email, $email_content);
        $email_content = str_replace("{expiration_date}", date_show( $user->expiration_date ), $email_content);
        $email_content = str_replace("{website_name}", get_option("website_title", "#1 Social Media Management & Analysis Platform"), $email_content);
        $email_content = str_replace("{website_link}", base_url(), $email_content);
        $email_content = str_replace("{pricing_page}", base_url("pricing"), $email_content);
        $email_content = str_replace("{pricing_page}", base_url("pricing"), $email_content);

        //
		$expiration_date = (int)$user->expiration_date;
		$days_left = round(($expiration_date - time())/(60*60*24));
		$days_left = $days_left>=0?$days_left:0;
		$email_content = str_replace("{days_left}", $days_left, $email_content);

        if(isset($data['activation_link'])){
        	$email_content = str_replace("{activation_link}", $data['activation_link'], $email_content);
        }

        if(isset($data['recovery_password_link'])){
        	$email_content = str_replace("{recovery_password_link}", $data['recovery_password_link'], $email_content);
        }

        send_mail([
        	"to" => [
        		[
        			"email" => $user->email,
        			"name" => $user->fullname,
        		]
        	],
        	"subject" => $subject,
        	"content" => $email_content
        ]);
	}
}

function go_mail( $data = [] ){
    $subject = $data['subject'];
    $content = $data['content'];;

    $content = mb_convert_encoding($content, "UTF-8");
    $content = htmlspecialchars_decode($content, ENT_QUOTES);
    
    $email_content = view('Core\Mail\Views\Template\Dora\index', [ "subject" => $subject, "content" => $content ]);

    if(is_string($data['email'])){
    	$user = db_get("fullname,username,email,expiration_date", TB_USERS, ["email" => $data['email']]);
    	if($user){
    		$subject = str_replace("{fullname}", $user->fullname, $subject);
        	$subject = str_replace("{email}", $user->email, $subject);
        	$subject = str_replace("{expiration_date}", date_show( $user->expiration_date ), $subject);

        	$email_content = str_replace("{fullname}", $user->fullname, $email_content);
        	$email_content = str_replace("{email}", $user->email, $email_content);
        	$email_content = str_replace("{expiration_date}", date_show( $user->expiration_date ), $email_content);
    	}
    }

    $subject = str_replace("{website_name}", get_option("website_title", "#1 Social Media Management & Analysis Platform"), $subject);
    $subject = str_replace("{website_link}", base_url(), $subject);
    $subject = str_replace("{pricing_page}", base_url("pricing"), $subject);
    $subject = str_replace("{pricing_page}", base_url("pricing"), $subject);

    $email_content = str_replace("{website_name}", get_option("website_title", "#1 Social Media Management & Analysis Platform"), $email_content);
    $email_content = str_replace("{website_link}", base_url(), $email_content);
    $email_content = str_replace("{pricing_page}", base_url("pricing"), $email_content);
    $email_content = str_replace("{pricing_page}", base_url("pricing"), $email_content);

    //
    if(isset($data['activation_link'])){
    	$email_content = str_replace("{activation_link}", $data['activation_link'], $email_content);
    }

    if(isset($data['recovery_password_link'])){
    	$email_content = str_replace("{recovery_password_link}", $data['recovery_password_link'], $email_content);
    }

    if(is_array($data['email'])){
    	send_mail([
	    	"to" => $data['email'],
	    	"subject" => $subject,
	    	"content" => $email_content
	    ]);
    }else{
	    send_mail([
	    	"to" => [
	    		[
	    			"email" => $data['email'],
	    			"name" => isset($data['fullname'])?$data['fullname']:"",
	    		]
	    	],
	    	"subject" => $subject,
	    	"content" => $email_content
	    ]);
    }

}
