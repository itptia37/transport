<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MyPHPMailer {
    public function MyPHPMailer() {
        require_once('PHPMailer/PHPMailerAutoload.php');
		//require_once('PHPMailer/class.pop3.php'); 
		//require_once('PHPMailer/class.smtp.php');
    }
}
?>