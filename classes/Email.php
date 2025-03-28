<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        // Looking to send emails in production? Check out our Email API/SMTP product!
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '94f52f2a58874e';
            $mail->Password = '270ded1d374150';

            $mail->setFrom('cuentas@uptask.com');
            $mail->addAddress('cuentas@uptask.com', 'uptask.com');
            $mail->Subject = 'Confirma tu cuenta';

            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en UpTask, Solo debes confirmarla en el siguiente enlace</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar cuenta </a></p>";
            $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;

            //Enviar el Email
            $mail->send();
    }

    public function enviarInstrucciones(){
        // Looking to send emails in production? Check out our Email API/SMTP product!
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '94f52f2a58874e';
            $mail->Password = '270ded1d374150';

            $mail->setFrom('cuentas@uptask.com');
            $mail->addAddress('cuentas@uptask.com', 'uptask.com');
            $mail->Subject = 'Reestablece tu password';

            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';

            $contenido = '<html>';
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Parece que has olvidado tu password, sigue el siguiente enlace para recuperarlo</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/reestablecer?token=" . $this->token . "'>Recuperar Password </a></p>";
            $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
            $contenido .= '</html>';

            $mail->Body = $contenido;

            //Enviar el Email
            $mail->send();
    }
}
?>