<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

require 'vendor/autoload.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

class SES_model extends CI_Model 
{

    public function sendwelcome($email){
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="
            font-size: 15px; 
            color: #221E29;
            /*background-image: linear-gradient(rgba(127, 37, 132,.05), rgba(127, 37, 132,.02));*/
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            /*padding: 0.5rem 2rem;*/
            border-radius: 7px;
            border: 2px solid #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem;
            ">
        
            <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
                <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
            </div>
            
            <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
                <p style="
                    font-weight: 500;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 1rem;
                    ">Welcome To VICTAM</span>
                </p>
                <p style="
                    font-weight: 600;
                    font-size: 16px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 0;">“Thank You For Signing Up”</span>
                </p>
                <p style="
                    line-height: 1.6;
                    font-size: 14px;
                    color: rgba(255, 255, 255,0.7);
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">We will keep you posted on latest events, articles and interviews
                </p>
                <a href="dev.victam.com/" style="
                        background-color: transparent;
                        border-radius: 50px;
                        border: none;
                        color: #fff;
                        cursor: pointer;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 12px;
                        font-weight: 300;
                        line-height: 1;
                        padding: 1em 2em;
                        text-align: center;
                        white-space: nowrap;
                        margin-top: 1rem;
                        border: 1px solid #fff;
                ">Click here to visit our website</a>
            </div>
        
            <div style="
            text-align: center;">
                <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 1rem;color: #0065A7;font-weight: 500;">Stay Connected</h5>
                <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
                    <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
                </div>
            </div>
        </div>';
            $char_set = 'UTF-8';
        try {
            $result = $SesClient->sendEmail([
            'Destination'=> [
            'ToAddresses'=> $recipient_emails,
            ],
            'ReplyToAddresses'=> [$sender_email],
            'Source'=> $sender_email,
            'Message'=> [
            'Body'=> [
                'Html'=> [
                    'Charset'=> $char_set,
                    'Data'=> $html_body,
                ],
            'Text'=> [
                'Charset'=> $char_set,
                'Data'=> $plaintext_body,
                ],
            ],
                'Subject'=> [
                'Charset'=> $char_set,
                'Data'=> $subject,
                ],
            ],
            ]);
            $messageId = $result['MessageId'];
            echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
                // output error message if fails
                echo $e->getMessage();
                echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
                echo "\n";
        }
    }


    public function sendotp($email, $pass){
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="
            font-size: 15px; 
            color: #221E29;
            /*background-image: linear-gradient(rgba(127, 37, 132,.05), rgba(127, 37, 132,.02));*/
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            /*padding: 0.5rem 2rem;*/
            border-radius: 7px;
            border: 2px solid #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem;
            ">
        
            <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
                <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
            </div>
            
            <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
                <p style="
                    font-weight: 500;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20px;
                    margin-bottom: 1rem;">Welcome To VICTAM</span>
                </p>
                <p style="
                    line-height: 1.6;
                    font-size: 14px;
                    color: rgba(255, 255, 255,0.7);
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">We have received a request to login into your account password
                </p>
                    <p style="
                    line-height: 1.6;
                    font-size: 16px;
                    color: #fff;
                    margin-top: 0;
                    text-align: center;
                    font-weight: 500;">Your login password is <br/>'.$pass.'
                </p>
                <a href="dev.victam.com/" style="
                    background-color: transparent;
                    border-radius: 50px;
                    color: #fff;
                    cursor: pointer;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 12px;
                    font-weight: 300;
                    line-height: 1;
                    padding: 1em 2em;
                    text-align: center;
                    white-space: nowrap;
                    margin-top: 1rem;
                    border: 2px solid #fff;
            ">Click here to reset your password</a>
            </div>
        
            <div style="
            text-align: center;">
                <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 1rem;color: #0065A7;font-weight: 500;">Stay Connected</h5>
                <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
                    <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
                </div>
            </div>
        </div>';
            $char_set = 'UTF-8';
        try {
            $result = $SesClient->sendEmail([
            'Destination'=> [
            'ToAddresses'=> $recipient_emails,
            ],
            'ReplyToAddresses'=> [$sender_email],
            'Source'=> $sender_email,
            'Message'=> [
            'Body'=> [
                'Html'=> [
                    'Charset'=> $char_set,
                    'Data'=> $html_body,
                ],
            'Text'=> [
                'Charset'=> $char_set,
                'Data'=> $plaintext_body,
                ],
            ],
            'Subject'=> [
                'Charset'=> $char_set,
                'Data'=> $subject,
                ],
            ],
            ]);
            $messageId = $result['MessageId'];
            $result=array('status'=>'success','msg'=>"Success to send an email notification");
            return $result;
            //echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            //echo $e->getMessage();
            //echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            $result=array('status'=>'fail','msg'=>"Failed to send an email notification");
            return $result;
            //echo "\n";
        }
    }


    public function sharedmail($email, $content){
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="font-size: 15px; 
            color: #221E29;
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            border-radius: 7px;
            box-shadow: 0px 0px 10px #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem; border: 1px solid #ddd;">
        
            <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
                <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
            </div>
            
            <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
                <p style="
                    font-weight: 600;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 20px;">Congratulations</span>
                </p>
                <p style="
                    line-height: 1.6;
                    font-size: 16px;
                    color: #fff;
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">'.$content.'
                </p>
                <a href="dev.victam.com/" style="
                    background-color: transparent;
                    border-radius: 50px;
                    border: none;
                    color: #fff;
                    cursor: pointer;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 12px;
                    font-weight: 300;
                    line-height: 1;
                    padding: 1em 2em;
                    text-align: center;
                    white-space: nowrap;
                    margin-top: 1rem;
                    border: 1px solid #fff;
            ">Click here to visit the website</a>
            </div>
        
            <div style="
            text-align: center;">
                <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 0.5rem;color: #0065A7;font-weight: 600;">Stay Connected</h5>
                <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
                    <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
                </div>
            </div>
        </div>';
            $char_set = 'UTF-8';
        try {
                $result = $SesClient->sendEmail([
                'Destination'=> [
                'ToAddresses'=> $recipient_emails,
                ],
                'ReplyToAddresses'=> [$sender_email],
                'Source'=> $sender_email,
                'Message'=> [
                'Body'=> [
                    'Html'=> [
                        'Charset'=> $char_set,
                        'Data'=> $html_body,
                    ],
                'Text'=> [
                    'Charset'=> $char_set,
                    'Data'=> $plaintext_body,
                    ],
                ],
                'Subject'=> [
                    'Charset'=> $char_set,
                    'Data'=> $subject,
                    ],
                ],
            ]);
            $messageId = $result['MessageId'];
            return $messageId;
            // echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            echo $e->getMessage();
            echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            echo "\n";
        }
    }

    public function send_password_reset_link($email,$resetLink){
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Victam - Password Reset Link';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="
            font-size: 15px; 
            color: #221E29;
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            border-radius: 7px;
            border:2px solid #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem;">
        
            <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
                <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
            </div>
            
            <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
                <p style="
                    font-weight: 600;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 16px;">Reset Your Password</span>
                </p>
                <p style="
                    font-weight: 300;
                    line-height: 1.6;
                    font-size: 20px;
                    text-align: center;
                    color: #fff;
                    margin-top: 30px;
                    margin-bottom: 30px;">Resetting your password is easy. Just press the button below to reset your password</span>
                </p>
                <a href="'.$resetLink.'" style="
                        background-color: transparent;
                        border-radius: 50px;
                        color: #fff;
                        cursor: pointer;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 12px;
                        font-weight: 600;
                        letter-spacing: 2px;
                        line-height: 1;
                        padding: 1em 2em;
                        text-align: center;
                        white-space: nowrap;
                        margin-top: 1rem;
                        border: 2px solid #fff;">Reset Your Password</a>
            </div>
        
            <div style="
            text-align: center;">
                <h5 
                style="
                margin-bottom: 1rem;
                text-transform: capitalize;
                font-size: 1rem;
                color: #0065A7;
                font-weight: 500;
                ">Stay Connected</h5>
                <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
                    <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
                </div>
            </div>
        </div>';
            $char_set = 'UTF-8';
        try {
            $result = $SesClient->sendEmail([
            'Destination'=> [
            'ToAddresses'=> $recipient_emails,
            ],
            'ReplyToAddresses'=> [$sender_email],
            'Source'=> $sender_email,
            'Message'=> [
            'Body'=> [
                'Html'=> [
                    'Charset'=> $char_set,
                    'Data'=> $html_body,
                ],
            'Text'=> [
                'Charset'=> $char_set,
                'Data'=> $plaintext_body,
                ],
            ],
                'Subject'=> [
                'Charset'=> $char_set,
                'Data'=> $subject,
                ],
            ],
            ]);
            $messageId = $result['MessageId'];
            echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
                // output error message if fails
                echo $e->getMessage();
                echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
                echo "\n";
        }
    }


    public function send_matching_mail($email, $company, $count)
    {
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            foreach($company as $list){
                $output[] = '<b> '.$list->vic_companyname.' </b> <span style="color: blue;">'.$list->vic_companyemail.' </span> ';
            } 

            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="font-size: 15px; 
                    color: #221E29;
                    background: #fff;
                    width: 500px;
                    margin: 1rem auto;
                    border-radius: 7px;
                    box-shadow: 0px 0px 10px #ddd;
                    padding-bottom: 3rem;
                    padding-top: 1rem; border: 1px solid #ddd;">

            <div style="
                    width: 100%;
                    text-align: center;
                    border-bottom: 1px solid rgba(228, 5, 33,0.2);
                    padding-bottom: 1rem;">
                <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                        width: 150px;
                        margin: 0 auto;">
            </div>

            <div style="
                    background: rgba(228, 5, 33,1);
                    padding: 2rem 1rem 4rem 1rem;
                    text-align: center;">
                <p style="
                            font-weight: 600;
                            font-size: 30px;
                            text-align: center;
                            color: #fff;
                            margin-top: 20;
                            margin-bottom: 20px;">Congratulations</span>
                </p>
                <p style="
                            line-height: 1.6;
                            font-size: 16px;
                            color: #fff;
                            margin-top: 0;
                            text-align: center;
                            font-weight: 300;">We have found '.$count.' matches of buyers based on your interest
                </p>
                <p>
                    '.implode("<br>", $output).'
                </p>
            </div>

            <div style="
                    text-align: center;">
                <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 0.5rem;color: #0065A7;font-weight: 600;">Stay Connected</h5>
                <div style="
                            background: rgba(0, 0, 0,0.5);
                            width: fit-content;
                            margin: 0 auto;
                            padding: .3rem .7rem;
                            border-radius: 5px;
                            display: flex;
                            align-items: center;">
                    <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
                    <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
                </div>
            </div>
        </div>';
            $char_set = 'UTF-8';
        try {
                $result = $SesClient->sendEmail([
                'Destination'=> [
                'ToAddresses'=> $recipient_emails,
                ],
                'ReplyToAddresses'=> [$sender_email],
                'Source'=> $sender_email,
                'Message'=> [
                'Body'=> [
                    'Html'=> [
                        'Charset'=> $char_set,
                        'Data'=> $html_body,
                    ],
                'Text'=> [
                    'Charset'=> $char_set,
                    'Data'=> $plaintext_body,
                    ],
                ],
                'Subject'=> [
                    'Charset'=> $char_set,
                    'Data'=> $subject,
                    ],
                ],
            ]);
            $messageId = $result['MessageId'];
            return $messageId;
            // echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            echo $e->getMessage();
            echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            echo "\n";
        }
    }


    public function send_mail_supplier($company, $email, $name)
    {
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$company];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="font-size: 15px; 
            color: #221E29;
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            border-radius: 7px;
            box-shadow: 0px 0px 10px #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem; border: 1px solid #ddd;">

    <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
        <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
    </div>

    <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
        <p style="
                    font-weight: 600;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 20px;">Congratulations</span>
        </p>
        <p style="
                    line-height: 1.6;
                    font-size: 16px;
                    color: #fff;
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">Hello Supplier '.$name.'. <br> We have found a new customer who has viewed your company information.
        </p>
        <p>
            <b> <span style="color: blue;">'.$email.' </span> </b>
        </p>
    </div>

    <div style="
            text-align: center;">
        <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 0.5rem;color: #0065A7;font-weight: 600;">Stay Connected</h5>
        <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
            <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
        </div>
    </div>
</div>';
            $char_set = 'UTF-8';
        try {
                $result = $SesClient->sendEmail([
                'Destination'=> [
                'ToAddresses'=> $recipient_emails,
                ],
                'ReplyToAddresses'=> [$sender_email],
                'Source'=> $sender_email,
                'Message'=> [
                'Body'=> [
                    'Html'=> [
                        'Charset'=> $char_set,
                        'Data'=> $html_body,
                    ],
                'Text'=> [
                    'Charset'=> $char_set,
                    'Data'=> $plaintext_body,
                    ],
                ],
                'Subject'=> [
                    'Charset'=> $char_set,
                    'Data'=> $subject,
                    ],
                ],
            ]);
            $messageId = $result['MessageId'];
            return $messageId;
            // echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            echo $e->getMessage();
            echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            echo "\n";
        }
    }


    public function send_mail_contactus($email, $name, $jobname, $reqemail, $reqmobile, $reqdesignation, $type)
    {
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="font-size: 15px; 
            color: #221E29;
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            border-radius: 7px;
            box-shadow: 0px 0px 10px #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem; border: 1px solid #ddd;">

    <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
        <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
    </div>

    <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
        <p style="
                    font-weight: 600;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 20px;">Congratulations</span>
        </p>
        <p style="
                    line-height: 1.6;
                    font-size: 16px;
                    color: #fff;
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">'.$name.' is interested in your '.$jobname.' '.$type.'<br>
                    <label>Email - </label> '.$reqemail.'<br>
                    <label>Mobile - </label> '.$reqmobile.'<br>
                    <label>Position  - </label> '.$reqdesignation.'
        </p>
    </div>

    <div style="
            text-align: center;">
        <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 0.5rem;color: #0065A7;font-weight: 600;">Stay Connected</h5>
        <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
            <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
        </div>
    </div>
</div>';
            $char_set = 'UTF-8';
        try {
                $result = $SesClient->sendEmail([
                'Destination'=> [
                'ToAddresses'=> $recipient_emails,
                ],
                'ReplyToAddresses'=> [$sender_email],
                'Source'=> $sender_email,
                'Message'=> [
                'Body'=> [
                    'Html'=> [
                        'Charset'=> $char_set,
                        'Data'=> $html_body,
                    ],
                'Text'=> [
                    'Charset'=> $char_set,
                    'Data'=> $plaintext_body,
                    ],
                ],
                'Subject'=> [
                    'Charset'=> $char_set,
                    'Data'=> $subject,
                    ],
                ],
            ]);
            $messageId = $result['MessageId'];
            return $messageId;
            // echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            echo $e->getMessage();
            echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            echo "\n";
        }
    }


    public function reject_event_shared($email, $eventname)
    {
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="font-size: 15px; 
            color: #221E29;
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            border-radius: 7px;
            box-shadow: 0px 0px 10px #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem; border: 1px solid #ddd;">

    <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
        <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
    </div>

    <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
        <p style="
                    font-weight: 600;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 20px;">Event Rejection</span>
        </p>
        <p style="
                    line-height: 1.6;
                    font-size: 16px;
                    color: #fff;
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">Your Event '.$eventname.' has been rejected due to violation of policy.
        </p>
    </div>

    <div style="
            text-align: center;">
        <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 0.5rem;color: #0065A7;font-weight: 600;">Stay Connected</h5>
        <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
            <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
        </div>
    </div>
</div>';
            $char_set = 'UTF-8';
        try {
                $result = $SesClient->sendEmail([
                'Destination'=> [
                'ToAddresses'=> $recipient_emails,
                ],
                'ReplyToAddresses'=> [$sender_email],
                'Source'=> $sender_email,
                'Message'=> [
                'Body'=> [
                    'Html'=> [
                        'Charset'=> $char_set,
                        'Data'=> $html_body,
                    ],
                'Text'=> [
                    'Charset'=> $char_set,
                    'Data'=> $plaintext_body,
                    ],
                ],
                'Subject'=> [
                    'Charset'=> $char_set,
                    'Data'=> $subject,
                    ],
                ],
            ]);
            $messageId = $result['MessageId'];
            return $messageId;
            // echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            echo $e->getMessage();
            echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            echo "\n";
        }
    }

    public function reject_company_shared($email, $eventname)
    {
        $params = array(
            'credentials'=> array(
            'key'=>$this->config->item('AWS_KEY'),
            'secret'=>$this->config->item('AWS_SECRET'),
        ),
            'region'=>$this->config->item('AWS_REGION'),
            'version'=>'latest'
        );
            $SesClient = new SesClient($params);
            $sender_email = 'operations@victam.com';
            $recipient_emails = [$email];
            // Specify a configuration set. If you do not want to use a configuration comment it or delete.
            //$configuration_set = 'ConfigSet';
            
            $subject = 'Welcome To Victam International';
            $plaintext_body = 'The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries' ;
            $html_body = '<div style="font-size: 15px; 
            color: #221E29;
            background: #fff;
            width: 500px;
            margin: 1rem auto;
            border-radius: 7px;
            box-shadow: 0px 0px 10px #ddd;
            padding-bottom: 3rem;
            padding-top: 1rem; border: 1px solid #ddd;">

    <div style="
            width: 100%;
            text-align: center;
            border-bottom: 1px solid rgba(228, 5, 33,0.2);
            padding-bottom: 1rem;">
        <img src="http://dev.victam.com/application/assets/shared/img/logo.png" style="
                width: 150px;
                margin: 0 auto;">
    </div>

    <div style="
            background: rgba(228, 5, 33,1);
            padding: 2rem 1rem 4rem 1rem;
            text-align: center;">
        <p style="
                    font-weight: 600;
                    font-size: 30px;
                    text-align: center;
                    color: #fff;
                    margin-top: 20;
                    margin-bottom: 20px;">Company Details Rejected</span>
        </p>
        <p style="
                    line-height: 1.6;
                    font-size: 16px;
                    color: #fff;
                    margin-top: 0;
                    text-align: center;
                    font-weight: 300;">Your '.$eventname.' has been rejected due to violation of policy.
        </p>
    </div>

    <div style="
            text-align: center;">
        <h5 style="margin-bottom: 1rem;text-transform: capitalize;font-size: 0.5rem;color: #0065A7;font-weight: 600;">Stay Connected</h5>
        <div style="
                    background: rgba(0, 0, 0,0.5);
                    width: fit-content;
                    margin: 0 auto;
                    padding: .3rem .7rem;
                    border-radius: 5px;
                    display: flex;
                    align-items: center;">
            <img src="http://dev.victam.com/application/assets/shared/img/envelope.png" style="width: 18px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/facebook.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/google-glass-logo.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/instagram.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/linked-in-logo-of-two-letters.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/twitter.png" style="width: 16px;margin-right: 1rem;">
            <img src="http://dev.victam.com/application/assets/shared/img/youtube.png" style="width: 18px;margin-bottom: -5px;">
        </div>
    </div>
</div>';
            $char_set = 'UTF-8';
        try {
                $result = $SesClient->sendEmail([
                'Destination'=> [
                'ToAddresses'=> $recipient_emails,
                ],
                'ReplyToAddresses'=> [$sender_email],
                'Source'=> $sender_email,
                'Message'=> [
                'Body'=> [
                    'Html'=> [
                        'Charset'=> $char_set,
                        'Data'=> $html_body,
                    ],
                'Text'=> [
                    'Charset'=> $char_set,
                    'Data'=> $plaintext_body,
                    ],
                ],
                'Subject'=> [
                    'Charset'=> $char_set,
                    'Data'=> $subject,
                    ],
                ],
            ]);
            $messageId = $result['MessageId'];
            return $messageId;
            // echo("Email sent! Message ID: $messageId"."\n");
        } catch (AwsException $e) {
            // output error message if fails
            echo $e->getMessage();
            echo("The email was not sent. Error message: ".$e->getAwsErrorMessage()."\n");
            echo "\n";
        }
    }
}