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

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final  = $_POST['fecha_final'];

    // 🔥 NO IGUALES NI MENORES
    if ($fecha_final <= $fecha_inicio) {
        $_SESSION['error'] = "La fecha final debe ser mayor a la fecha de inicio";
        header('Location: index.php?action=formReserva');
        exit;
    }

    // 🔒 No fechas pasadas
    if ($fecha_inicio < date('Y-m-d')) {
        $_SESSION['error'] = "No puedes reservar fechas pasadas";
        header('Location: index.php?action=formReserva');
        exit;
    }

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

   public function getRoomsByType() {

    header('Content-Type: application/json');

    $categoria_id = $_GET['categoria_id'] ?? 0;

    $reserva = new Reserva();
    $data = $reserva->obtenerHabitacionesPorCategoria($categoria_id);

    echo json_encode([
        "ok" => true,
        "data" => $data
    ]);
}


}
