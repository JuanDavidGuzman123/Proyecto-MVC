<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Cuenta — <?= SITE_NAME ?></title>
  <link rel="stylesheet" href="<?= SITE_URL ?>views/css/styles.css">
</head>
<body>

<div class="auth-layout">

  <!-- PANEL -->
  <div class="auth-panel">
    <p class="auth-panel__quote">
      "Un destino donde cada detalle ha sido pensado para usted"
    </p>
    <p class="auth-panel__sub"><?= SITE_NAME ?> · Desde 2012</p>
  </div>

  <!-- FORM -->
  <div class="auth-form-wrap">
    <div class="auth-form">

      <div class="auth-form__logo">
        <div class="logo-symbol"><div class="logo-inner"></div></div>
        <span><?= SITE_NAME ?></span>
      </div>

      <a href="<?= SITE_URL ?>index.php" class="back-link">← Volver al inicio</a>

      <p class="auth-form__eyebrow">Acceso exclusivo</p>
      <h2 class="auth-form__title">Crear Cuenta</h2>

      <!-- 🔴 ERROR GENERAL -->
      <?php if (!empty($_SESSION['errors']['general'])): ?>
        <div class="alert alert-error">
          <?= htmlspecialchars($_SESSION['errors']['general']) ?>
        </div>
      <?php endif; ?>

      <!-- 🟢 MENSAJE ÉXITO -->
      <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
          <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?= SITE_URL ?>index.php?action=registerUser">

        <!-- DOCUMENTO -->
        <div class="form-row">
          <div class="form-group">
            <label>Tipo Documento</label>

            <select name="document_type_id" required>
              <option value="">Seleccionar</option>

              <?php foreach ($_SESSION['documentTypes'] ?? [] as $doc): ?>
                <option value="<?= $doc['id'] ?>"
                  <?= (($_SESSION['old']['document_type_id'] ?? '') == $doc['id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($doc['nombre']) ?>
                </option>
              <?php endforeach; ?>

            </select>

            <?php if (!empty($_SESSION['errors']['document_type_id'])): ?>
              <span class="form-error"><?= $_SESSION['errors']['document_type_id'] ?></span>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Nº Documento</label>
            <input type="text" name="document_number"
              value="<?= htmlspecialchars($_SESSION['old']['document_number'] ?? '') ?>" required>

            <?php if (!empty($_SESSION['errors']['document_number'])): ?>
              <span class="form-error"><?= $_SESSION['errors']['document_number'] ?></span>
            <?php endif; ?>
          </div>
        </div>

        <!-- NOMBRE -->
        <div class="form-row">
          <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="name"
              value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>" required>

            <?php if (!empty($_SESSION['errors']['name'])): ?>
              <span class="form-error"><?= $_SESSION['errors']['name'] ?></span>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Apellido</label>
            <input type="text" name="last_name"
              value="<?= htmlspecialchars($_SESSION['old']['last_name'] ?? '') ?>" required>

            <?php if (!empty($_SESSION['errors']['last_name'])): ?>
              <span class="form-error"><?= $_SESSION['errors']['last_name'] ?></span>
            <?php endif; ?>
          </div>
        </div>

        <!-- TELEFONO -->
        <div class="form-group">
          <label>Teléfono</label>
          <input type="text" name="phone"
            value="<?= htmlspecialchars($_SESSION['old']['phone'] ?? '') ?>" required>

          <?php if (!empty($_SESSION['errors']['phone'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['phone'] ?></span>
          <?php endif; ?>
        </div>

        <!-- EMAIL -->
        <div class="form-group">
          <label>Correo</label>
          <input type="email" name="email"
            value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>" required>

          <?php if (!empty($_SESSION['errors']['email'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['email'] ?></span>
          <?php endif; ?>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" name="password" required>

          <?php if (!empty($_SESSION['errors']['password'])): ?>
            <span class="form-error"><?= $_SESSION['errors']['password'] ?></span>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-gold btn-full">
          Crear Cuenta
        </button>
      </form>

      <?php 
        // 🔥 limpiar al final (MUY IMPORTANTE)
        unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']); 
      ?>

      <p class="auth-switch">
        ¿Ya tienes una cuenta?
        <a href="<?= SITE_URL ?>index.php?action=getFormLoginUser">Inicia sesión aquí</a>
      </p>

    </div>
  </div>
</div>

<script src="<?= SITE_URL ?>views/js/validaciones.js"></script>

</body>
</html>