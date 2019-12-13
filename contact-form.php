<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'phpmailer/PHPMailerAutoload.php';

if (isset($_POST['expName']) && isset($_POST['expPhone']) && isset($_POST['expAddress']) && isset($_POST['destName']) && isset($_POST['destPhone']) && isset($_POST['destAddress']) && isset($_POST['optShipping'])) {

    //check if any of the inputs are empty
    if (empty($_POST['expName']) || empty($_POST['expPhone']) || empty($_POST['expAddress']) || empty($_POST['destName']) || empty($_POST['destPhone']) || empty($_POST['destAddress']) || empty($_POST['optShipping'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }

    //create an instance of PHPMailer
    $mail = new PHPMailer();

    $mail->From = $_POST['expName'];
    $mail->FromName = $_POST['expName'];
    $mail->AddAddress('marinik08@gmail.com'); //recipient
    $mail->AddAddress('marian_alex_2003@yahoo.com');
    $mail->Subject ="Formular comanda de la "  . ($_POST['expName']);
    $mail->Body = "Expeditor: " . $_POST['expName'] . "\r\nTelefon expeditor:" .$_POST['expPhone']  ."\r\nAdresa expeditor: " . ($_POST['expAddress']) ."\r\n\r\nDestinatar: " . ($_POST['destName']) ."\r\nTelefon destinatar: " . ($_POST['destPhone']) ."\r\nAdresa destinatar: " . ($_POST['destAddress']) ."\r\nOptiune curierat: " . ($_POST['optShipping']) ."\r\n\r\nMentiuni: " . ($_POST['expMentiuni']);

    if (isset($_POST['ref'])) {
        $mail->Body .= "\r\n\r\nRef: " . $_POST['ref'];
    }

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'Thanks! We have received your message.');
    echo json_encode($data);

} else {

    $data = array('success' => false, 'message' => 'Please fill out the form completely.');
    echo json_encode($data);

}
