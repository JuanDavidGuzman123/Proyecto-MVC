<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/Reserva.php';

class ExcelController {

    public function generarExcel() {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=getFormLoginUser');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $reservaModel = new Reserva();

        
        $reservas = $reservaModel->obtenerPorUsuario($user_id);

        include 'views/reportes/excel.php';
    }
}