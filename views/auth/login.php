<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar — <?= SITE_NAME ?></title>
  <link rel="stylesheet" href="<?= SITE_URL ?>views/css/styles.css">
</head>
<body>

<div class="auth-layout">

  <!-- Panel imagen -->
  <div class="auth-panel" style="background-image:
    linear-gradient(to bottom, rgba(10,10,10,0.4) 0%, rgba(10,10,10,0.85) 100%),
    url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200&q=80');
    background-size: cover; background-position: center;">
    <p class="auth-panel__quote">
      "Bienvenido de vuelta a su santuario de lujo"
    </p>
    <p class="auth-panel__sub"><?= SITE_NAME ?> · Reservas Exclusivas</p>
  </div>

  <!-- Formulario -->
  <div class="auth-form-wrap">
    <div class="auth-form">

      <div class="auth-form__logo">
        <div class="logo-symbol"><div class="logo-inner"></div></div>
        <span><?= SITE_NAME ?></span>
      </div>

      <a href="<?= SITE_URL ?>index.php" class="back-link">← Volver al inicio</a>

      <p class="auth-form__eyebrow">Bienvenido de nuevo</p>
      <h2 class="auth-form__title">Iniciar Sesión</h2>

      <!-- 🔴 ERROR GENERAL -->
      <?php if (!empty($_SESSION['errors']['general'])): ?>
        <div class="alert alert-error">
          <?= htmlspecialchars($_SESSION['errors']['general']) ?>
        </div>
      <?php endif; ?>

      <!-- 🟢 MENSAJE DE ÉXITO -->
      <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success">
          <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?= SITE_URL ?>index.php?action=loginUser">

        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <input type="email" id="email" name="email"
                 placeholder="nombre@correo.com"
                 value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>"
                 required>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password"
                 placeholder="••••••••"
                 required>
        </div>

        <button type="submit" class="btn btn-gold btn-full" style="margin-top:.4rem">
          Ingresar
        </button>
      </form>

      <?php 
        // 🔥 LIMPIAR MENSAJES DESPUÉS DE MOSTRARLOS
        unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']); 
      ?>

      <p class="auth-switch">
        ¿No tienes una cuenta?
        <a href="<?= SITE_URL ?>index.php?action=getFormRegisterUser">Regístrate aquí</a>
      </p>

    </div>
  </div>
</div>

</body>
</html>