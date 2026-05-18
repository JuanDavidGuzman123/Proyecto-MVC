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
                h.numero,
                h.numero_camas,
                h.descripcion,
                h.precio,
                h.categoria_id,
                e.nombre AS estado,
                c.nombre AS categoria
            FROM habitaciones h
            INNER JOIN categorias c ON h.categoria_id = c.id
            INNER JOIN estado e ON h.estado_id = e.id";

    $this->conexion->query($sql);
    return $this->conexion->getResult()->fetch_all(MYSQLI_ASSOC);
}

    public function guardar($datos, $user_id) {

    $sql = "INSERT INTO reservas 
            (fecha_inicio, fecha_final, habitacion_id, user_id)
            VALUES (
                '{$datos['fecha_inicio']}',
                '{$datos['fecha_final']}',
                '{$datos['habitacion_id']}',
                '$user_id'
            )";

    $this->conexion->query($sql);

    
    $habitacion_id = $datos['habitacion_id'];

    $sqlEstado = "UPDATE habitaciones 
                  SET estado_id = 2
                  WHERE id = '$habitacion_id'";

    $this->conexion->query($sqlEstado);
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

    
    $sqlHabitacion = "SELECT habitacion_id 
                      FROM reservas 
                      WHERE id = '$id'";

    $this->conexion->query($sqlHabitacion);

    $resultado = $this->conexion
    ->getResult()
    ->fetch_assoc();

    $habitacion_id = $resultado['habitacion_id'];

    
    $sql = "DELETE FROM reservas WHERE id = '$id'";

    $this->conexion->query($sql);

    
    $sqlEstado = "UPDATE habitaciones
                  SET estado_id = 1
                  WHERE id = '$habitacion_id'";

    $this->conexion->query($sqlEstado);
}

   public function obtenerPorId($id) {

    $sql = "SELECT 
                r.id,
                r.fecha_inicio,
                r.fecha_final,
                r.habitacion_id,
                r.n_personas,
                h.numero,
                h.categoria_id,
                c.nombre AS categoria
            FROM reservas r
            INNER JOIN habitaciones h ON r.habitacion_id = h.id
            INNER JOIN categorias c ON h.categoria_id = c.id
            WHERE r.id = '$id'";

    $this->conexion->query($sql);
    return $this->conexion->getResult()->fetch_assoc();
}

   public function actualizar($datos) {

    $sql = "UPDATE reservas SET 
                fecha_inicio = '{$datos['fecha_inicio']}',
                fecha_final = '{$datos['fecha_final']}',
                habitacion_id = '{$datos['habitacion_id']}',
                n_personas = '{$datos['n_personas']}'
            WHERE id = '{$datos['id']}'";

    $this->conexion->query($sql);
}

  public function obtenerHabitacionesPorCategoria($categoria_id) {

    $sql = "SELECT 
                h.id,
                h.numero,
                h.precio,
                h.numero_camas,
                h.descripcion,
                e.nombre AS estado
            FROM habitaciones h
            INNER JOIN estado e 
            ON h.estado_id = e.id
            WHERE h.categoria_id = '$categoria_id'
            AND h.estado_id = 1";

    $this->conexion->query($sql);

    return $this->conexion
        ->getResult()
        ->fetch_all(MYSQLI_ASSOC);
}

public function obtenerCategorias() {

    $sql = "SELECT * FROM categorias";

    $this->conexion->query($sql);

    return $this->conexion
    ->getResult()
    ->fetch_all(MYSQLI_ASSOC);
}
    public function obtenerDetalleReserva($id) {

    $sql = "SELECT 
                r.*,
                h.numero,
                h.precio,
                c.nombre AS categoria,
                u.name,
                u.last_name,
                u.email
            FROM reservas r
            INNER JOIN habitaciones h ON r.habitacion_id = h.id
            INNER JOIN categorias c ON h.categoria_id = c.id
            INNER JOIN users u ON r.user_id = u.id
            WHERE r.id = '$id'";

    $this->conexion->query($sql);

    return $this->conexion->getResult()->fetch_assoc();
}
}