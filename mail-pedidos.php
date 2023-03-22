<?php
date_default_timezone_set('America/Sao_Paulo');

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

try {
    if ((isset($_POST['email']) && $_POST['email'] != "" ) && (isset($_POST['duvida'])  && $_POST['duvida'] != "")) {

        $nome = !empty($_POST['name']) ? $_POST['name'] : 'Não informado';
        $email = $_POST['email'];
        $duvida = $_POST['duvida'];
        $data = date('d/m/Y H:i:s');

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'EMAIL@EMAIL.COM';
        $mail->Password = '';
        $mail->Port = 587;

        $mail->setFrom('EMAIL@EMAIL.COM');
        $mail->addAddress('EMAIL@EMAIL.COM');

        $mail->isHTML(true);
        $mail->Body = "Nome: {$nome}<br>
                    Email: {$email}<br><br>
                    Dúvida: {$duvida}<br>
                    Data/hora: {$data}";

        $_SESSION['erro'] = "";

        if ($mail->send()) {

            $_SESSION['classe'] = "sucesso";
            $_SESSION['erro'] = 'Email enviado com sucesso';
            header("Location: index.php");
        } else {

            $_SESSION['classe'] = "fracasso";
            $_SESSION['erro'] = 'Email não enviado.';
            header("Location: index.php");
        }
    } else {

        $_SESSION['classe'] = "fracasso";
        $_SESSION['erro'] = 'Não enviado: informar o email e mensagem.';
        header("Location: index.php");
    }
} catch (\Exception $e) {
    $_SESSION['classe'] = "fracasso";
    $_SESSION['erro'] = 'Error ao enviar o email: se ver essa mesagem entre em contato com EMAIL@EMAIL.COM.';
    header("Location: index.php");
}
