<?php
require_once 'controllers/correoController.php';

class AuthController {

    
    public function getFormLoginUser() {
        require 'views/auth/login.php';
    }

    
    public function getFormRegisterUser() {

        $conexion = new Conexion();
        $conexion->conectar();

        $sql = "SELECT * FROM documentos";
        $conexion->query($sql);
        $result = $conexion->getResult();

        $_SESSION['documentTypes'] = $result->fetch_all(MYSQLI_ASSOC);

        $conexion->desconectar();

        require 'views/auth/register.php';
    }

    
    public function registerUser($datos) {

        unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);

        
        $errores = [];

        if (empty(trim($datos['name'] ?? ''))) {
            $errores['name'] = 'El nombre es requerido';
        }

        if (empty(trim($datos['email'] ?? ''))) {
            $errores['email'] = 'El email es requerido';
        } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no es válido';
        }

        if (empty($datos['password'] ?? '')) {
            $errores['password'] = 'La contraseña es requerida';
        }

        if (count($errores) > 0) {
            $_SESSION['errors'] = $errores;
            $_SESSION['old'] = $datos;

            header('Location: index.php?action=getFormRegisterUser');
            exit;
        }

        $user = new User();

        
        if ($user->validateUser($datos) > 0) {
            $_SESSION['errors'] = ['general' => 'El usuario ya existe'];
            $_SESSION['old'] = $datos;

            header('Location: index.php?action=getFormRegisterUser');
            exit;
        }


    
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);

        $resultado = $user->registerUser($datos);

        if ($resultado > 0) {
            $_SESSION['success'] = 'Usuario registrado correctamente';

            header('Location: index.php?action=getFormLoginUser');
            exit;
        } else {
            $_SESSION['errors'] = ['general' => 'Error al registrar'];

            header('Location: index.php?action=getFormRegisterUser');
            exit;
        }
    }

    
    public function loginUser($datos) {

        unset($_SESSION['errors'], $_SESSION['success']);

        if (empty(trim($datos['email'] ?? '')) || empty($datos['password'] ?? '')) {
            $_SESSION['errors'] = ['general' => 'Correo y contraseña requeridos'];

            header('Location: index.php?action=getFormLoginUser');
            exit;
        }

        $user = new User();
        $result = $user->loginUser($datos);

        if ($result) {
            $_SESSION['user'] = $result;

            header('Location: index.php?action=interfaz');
            exit;
        } else {
            $_SESSION['errors'] = ['general' => 'Credenciales incorrectas'];

            header('Location: index.php?action=getFormLoginUser');
            exit;
        }
    }

    

    
    public function logoutUser() {
        session_destroy();

        header('Location: index.php?action=getFormLoginUser');
        exit;
    }
}