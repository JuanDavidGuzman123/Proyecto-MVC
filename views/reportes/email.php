<?php

$nombreCliente = $nombreCliente ?? 'Usuario';

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
    padding:40px;
}

.card{
    max-width:650px;
    margin:auto;
    background:white;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.header{
    background:#000;
    color:#D4AF37;
    padding:35px;
    text-align:center;
}

.content{
    padding:35px;
    color:#333;
    line-height:1.8;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:14px 28px;
    background:#D4AF37;
    color:black;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
}

.footer{
    background:#f1f1f1;
    padding:20px;
    text-align:center;
    color:#777;
    font-size:13px;
}

</style>

</head>

<body>

<div class="card">

    <div class="header">

        <h1>HOTEL VILLA DORADA</h1>

    </div>

    <div class="content">

        <h2>
            Hola <?= $nombreCliente ?> 👋
        </h2>

        <p>
            Tu reserva fue confirmada correctamente.
        </p>

        <p>
            Gracias por elegir Hotel Villa Dorada.
            Esperamos brindarte una experiencia
            inolvidable.
        </p>

        <a
            href="http://localhost/MVCC/"
            class="btn"
        >
            Ver Sitio
        </a>

    </div>

    <div class="footer">

        © Hotel Villa Dorada -
        Todos los derechos reservados

    </div>

</div>

</body>
</html>