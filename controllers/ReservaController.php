<?php
require_once __DIR__ . '/../fpdf/fpdf.php';
require_once 'controllers/correoController.php';


class ReservaController {

    private function validarSesion() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=getFormLoginUser');
            exit;
        }
    }

    public function formReserva() {

        $this->validarSesion();

        $reserva = new Reserva();

        $_SESSION['habitaciones'] = $reserva->obtenerHabitaciones();
        $_SESSION['categorias']   = $reserva->obtenerCategorias();

        include 'views/reserva/formReserva.php';
    }

   public function guardarReserva() {

    $this->validarSesion();

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final  = $_POST['fecha_final'];

    // 🔥 VALIDACIONES
    if ($fecha_final <= $fecha_inicio) {

        $_SESSION['error'] =
        "La fecha final debe ser mayor a la fecha de inicio";

        header('Location: index.php?action=formReserva');
        exit;
    }

    if ($fecha_inicio < date('Y-m-d')) {

        $_SESSION['error'] =
        "No puedes reservar fechas pasadas";

        header('Location: index.php?action=formReserva');
        exit;
    }

    $correo = new CorreoController();

    $correo->enviarReserva(
    $_SESSION['user']['email'],
    $_SESSION['user']['name']
);

    
    $reserva = new Reserva();

    $user_id = $_SESSION['user']['id'];

    $reserva->guardar($_POST, $user_id);


  

   
    
    header('Location: index.php?action=interfaz');
}
    public function interfaz() {

        $this->validarSesion();

        $reserva = new Reserva();
        $user_id = $_SESSION['user']['id'];

        $_SESSION['reservas'] = $reserva->obtenerPorUsuario($user_id);

        include 'views/interfaz.php';
    }

    public function eliminarReserva() {

        $this->validarSesion();

        $reserva = new Reserva();
        $reserva->eliminar($_GET['id']);

        header('Location: index.php?action=interfaz');
    }

    public function editarReserva() {

        $this->validarSesion();

        $reserva = new Reserva();

        $_SESSION['reserva']   = $reserva->obtenerPorId($_GET['id']);
        $_SESSION['categorias'] = $reserva->obtenerCategorias(); 

        include 'views/reserva/editarReserva.php';
    }

    public function actualizarReserva() {

    $this->validarSesion();

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final  = $_POST['fecha_final'];

    
    if ($fecha_final <= $fecha_inicio) {
        $_SESSION['error'] = "La fecha final debe ser mayor a la fecha de inicio";
        header('Location: index.php?action=editarReserva&id=' . $_POST['id']);
        exit;
    }

    if ($fecha_inicio < date('Y-m-d')) {
        $_SESSION['error'] = "No puedes usar fechas pasadas";
        header('Location: index.php?action=editarReserva&id=' . $_POST['id']);
        exit;
    }

    
    if (empty($_POST['habitacion_id'])) {
        $_POST['habitacion_id'] = $_POST['habitacion_actual'];
    }

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