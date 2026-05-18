<?php
session_start();

require_once 'config/config.php';

// controllers
require_once 'controllers/AuthController.php';
require_once 'controllers/ReservaController.php';
require_once 'controllers/pdfController.php';
require_once 'controllers/excelController.php';
require_once 'controllers/correoController.php';

// models
require_once 'models/Conexion.php';
require_once 'models/User.php';
require_once 'models/Reserva.php';

// instancias
$authController = new AuthController();
$reservaController = new ReservaController();
$pdfController = new PdfController();
$excelController = new ExcelController();

// acciónes
$action = $_GET['action'] ?? 'home';

switch ($action) {

    case 'getFormLoginUser':
        require 'views/auth/login.php';
        break;

    case 'getFormRegisterUser':
        $authController->getFormRegisterUser();
        break;

    case 'loginUser':
        $authController->loginUser($_POST);
        break;

    case 'registerUser':
        $authController->registerUser($_POST);
        break;

    case 'logout':
        $authController->logoutUser();
        break;

    case 'interfaz':
        $reservaController->interfaz();
        break;

    case 'formReserva':
        $reservaController->formReserva();
        break;

    case 'guardarReserva':
        $reservaController->guardarReserva();
        break;

    case 'editarReserva':
        $reservaController->editarReserva();
        break;

    case 'actualizarReserva':
        $reservaController->actualizarReserva();
        break;

    case 'eliminarReserva':
        $reservaController->eliminarReserva();
        break;

    case 'getRoomsByType':
        $reservaController->getRoomsByType();
        break;

    case 'generarPDF':
        $pdfController->generarPDF();
        break;

    case 'generarExcel':
        $excelController->generarExcel();
        break;

    default:
        require 'views/home.php';
        break;
}