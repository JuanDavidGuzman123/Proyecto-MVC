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
    <title>Reservas</title>

    <link rel="stylesheet" href="<?= SITE_URL ?>views/css/interfaz.css">
</head>
<body>

<div class="container">
    <div class="header-card">
        <div>
            <h1>
                👋 Hola, <?= htmlspecialchars($user['name']) ?>
            </h1>
                 <p>
                Bienvenido a tu sistema de reservas de hotel
            </p>
        </div>

        <div class="header-actions">
         <a
                href="<?= SITE_URL ?>index.php?action=formReserva"
                class="btn btn-primary"
            >
                + Nueva reserva
            </a>
            <a
                href="<?= SITE_URL ?>index.php?action=logout"
                class="btn btn-danger"
            >
                Cerrar sesión
            </a>

        </div>

    </div>

    <a
        href="<?= SITE_URL ?>index.php?action=generarExcel"
        class="btn btn-success"
    >
        📥 Descargue aqui el Excel
    </a>

    <div class="card">

        <div class="reservas-header">
            <div>
                <h2>📋 Mis Reservas</h2>

                <p class="sub">
                    Aquí puedes ver todas tus reservas realizadas.
                </p>
            </div>

            <div class="contador">
                <?= count($_SESSION['reservas'] ?? []) ?> Reservas
            </div>

        </div>

        <?php if (!empty($_SESSION['reservas'])): ?>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Fechas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($_SESSION['reservas'] as $res): ?>

                    <tr>

                        <td>

                            <div class="habitacion-info">

                                <strong>
                                    <?= htmlspecialchars($res['categoria']) ?>
                                </strong>

                                <small>
                                    🛏 <?= $res['numero_camas'] ?> camas
                                </small>

                            </div>

                        </td>

                        <td>

                            <div class="fechas">

                                <span>
                                    📅 <?= $res['fecha_inicio'] ?>
                                </span>

                                <span>
                                    📅 <?= $res['fecha_final'] ?>
                                </span>

                            </div>

                        </td>

                        <td>

                            <span class="estado estado-activa">
                                Confirmada
                            </span>

                        </td>

                        <td>

                            <div class="acciones">

                                <a
                                    href="<?= SITE_URL ?>index.php?action=editarReserva&id=<?= $res['id'] ?>"
                                    class="btn-small btn-edit"
                                >
                                    ✏ Editar
                                </a>

                                 <a
                                    href="<?= SITE_URL ?>index.php?action=eliminarReserva&id=<?= $res['id'] ?>"
                                    class="btn-small btn-delete"
                                    onclick="return confirm('¿Eliminar esta reserva?')"
                             >
                🗑 Eliminar
                     </a>

                  <a
    href="<?= SITE_URL ?>index.php?action=generarPDF&id=<?= $res['id'] ?>"
    class="btn-small btn-pdf"
    target="_blank"
    >
     📄 PDF
     </a>
</div>

        </td>

        </tr>

    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

 <?php else: ?>

<div class="empty-box">

        <h3>
     No tienes reservas
    </h3>

    <p>
 Aún no has realizado ninguna reserva en el hotel.
        </p>

        <a
        href="<?= SITE_URL ?>index.php?action=formReserva"
        class="btn btn-primary"
                >
             + Crear Reserva
        </a>
        </div>
<?php endif; ?>

    </div>

</div>

</body>
</html>