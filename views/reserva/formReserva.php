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
            <input type="date" name="fecha_inicio" id="fecha_inicio" required>
        </div>

        
        <div class="form-group">
            <label>Fecha Final</label>
            <input type="date" name="fecha_final" id="fecha_final" required>
        </div>

        
    <div class="form-group">
         <label>Número de personas</label>
        <input type="number" 
           name="n_personas" 
           id="n_personas"
           min="1" 
           max="4" 
           placeholder="Ej: 2"
           required>
        </div>

    
      <div class="form-group">
    <label>Categoría</label>
    <select id="categoria" required>
        <option value="">Seleccione</option>

        <?php 
    
        if (isset($_SESSION['categorias'])):
            foreach ($_SESSION['categorias'] as $cat): ?>
                <option value="<?= $cat['id'] ?>">
                    <?= htmlspecialchars($cat['nombre']) ?>
                </option>
            <?php endforeach;
        endif;
        ?>

    </select>
</div>
    
        <div class="form-group">
            <label>Número de habitación</label>
            <select name="habitacion_id" id="habitacion" required>
                <option value="">Seleccione una habitación</option>
            </select>
        </div>

        <div class="form-group">
    <label>Total a pagar</label>
    <input type="text" id="total" readonly placeholder="$0">
</div>

        
        <button type="submit">Reservar</button>

    </form>

    <a href="<?= SITE_URL ?>index.php?action=interfaz" class="back">← Volver</a>

</div>

<script src="<?= SITE_URL ?>views/js/validacionReserva.js"></script>
</body>
</html>