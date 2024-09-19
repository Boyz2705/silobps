<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

if (isset($_POST['submit'])) {

    $email = $_POST['email']; //Mendapatkan inputan email dari form
    $nama = $_POST['name']; //Mendapatkan inputan nama dari form
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ramadhanz619@gmail.com';
        $mail->Password   = 'aebpksfalswovfoi';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('ramadhanz619@gmail.com', 'Pesan dari Form');
        $mail->addAddress("$email");
        $mail->addReplyTo('no-reply@gmail.com', 'NO Reply');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Input dari Form';
        $mail->Body    = "<h1>Kamu telah mengisi formulir</h1> Nama kamu adalah $nama <br> Subject : $subject <br> Isi pesan :<br> $message";
        $mail->AltBody = 'Data formulir';

        $mail->send();
        echo "";
?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <style>
            .centering {
                display: flex;
                justify-content: center;
            }

            .lefting {
                display: flex;
                justify-content: left;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <div class="container centering">
            <p class="fs-2 fw-bolder">Pesan Berhasil Terkirim</p>
        </div>
        <div class="container centering">
            <button class="btn btn-dark text-center mt-3" type="submit" name="submit"><a href="/" style="color: white;">Kembali ke Halaman Utama</a></button>
        </div>
<?php
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Silakan submit terlebih dahulu";
}
