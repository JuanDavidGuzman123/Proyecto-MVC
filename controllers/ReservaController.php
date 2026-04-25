<?php

class ReservaController {

    public function formReserva() {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=getFormLoginUser');
            exit;
        }

        $reserva = new Reserva();
        $_SESSION['habitaciones'] = $reserva->obtenerHabitaciones();

        include 'views/reserva/formReserva.php';
    }

    public function guardarReserva() {

        $reserva = new Reserva();
        $user_id = $_SESSION['user']['id'];

        $reserva->guardar($_POST, $user_id);

        header('Location: index.php?action=interfaz');
    }

    public function interfaz() {

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=getFormLoginUser');
            exit;
        }

        $reserva = new Reserva();
        $user_id = $_SESSION['user']['id'];

        $_SESSION['reservas'] = $reserva->obtenerPorUsuario($user_id);

        include 'views/interfaz.php';
    }

    public function eliminarReserva() {

        $reserva = new Reserva();
        $reserva->eliminar($_GET['id']);

        header('Location: index.php?action=interfaz');
    }

    public function editarReserva() {

        $reserva = new Reserva();
        $_SESSION['reserva'] = $reserva->obtenerPorId($_GET['id']);

        include 'views/reserva/editarReserva.php';
    }

    public function actualizarReserva() {

        $reserva = new Reserva();
        $reserva->actualizar($_POST);

        header('Location: index.php?action=interfaz');
    }
}