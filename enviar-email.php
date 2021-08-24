<?php

    // Criando nossas variáveis para guardar as informações do formulário
    $nome=$_POST['name'];
    $telefone=$_POST['tel'];
    $email=$_POST['email'];
    $radio=$_POST['novidades'];
    $date=date("d/m/Y");
	date_default_timezone_set('America/Sao_Paulo');
	$hour=date("H:i:s");
    $msg=$_POST['message'];
	
    // formatando nossa mensagem (que será envaida ao e-mail)
    $mensagem= 'Esta mensagem foi enviada através do site<br><br>';
    $mensagem.='<b>Nome: </b>'.$nome.'<br>';
    $mensagem.='<b>Telefone:</b> '.$telefone.'<br>';
    $mensagem.='<b>E-Mail:</b> '.$email.'<br>';
    $mensagem.='<b>Data de envio:</b> '.$date.'<br>';
	$mensagem.='<b>Hora de Envio:</b> '.$hour.'<br>';
    $mensagem.='<b>Mensagem:</b><br> '.$msg;

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'noreply@pro1solutions.com.br';
$mail->Password = 'Pro1@2020';
$mail->setFrom('noreply@pro1solutions.com.br', $nome);
$mail->addReplyTo($email, $nome);
$mail->addBCC('moises@pro1solutions.com.br', 'Moises');
$mail->addAddress('cristiano@pro1solutions.com.br', 'Cristiano');
$mail->Subject = 'Mensagem do Site';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->Body    = $mensagem;  //CORPO DA MENSAGEM
$mail->CharSet = 'UTF-8';    //DEFINE O CHARSET UTILIZADO
//$mail->addAttachment('test.txt');
//if (!$mail->send()) {
//    echo 'Mailer Error: ' . $mail->ErrorInfo;
//} else {
//    echo 'The email message was sent.';
//}

    // $mail->send();
    if(!$mail->Send()) {
        echo "<script>alert('Erro ao enviar o E-Mail');window.location.assign('index.html');</script>";
     }else{
        echo "<script>alert('E-Mail enviado com sucesso!');window.location.assign('index.html');</script>";
     }
?>