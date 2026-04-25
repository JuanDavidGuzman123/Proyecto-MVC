    <?php

    class User {

        
        public function validateUser($data) {
            $conexion = new Conexion();
            $conexion->conectar();

            $email = $data['email'];
            $sql   = "SELECT * FROM users WHERE email = '$email'";
            $conexion->query($sql);
            $result = $conexion->getResult();

            $conexion->desconectar();

            return ($result->num_rows > 0) ? 1 : 0;
        }

        
        public function registerUser($data) {
            $conexion = new Conexion();
            $conexion->conectar();

            $sql = "INSERT INTO users
                    (document_type_id, document_number, name, last_name, phone, email, password)
                    VALUES
                    ('{$data['document_type_id']}',
                    '{$data['document_number']}',
                    '{$data['name']}',
                    '{$data['last_name']}',
                    '{$data['phone']}',
                    '{$data['email']}',
                    '{$data['password']}')";

            $conexion->query($sql);
            $filas = $conexion->getFilasAfectadas();

            $conexion->desconectar();

            return $filas;
        }


        public function loginUser($data) {
            $conexion = new Conexion();
            $conexion->conectar();

            $email = $data['email'];
            $sql   = "SELECT * FROM users WHERE email = '$email'";
            $conexion->query($sql);
            $result = $conexion->getResult();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

            
                if (password_verify($data['password'], $user['password'])) {
                    $conexion->desconectar();
                    return $user;
                }
            }

            $conexion->desconectar();
            return null;
        }
    }

    ?>