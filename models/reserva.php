<?php

class Reserva {

    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
        $this->conexion->conectar();
    }

    public function obtenerHabitaciones() {

        $sql = "SELECT 
                    h.id,
                    h.numero_camas,
                    h.descripcion,
                    h.precio,
                    e.nombre AS estado,
                    c.nombre AS categoria
                FROM habitaciones h
                INNER JOIN categorias c ON h.categoria_id = c.id
                INNER JOIN estado e ON h.estado_id = e.id";

        $this->conexion->query($sql);
        return $this->conexion->getResult()->fetch_all(MYSQLI_ASSOC);
    }

    public function guardar($datos, $user_id) {

        $sql = "INSERT INTO reservas (fecha_inicio, fecha_final, habitacion_id, user_id)
                VALUES (
                    '{$datos['fecha_inicio']}',
                    '{$datos['fecha_final']}',
                    '{$datos['habitacion_id']}',
                    '$user_id'
                )";

        $this->conexion->query($sql);
    }

    public function obtenerPorUsuario($user_id) {

        $sql = "SELECT r.id, r.fecha_inicio, r.fecha_final,
                       h.numero_camas, c.nombre AS categoria
                FROM reservas r
                INNER JOIN habitaciones h ON r.habitacion_id = h.id
                INNER JOIN categorias c ON h.categoria_id = c.id
                WHERE r.user_id = '$user_id'";

        $this->conexion->query($sql);
        return $this->conexion->getResult()->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM reservas WHERE id = '$id'";
        $this->conexion->query($sql);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM reservas WHERE id = '$id'";
        $this->conexion->query($sql);
        return $this->conexion->getResult()->fetch_assoc();
    }

    public function actualizar($datos) {
        $sql = "UPDATE reservas SET 
                fecha_inicio = '{$datos['fecha_inicio']}',
                fecha_final = '{$datos['fecha_final']}'
                WHERE id = '{$datos['id']}'";

        $this->conexion->query($sql);
    }
}