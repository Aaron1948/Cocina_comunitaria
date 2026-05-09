<?php
class Validaciones{
    public static function validarRegistro(){
    $errores = [];

    // Nombre
    $nombre = trim(strip_tags(filter_input(INPUT_POST, "nombre", FILTER_UNSAFE_RAW)));
    if(empty($nombre)){
        $errores[] = "El campo Nombre no puede estar vacío.";
    }

    // Apellidos
    $apellidos = trim(strip_tags(filter_input(INPUT_POST, "apellidos", FILTER_UNSAFE_RAW)));
    if(empty($apellidos)){
        $errores[] = "El campo Apellidos no puede quedar vacío.";
    }

    // Email
    $emailRaw = filter_input(INPUT_POST, "email", FILTER_UNSAFE_RAW);
    $email = filter_var(trim($emailRaw), FILTER_VALIDATE_EMAIL);
    if($email === false){
        $errores[] = "El campo Email no tiene un formato válido.";
    }

    // Teléfono
    $telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_NUMBER_INT);
    if(empty($telefono)){
        $errores[] = "El campo Teléfono no puede estar vacío.";
    } elseif(strlen($telefono) < 9){
        $errores[] = "El teléfono debe tener al menos 9 dígitos.";
    } elseif(!ctype_digit($telefono)){
        $errores[] = "El teléfono solo puede contener números.";
    }

    // Fecha de nacimiento
    $fechaNac = filter_input(INPUT_POST, "fechaNac", FILTER_UNSAFE_RAW);
    if(empty($fechaNac)){
        $errores[] = "El campo Fecha no puede estar vacío.";
    } else {
        $d = DateTime::createFromFormat('Y-m-d', $fechaNac);
        if(!$d || $d->format('Y-m-d') !== $fechaNac){
            $errores[] = "La fecha de nacimiento no es válida.";
        }
    }

    // Dirección
    $direccion = trim(strip_tags(filter_input(INPUT_POST, "direccion", FILTER_UNSAFE_RAW)));
    if(empty($direccion)){
        $errores[] = "El campo Dirección no puede estar vacío.";
    }

    // Usuario
    $usuario = trim(strip_tags(filter_input(INPUT_POST, "usuario", FILTER_UNSAFE_RAW)));
    if(empty($usuario)){
        $errores[] = "El campo Usuario no puede estar vacío.";
    }

    // Contraseña
    $password = filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW);
    if(empty($password)){
        $errores[] = "El campo Contraseña no puede estar vacío.";
    } elseif(strlen($password) < 6){
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    // Sexo
    if(isset($_POST['sexo'])){
        $sexo = trim($_POST['sexo']);
        $generoValido = ["hombre", "mujer", "otro"];
        if(!in_array($sexo, $generoValido, true)){
            $errores[] = "Selecciona una opción válida en el campo Sexo.";
        }
    } else {
        $errores[] = "El campo Sexo es obligatorio.";
    }

    return $errores;
}

    public static function validarLogin($usuario, $password){
        // Array para los errores
        $errores = [];
        // Validacion de campo vacio en Login
        if(empty($usuario)){
            $errores[] = "Porfavor escribe tu nombre de usuario.";
        }

        if(empty($password)){
            $errores[] = "Porfavor introduce tu password.";
        }
        
        return $errores;
    }
    
    public static function validarCambioPass($passActual, $passNueva, $passConfirmacion){
        $errores = [];

        if(empty($passActual) || empty($passNueva) || empty($passConfirmacion)){
            $errores[] = "Debes completar todos los campos.";
        }

        if($passNueva !== $passConfirmacion){
            $errores[] = "Las contraseñas deben coincidir.";
        }

        if(strlen($passNueva) < 6){
            $errores[] = "La nueva contraseña debe tener como minimo 6 caracteres.";
        }
        
        return $errores;
    }

    public static function validarRol($rol){

        $errores = [];
        $rolesPermitidos = ['user', 'admin'];

        if(!in_array($rol, $rolesPermitidos)){
            $errores[] = "El rol debe ser 'user' o 'admin'";
        }
        return $errores;
    }

    public static function adminUserValidacion(){
        // Errores.
        $errores = [];
        // Saneamiento y Validacion de campos.
        $nombre = filter_input(INPUT_POST, "nombre", FILTER_UNSAFE_RAW);
        $nombre = trim(strip_tags($nombre));
        $apellidos = filter_input(INPUT_POST, "apellidos", FILTER_UNSAFE_RAW);
        $apellidos = trim(strip_tags($apellidos));
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_NUMBER_INT);
        
        // Validacion de Fecha.
        $fechaNac = filter_input(INPUT_POST, "fechaNac", FILTER_UNSAFE_RAW);
        $d = DateTime::createFromFormat('Y-m-d', $fechaNac);
        if(!$d || $d->format('Y-m-d') !== $fechaNac){
            $errores[] = "La fecha de nacimiento no es válida.";
        }

        $direccion = filter_input(INPUT_POST, "direccion", FILTER_UNSAFE_RAW);
        $direccion = trim(strip_tags($direccion));

        // Validaciones Basicas
        if(empty($nombre)){
            $errores[] = "El Campo Nombre no puede estar vacío.";
        }

        if(empty($apellidos)){
            $errores[] = "El Campo Apellidos no puede quedar vacío";
        }

        if($email === false){
            $errores[] = "El Campo Email no tiene un formato válido.";
        }

        if(empty($telefono)){
            $errores[] = "El campo Teléfono no puede estar vacío.";
            } elseif(strlen($telefono) < 9){
            $errores[] = "El teléfono debe tener al menos 9 dígitos.";
            } elseif(!ctype_digit($telefono)){
            $errores[] = "El teléfono solo puede contener números.";
        }

        if(empty($fechaNac)){
            $errores[] = "El Campo Fecha no puede estar vacío.";
        }

        if(empty($direccion)){
            $errores[] = "El Campo Direccion no puede estar vacío.";
        }

        // Validacion de Sexo
        if(isset($_POST['sexo'])){
            $sexo = trim($_POST['sexo']);
            $generoValido = ["hombre", "mujer", "otro"];

            if(!in_array($sexo, $generoValido, true)){
                $errores[] = "Selecciona una opcion válida en el campo sexo.";
            }

        }else{
            $errores[] = "El campo sexo es obligatorio.";
        }   
        
        // Si hay errores los devolvemos
        return $errores;
    }

}    
?>