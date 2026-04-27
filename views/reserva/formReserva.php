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

        <!-- 📅 FECHA INICIO -->
        <div class="form-group">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" required>
        </div>

        <!-- 📅 FECHA FINAL -->
        <div class="form-group">
            <label>Fecha Final</label>
            <input type="date" name="fecha_final" id="fecha_final" required>
        </div>

        <!-- 🏨 CATEGORÍA -->
        <div class="form-group">
            <label>Categoría</label>
            <select id="categoria" required>
                <option value="">Seleccione</option>

                <?php 
                $categorias = [];
                foreach ($_SESSION['habitaciones'] as $hab) {
                    $categorias[$hab['categoria_id']] = $hab['categoria'];
                }

                foreach ($categorias as $id => $nombre): ?>
                    <option value="<?= $id ?>"><?= $nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- 🚪 HABITACIONES -->
        <div class="form-group">
            <label>Número de habitación</label>
            <select name="habitacion_id" id="habitacion" required>
                <option value="">Seleccione una habitación</option>
            </select>
        </div>

        <!-- BOTÓN -->
        <button type="submit">Reservar</button>

    </form>

    <a href="<?= SITE_URL ?>index.php?action=interfaz" class="back">← Volver</a>

</div>


<script>
const categoria = document.getElementById("categoria");
const habitacion = document.getElementById("habitacion");

categoria.addEventListener("change", async () => {

    if (!categoria.value) {
        habitacion.innerHTML = `<option value="">Seleccione una habitación</option>`;
        return;
    }

    try {
        const response = await fetch(
            `index.php?action=getRoomsByType&categoria_id=${categoria.value}`
        );

        const result = await response.json();

        habitacion.innerHTML = `<option value="">Seleccione una habitación</option>`;

        if (result.ok && result.data.length > 0) {
            result.data.forEach(hab => {
                habitacion.innerHTML += `
                    <option value="${hab.id}">
                        Habitación ${hab.numero}
                    </option>
                `;
            });
        } else {
            habitacion.innerHTML += `<option>No disponibles</option>`;
        }

    } catch (error) {
        console.error("Error:", error);
    }
});


// 🔒 VALIDAR FECHA
const fechaInicio = document.getElementById("fecha_inicio");
const fechaFinal = document.getElementById("fecha_final");
const form = document.querySelector("form");

// 🔒 No permitir fechas pasadas
const hoy = new Date().toISOString().split("T")[0];
fechaInicio.min = hoy;
fechaFinal.min = hoy;

// 🔒 Fecha final no puede ser menor que inicio
fechaInicio.addEventListener("change", () => {
    fechaFinal.min = fechaInicio.value;
});

// 🔒 Validación al enviar
form.addEventListener("submit", (e) => {

    if (!fechaInicio.value || !fechaFinal.value) {
        alert("Debes seleccionar ambas fechas");
        e.preventDefault();
        return;
    }

    if (fechaFinal.value <= fechaInicio.value) {
        alert("La fecha final debe ser mayor a la fecha de inicio");
        e.preventDefault();
        return;
    }

});
</script>
</body>
</html>