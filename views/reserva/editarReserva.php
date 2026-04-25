<form action="<?= SITE_URL ?>index.php?action=actualizarReserva" method="POST">

    <input type="hidden" name="id" value="<?= $_SESSION['reserva']['id'] ?>">

    <label>Fecha Inicio</label>
    <input type="date" name="fecha_inicio"
           value="<?= $_SESSION['reserva']['fecha_inicio'] ?>" required>

    <label>Fecha Final</label>
    <input type="date" name="fecha_final"
           value="<?= $_SESSION['reserva']['fecha_final'] ?>" required>

    <button type="submit">Actualizar</button>

</form>