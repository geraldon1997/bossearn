<?php
namespace App\Controllers;

class ContactController
{
  public static $success;
  public static $error;

  public static function sendMail()
  {
    $to = "info@bossearn.com";
    $name = $_POST['cn'];
    $email = $_POST['ce'];
    $subject = $_POST['cs'];
    $message = $_POST['cm'];

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: '.$name.'<'.$email.'>' . "\r\n";


    $mail = mail($to, $subject, $message, $headers);

    if ($mail) {
      self::$success['mail'] = 'message sent';
    } else {
      self::$error['mail'] = 'message not sent';
    }
  }
}