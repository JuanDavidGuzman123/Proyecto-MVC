<?php
if (!isset($_SESSION['user'])) {
    header('Location: index.php?action=getFormLoginUser');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title> Reservas</title>
    <link rel="stylesheet" href="<?= SITE_URL ?>views/css/interfaz.css">
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header-card">
        <div>
            <h1>👋 Hola, <?= htmlspecialchars($user['name']) ?></h1>
            <p>Bienvenido a tu sistema de reservas de hotel</p>
        </div>

        <div class="header-actions">
            <a href="<?= SITE_URL ?>index.php?action=formReserva" class="btn btn-primary">+ Nueva reserva</a>
            <a href="<?= SITE_URL ?>index.php?action=logout" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>

    <!-- RESERVAS -->
    <div class="card">
        <h2>📋 Mis Reservas</h2>

        <?php if (!empty($_SESSION['reservas'])): ?>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($_SESSION['reservas'] as $res): ?>
                        <tr>
                            <td>
                                <strong><?= htmlspecialchars($res['categoria']) ?></strong><br>
                                <small><?= $res['numero_camas'] ?> camas</small>
                            </td>

                            <td><?= $res['fecha_inicio'] ?></td>
                            <td><?= $res['fecha_final'] ?></td>

                          <td>
                             <a href="<?= SITE_URL ?>index.php?action=editarReserva&id=<?= $res['id'] ?>"
                            class="btn-small btn-edit">
                                Actualizar
                                </a>

                                <a href="<?= SITE_URL ?>index.php?action=eliminarReserva&id=<?= $res['id'] ?>"
                                class="btn-small btn-delete"
                                onclick="return confirm('¿Eliminar esta reserva?')">
                                Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>
            <p class="empty">No tienes reservas aún. Crea tu primera reserva 👇</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>