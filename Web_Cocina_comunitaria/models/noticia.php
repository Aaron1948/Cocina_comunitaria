<?php
    require_once __DIR__ . '/../models/DB.php';

    class Noticias{
        // Propiedad Privada: solo accesible dentro de la clase.
        private $conexion;

        // Constructor: recibe la conexion PDO al crear el objeto.
        public function __construct($conexion){
            $this->conexion = $conexion;
        }

        // Metodo publico: crear Noticia.
        public function crearNoticia($titulo, $imagen, $texto, $fecha, $idUser){
            $stmt = $this->conexion->prepare("INSERT INTO noticias (titulo, imagen, texto,
            fecha,idUser) VALUES (:titulo, :imagen, :texto, :fecha, :idUser)");

            return $stmt->execute([
                ':titulo' => $titulo,
                ':imagen' => $imagen,
                ':texto' => $texto,
                ':fecha' => $fecha,
                ':idUser' => $idUser
            ]);
        }

        public function modificarNoticia($titulo, $imagen, $texto, $fecha, $idNoticia){
            $stmt = $this->conexion->prepare("UPDATE noticias SET titulo = :titulo, imagen = :imagen,
            texto = :texto, fecha = :fecha WHERE idNoticia = :idNoticia");

            return $stmt->execute([
                ':titulo' => $titulo,
                ':imagen' => $imagen,
                ':texto' => $texto,
                ':fecha' => $fecha,
                ':idNoticia' => $idNoticia
            ]);
        }

        public function borrarNoticia($idNoticia){
            // Obtener el nombre de la imagen.
            $stmtSelect = $this->conexion->prepare("SELECT imagen FROM noticias WHERE idNoticia
            = :idNoticia");
            $stmtSelect->execute([':idNoticia' => $idNoticia]);
            $noticia = $stmtSelect->fetch(PDO::FETCH_ASSOC);

            if($noticia && !empty($noticia['imagen'])){
                $rutaImagen = __DIR__ . "/../public/images/noticias_images/" . $noticia['imagen'];
                // Borrar la imagen SI EXISTE fisicamente.
                try{
                    if(file_exists($rutaImagen)){
                        unlink($rutaImagen);
                    }
                }catch(Exception $e){
                    error_log("Error al borrar la imagen: " . $e->getMessage());
                }
            }
                
            // Borrar la noticia de la BBDD.
            $stmtDelete = $this->conexion->prepare("DELETE FROM noticias WHERE idNoticia = :idNoticia");
            return $stmtDelete->execute([
                ':idNoticia' => $idNoticia
            ]);
        }

        public function listarNoticias() {
            try {
                $sql = "SELECT 
                            n.idNoticia, 
                            n.titulo, 
                            n.imagen, 
                            n.texto, 
                            n.fecha, 
                            d.nombre AS autor
                        FROM noticias n
                        JOIN users_data d ON n.idUser = d.idUser
                        ORDER BY n.fecha DESC";
                
                $stmt = $this->conexion->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Error al listar noticias: " . $e->getMessage());
                return [];
            }
        }

        public function obtenerNoticiaPorId($idNoticia){
            try{
                $sql = "SELECT idNoticia, titulo, imagen, texto, fecha FROM noticias WHERE idNoticia = :idNoticia";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(":idNoticia", $idNoticia, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("Error al obetner la noticia: " .$e->getMessage());
                return null;
            }
        }
    }
?>