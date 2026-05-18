<?php

require_once __DIR__ . '/../models/Reserva.php';

class pdfController {

    public function generarPDF() {

        if (!isset($_SESSION['user'])) {

            header('Location: index.php?action=getFormLoginUser');
            exit;
        }

        $id = $_GET['id'];

        $reservaModel = new Reserva();

        $reserva = $reservaModel->obtenerDetalleReserva($id);

        if (!$reserva) {

            echo "Reserva no encontrada";
            exit;
        }

        include 'views/reportes/exportarPdf.php';
    }
}