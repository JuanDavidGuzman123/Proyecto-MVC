<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= SITE_NAME ?></title>
  <link rel="stylesheet" href="<?= SITE_URL ?>views/css/styles.css">
</head>
<body>

<!-- ── Navbar ──────────────────────────────────────────────────────────────── -->
<nav class="navbar">
  <div class="navbar__brand">
    <div class="logo-symbol"><div class="logo-inner"></div></div>
    <span><?= SITE_NAME ?></span>
  </div>

  <ul class="navbar__links">
    <li><a href="#">Inicio</a></li>
    <li><a href="#habitaciones">Habitaciones</a></li>
    <li><a href="#servicios">Servicios</a></li>
    <li><a href="#contacto">Contacto</a></li>
  </ul>

  <div class="navbar__actions">
    <?php if (isset($_SESSION['user'])): ?>
      <span style="font-size:.82rem;color:var(--muted);align-self:center">
        Hola, <?= htmlspecialchars($_SESSION['user']['name']) ?>
      </span>
      <a href="<?= SITE_URL ?>index.php?action=logout" class="btn btn-outline">Salir</a>
    <?php else: ?>
      <a href="<?= SITE_URL ?>index.php?action=getFormLoginUser"    class="btn btn-outline">Ingresar</a>
      <a href="<?= SITE_URL ?>index.php?action=getFormRegisterUser" class="btn btn-gold">Reservar</a>
    <?php endif; ?>
  </div>
</nav>

<!-- ── Hero ────────────────────────────────────────────────────────────────── -->
<section class="hero">
  <div class="hero__bg"></div>
  <div class="hero__grid"></div>
  <div class="hero__image"></div>

  <div class="hero__content">
    <p class="hero__eyebrow">Experiencia de Lujo</p>
    <h1 class="hero__title">
      Donde el <em>lujo</em><br>se convierte<br>en hogar
    </h1>
    <p class="hero__desc">
      Un retiro exclusivo donde la elegancia atemporal y el servicio impecable
      crean memorias que perduran para siempre.
    </p>
    <div class="hero__cta">
      <a href="#habitaciones" class="btn btn-gold">Ver Habitaciones</a>
      <a href="<?= SITE_URL ?>index.php?action=getFormRegisterUser" class="btn btn-outline">Crear Cuenta</a>
    </div>
  </div>

  <div class="hero__stats">
    <div class="stat"><div class="stat__num">48</div><div class="stat__label">Suites</div></div>
    <div class="stat"><div class="stat__num">4.9</div><div class="stat__label">Valoración</div></div>
    <div class="stat"><div class="stat__num">12+</div><div class="stat__label">Años</div></div>
  </div>
</section>

<!-- ── Habitaciones ─────────────────────────────────────────────────────────── -->
<section class="section" id="habitaciones" style="background:var(--dark);">
  <p class="section__eyebrow">Alojamiento</p>
  <h2 class="section__title">Nuestras Habitaciones</h2>
  <div class="divider"></div>
  <p class="section__sub">Cada espacio ha sido cuidadosamente diseñado para ofrecerte el máximo confort y distinción.</p>

  <div class="rooms-grid">
    <div class="room-card">
      <img class="room-card__img"
           src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800&q=80"
           alt="Suite Clásica">
      <div class="room-card__body">
        <p class="room-card__tag">Estándar</p>
        <h3 class="room-card__name">Suite Clásica</h3>
        <p class="room-card__price">desde <strong>$180</strong> / noche</p>
      </div>
    </div>

    <div class="room-card">
      <img class="room-card__img"
           src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=800&q=80"
           alt="Suite Deluxe">
      <div class="room-card__body">
        <p class="room-card__tag">Premium</p>
        <h3 class="room-card__name">Suite Deluxe</h3>
        <p class="room-card__price">desde <strong>$290</strong> / noche</p>
      </div>
    </div>

    <div class="room-card">
      <img class="room-card__img"
           src="https://images.unsplash.com/photo-1591088398332-8a7791972843?w=800&q=80"
           alt="Suite Presidencial">
      <div class="room-card__body">
        <p class="room-card__tag">Exclusiva</p>
        <h3 class="room-card__name">Suite Presidencial</h3>
        <p class="room-card__price">desde <strong>$550</strong> / noche</p>
      </div>
    </div>
  </div>
</section>

<!-- ── Servicios ─────────────────────────────────────────────────────────────── -->
<section class="section" id="servicios">
  <p class="section__eyebrow">Comodidades</p>
  <h2 class="section__title">Servicios Exclusivos</h2>
  <div class="divider"></div>

  <div class="amenities-grid">
    <div class="amenity">
      <div class="amenity__icon">🌊</div>
      <h4 class="amenity__name">Spa & Bienestar</h4>
      <p class="amenity__desc">Tratamientos de relajación y bienestar personalizados</p>
    </div>
    <div class="amenity">
      <div class="amenity__icon">🍷</div>
      <h4 class="amenity__name">Restaurante Gourmet</h4>
      <p class="amenity__desc">Cocina de autor con ingredientes locales e internacionales</p>
    </div>
    <div class="amenity">
      <div class="amenity__icon">🏊</div>
      <h4 class="amenity__name">Piscina Infinita</h4>
      <p class="amenity__desc">Vista panorámica con servicio de cócteles incluido</p>
    </div>
    <div class="amenity">
      <div class="amenity__icon">🚗</div>
      <h4 class="amenity__name">Servicio de Chofer</h4>
      <p class="amenity__desc">Traslados privados aeropuerto y ciudad las 24h</p>
    </div>
  </div>
</section>

<!-- ── Footer ─────────────────────────────────────────────────────────────── -->
<footer class="footer" id="contacto">
  <p class="footer__copy">© <?= date('Y') ?> <?= SITE_NAME ?>. Todos los derechos reservados.</p>
  <p class="footer__copy" style="color:var(--gold)">reservas@villadorada.com &nbsp;·&nbsp; +57 300 000 0000</p>
</footer>

</body>
</html>
