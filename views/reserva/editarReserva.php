<body data-precio="<?= $_SESSION['reserva']['precio'] ?? 0 ?>">

<h2 style="text-align:center; margin-bottom:20px;">
    Actualiza tu reserva
</h2>

<link rel="stylesheet" href="<?= SITE_URL ?>views/css/editar.css">

<form action="<?= SITE_URL ?>index.php?action=actualizarReserva" method="POST">

    <input type="hidden" 
           name="id" 
           value="<?= $_SESSION['reserva']['id'] ?>">

    <input type="hidden" 
           name="habitacion_actual" 
           value="<?= $_SESSION['reserva']['habitacion_id'] ?>">

    
    <div class="form-group">

        <label>Fecha Inicio</label>

        <input type="date"
               name="fecha_inicio"
               id="fecha_inicio"
               value="<?= $_SESSION['reserva']['fecha_inicio'] ?>"
               required>

    </div>


    <div class="form-group">

        <label>Fecha Final</label>

        <input type="date"
               name="fecha_final"
               id="fecha_final"
               value="<?= $_SESSION['reserva']['fecha_final'] ?>"
               required>

    </div>


    <div class="form-group">

        <label>Número de personas</label>

        <input type="number"
               name="n_personas"
               min="1"
               max="4"
               value="<?= $_SESSION['reserva']['n_personas'] ?? 1 ?>"
               required>

    </div>


    <div class="form-group">

        <label>Categoría</label>

        <select id="categoria" required>

            <option value="">Seleccione</option>

            <?php foreach ($_SESSION['categorias'] as $cat): ?>

                <option value="<?= $cat['id'] ?>"
                    <?= ($_SESSION['reserva']['categoria_id'] == $cat['id']) ? 'selected' : '' ?>>

                    <?= htmlspecialchars($cat['nombre']) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>


    <div class="form-group">

        <label>Habitación actual</label>

        <div class="info-actual">

            <?= htmlspecialchars($_SESSION['reserva']['categoria']) ?> -

            Habitación <?= $_SESSION['reserva']['numero'] ?>

        </div>

    </div>


    <div class="form-group">

        <label>Cambiar habitación (opcional)</label>

        <select name="habitacion_id" id="habitacion">

            <option value="">Mantener actual</option>

        </select>

    </div>


    <div class="form-group">

        <label>Total a pagar</label>

        <input type="text"
               id="total"
               readonly
               placeholder="$0">

    </div>


    <button type="submit">
        Actualizar Reserva
    </button>

</form>

<script src="<?= SITE_URL ?>views/js/editar.js"></script>

</body>