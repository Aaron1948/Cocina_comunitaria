<?php
    require_once __DIR__ . '/../models/DB.php';

    $conexion = DB::connect();

    class Usuario{
        public static function insertarUsuario($conexion, $nombre, $apellidos, $email, $telefono,
        $fechaNac, $direccion, $sexo, $usuario, $password, $rol) {

            try {
                // Insert en users_data
                $sql = "INSERT INTO users_data (nombre, apellidos, email, telefono, fecha_nacimiento, direccion, sexo)
                        VALUES (:nombre, :apellidos, :email, :telefono, :fecha_nacimiento, :direccion, :sexo)";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":apellidos", $apellidos);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":telefono", $telefono);
                $stmt->bindParam(":fecha_nacimiento", $fechaNac);
                $stmt->bindParam(":direccion", $direccion);
                $stmt->bindParam(":sexo", $sexo);
                $stmt->execute();

                $idUser = $conexion->lastInsertId();

                // Insert en users_login
                $sqlLogin = "INSERT INTO users_login (idUser, usuario, password, rol)
                            VALUES (:idUser, :usuario, :password, :rol)";
                $stmtLogin = $conexion->prepare($sqlLogin);
                $stmtLogin->bindParam(":idUser", $idUser);
                $stmtLogin->bindParam(":usuario", $usuario);
                $stmtLogin->bindParam(":password", $password);
                $stmtLogin->bindParam(":rol", $rol);
                $stmtLogin->execute();

                return true;

            } catch (PDOException $e) {
                
                if (empty($_SESSION['errores']) || !is_array($_SESSION['errores'])) {
                    $_SESSION['errores'] = [];
                }
                
                if($e->getCode() == 23000){
                    // Error de clave unica
                    $_SESSION['errores'][] = "El email ya existe en la base de datos.";
                }else{
                    $_SESSION['errores'][] = "Error en BD: " . $e->getMessage();
                }
                
                return false;
            }
        }

        public static function loginUsuario($conexion, $usuario, $password){
            $sql = "SELECT idLogin, idUser, usuario, password, rol FROM users_login 
            WHERE usuario = :usuario";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user && password_verify($password, $user['password'])){
                return $user; // contiene tambien  el rol.
            }
            return false;
        }

        public static function cambiarPass($conexion, $idUser, $passActual, $passNueva){
            $sql = "SELECT password FROM users_login WHERE idUser = :idUser";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if($usuario && password_verify($passActual, $usuario['password'])){
                $hash = password_hash($passNueva, PASSWORD_BCRYPT);
                $sqlUpdate = "UPDATE users_login SET password = :new WHERE idUser = :idUser";
                $stmtUpdate = $conexion->prepare($sqlUpdate);
                $stmtUpdate->bindParam(":new", $hash, PDO::PARAM_STR);
                $stmtUpdate->bindParam(":idUser", $idUser, PDO::PARAM_INT);

                return $stmtUpdate->execute();
            }

            return false;
        }

        public static function borrarUsuario($conexion, $idUser){
            try{
                // Iniciamos la transaccion por si hay error despues, que no se generen inconsistencias.
                $conexion->beginTransaction();

                // Borrar de la tabla users_login(tabla dependiente)
                $sqlLogin = "DELETE FROM users_login WHERE idUser = :idUser";
                $stmtLogin = $conexion->prepare($sqlLogin);
                $stmtLogin->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                $stmtLogin->execute();

                // Luego Borramos de users_data
                $sqlData = "DELETE FROM users_data WHERE idUser = :idUser";
                $stmtData = $conexion->prepare($sqlData);
                $stmtData->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                $stmtData->execute();

                // Confirmamos transaccion
                $conexion->commit();
                return true;

            }catch(PDOException $e){
                $conexion->rollBack();
                if(empty($_SESSION['errores']) || !is_array($_SESSION['errores'])){
                    $_SESSION['errores'] = [];
                }
                $_SESSION['errores'][] = "Error al borrar usuario: " . $e->getMessage();
                return false;
            }
        }

        public static function obtenerUsuarioPorId($conexion, $idUser){
            try{
                $sql = "SELECT d.*, l.rol 
                FROM users_data d
                INNER JOIN users_login l ON d.idUser = l.idUser
                WHERE d.idUser = :idUser";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
                $stmt->execute();
                
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                if(empty($_SESSION['errores']) || !is_array($_SESSION['errores'])){
                    $_SESSION['errores'] = [];
                }
                $_SESSION['errores'][] = "Error al obtener al usuario: " .$e->getMessage();
                return null;
            }
        }

        public static function actualizarUsuario($conexion, $idUser, $nombre, $apellidos, $email,
        $telefono, $fechaNac, $direccion, $sexo, $rol ){
            try{
                // Iniciamos Transaccion
                $conexion->beginTransaction();

                // Actualizamos primero en users_data
                $sqlData = "UPDATE users_data SET nombre = :nombre, apellidos = :apellidos, email = :email,
                telefono = :telefono, fecha_nacimiento = :fechaNac, direccion = :direccion, sexo = :sexo WHERE
                idUser = :idUser";
                $stmtData = $conexion->prepare($sqlData);
                $stmtData->bindParam(":nombre", $nombre);
                $stmtData->bindParam(":apellidos", $apellidos);
                $stmtData->bindParam(":email", $email);
                $stmtData->bindParam(":telefono", $telefono);
                $stmtData->bindParam(":fechaNac", $fechaNac);
                $stmtData->bindParam(":direccion", $direccion);
                $stmtData->bindParam(":sexo", $sexo);
                $stmtData->bindParam(":idUser", $idUser,PDO::PARAM_INT);
                $stmtData->execute();

                // Ahora el rol en users_login
                $sqlLogin = "UPDATE users_login SET rol = :rol WHERE idUser = :idUser";
                $stmtLogin = $conexion->prepare($sqlLogin);
                $stmtLogin->bindParam(":rol", $rol);
                $stmtLogin->bindParam(":idUser", $idUser,PDO::PARAM_INT);
                $stmtLogin->execute();

                // Confirmar Transaccion
                $conexion->commit();
                return true;

            }catch(PDOException $e){
                $conexion->rollBack();
                if(!isset($_SESSION['errores']) || !is_array($_SESSION['errores'])){
                    $_SESSION['errores'] = [];
                }
                $_SESSION['errores'][] = "Error al actualizar usuario: " . $e->getMessage();
                return false; 
            }
        }
    }
?>