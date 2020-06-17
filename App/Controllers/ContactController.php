<?php
namespace App\Controllers;

class ContactController
{
  public static $success;
  public static $error;

  public static function sendMail()
  {
    $to = "info@bossearn.com";
    $subject = $_POST['cs'];
    $message = $_POST['cm'];
    $headers = "";

    $mail = mail($to, $subject, $message, $headers);

    if ($mail) {
      self::$success['mail'] = 'message sent';
    } else {
      self::$error['mail'] = 'message not sent';
    }
  }
}