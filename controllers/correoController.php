<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CorreoController {

    private $mail;

    public function __construct() {

        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();

        $this->mail->Host = 'smtp.gmail.com';

        $this->mail->SMTPAuth = true;

        $this->mail->Username = 'juandavidguzman0612@gmail.com';

        $this->mail->Password = 'nxye vyml lhlt drwm';

        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $this->mail->Port = 587;

        $this->mail->setFrom(
            'juandavidguzman0612@gmail.com',
            'Hotel Villa Dorada'
        );

        $this->mail->isHTML(true);
    }


    
    public function enviarReserva($destino, $nombre) {

        try {

            $this->mail->clearAddresses();

            $this->mail->addAddress($destino, $nombre);

            $this->mail->Subject =
            'Reserva Confirmada - Hotel Villa Dorada';

            $tipo = 'reserva';

            $nombreCliente = $nombre;

            ob_start();

            include __DIR__ .
            '/../views/reportes/email.php';

            $contenido = ob_get_clean();

            $this->mail->Body = $contenido;

            $this->mail->send();

        } catch (Exception $e) {

            echo $this->mail->ErrorInfo;
        }
    }
}