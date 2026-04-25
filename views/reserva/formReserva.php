<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservar Habitación</title>
    <link rel="stylesheet" href="<?= SITE_URL ?>views/css/reserva.css">
</head>
<body>

<div class="container">

    <h2>Reservar Habitación</h2>

    <form action="<?= SITE_URL ?>index.php?action=guardarReserva" method="POST">

        <div class="form-group">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" required>
        </div>

        <div class="form-group">
            <label>Fecha Final</label>
            <input type="date" name="fecha_final" required>
        </div>

        <div class="form-group">
           <label>Habitación</label>

<select name="habitacion_id" id="habitacion" required>

    <option value="">Seleccionar habitación</option>

    <?php if (isset($_SESSION['habitaciones'])): ?>
        <?php foreach ($_SESSION['habitaciones'] as $hab): ?>
            <option 
                value="<?= $hab['id'] ?>"
                data-descripcion="<?= htmlspecialchars($hab['descripcion']) ?>"
                data-precio="<?= $hab['precio'] ?>"
                data-estado="<?= htmlspecialchars($hab['estado']) ?>"
            >
                <?= htmlspecialchars($hab['categoria']) ?> -
                <?= $hab['numero_camas'] ?> camas -
                $<?= $hab['precio'] ?> -
                <?= htmlspecialchars($hab['estado']) ?> -
                <?= substr(htmlspecialchars($hab['descripcion']), 0, 30) ?>...
            </option>
        <?php endforeach; ?>
    <?php endif; ?>

</select>
            </select>
            <div id="infoHabitacion" style="margin-top:15px; padding:10px; border:1px solid #ccc; border-radius:5px;">
            <p><strong>Descripción:</strong> <span id="desc">-</span></p>
            <p><strong>Precio:</strong> $<span id="precio">-</span></p>
            <p><strong>Estado:</strong> <span id="estado">-</span></p>
</div>
        </div>

        <button type="submit">Reservar</button>

    </form>

    <a href="<?= SITE_URL ?>index.php?action=interfaz" class="back">← Volver</a>

</div>

</body>
<script>
document.getElementById("habitacion").addEventListener("change", function() {

    let selected = this.options[this.selectedIndex];

    document.getElementById("desc").textContent = selected.dataset.descripcion || "-";
    document.getElementById("precio").textContent = selected.dataset.precio || "-";
    document.getElementById("estado").textContent = selected.dataset.estado || "-";

});
</script>
</html>