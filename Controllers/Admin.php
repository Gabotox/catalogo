<?php
class Admin extends Controller
{


    public function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }


    public function login()
    {
        $this->views->getView("Auth", "login", "");
    }


    // Quedo por corregir de aquí en adelante
    public function loginAdmin()
    {
        // Recibir datos JSON
        $inputJSON = file_get_contents("php://input");
        $input = json_decode($inputJSON, true);

        if (isset($input["usuario"]) && isset($input["contra"])) {
            $usuario = trim($input["usuario"]);
            $contra = trim($input["contra"]);


            // Validar que no estén vacíos
            if (empty($usuario) || empty($contra)) {
                echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
                return;
            }

            // Buscar usuario en la base de datos (ejemplo con un modelo)
            $userModel = new AdminModel();
            $usuarioData = $userModel->login($usuario);



            if ($usuarioData) {
                // Verificar la contraseña
                if (password_verify($contra, $usuarioData["password_usuario"])) {
                    // Iniciar sesión si no está iniciada
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    // Guardar datos en la sesión
                    $_SESSION["usuario_id"] = $usuarioData["id_usuario"];
                    $_SESSION["usuario_nombre"] = $usuarioData["nombre_usuario"];
                    $_SESSION["usuario_rol"] = $usuarioData["rol_usuario"]; // Para validar el rol en otras partes

                    echo json_encode(["status" => "success", "message" => "Inicio de sesión exitoso"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "El usuario no existe o no es ADMIN"]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Faltan datos"
            ]);
        }
    }

    public function registrar()
    {
        header('Content-Type: application/json'); // Forzar respuesta JSON

        // Leer los datos JSON
        $data = json_decode(file_get_contents("php://input"), true);

        // Validar que se recibieron los datos
        if (
            !isset($data["nombre"]) ||
            !isset($data["apellido"]) ||
            !isset($data["usuario"]) ||
            !isset($data["contra"])
        ) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        // Limpiar los datos
        $nombre = trim($data["nombre"]);
        $apellido = trim($data["apellido"]);
        $usuario = trim($data["usuario"]);
        $contra = trim($data["contra"]);

        // Verificar que los campos no estén vacíos
        if (empty($nombre) || empty($apellido) || empty($usuario) || empty($contra)) {
            echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
            return;
        }

        // Instancia del modelo
        $userModel = new AdminModel();

        // Verificar si el usuario ya existe
        if ($userModel->buscarUsuario($usuario)) {
            echo json_encode(["status" => "error", "message" => "El usuario ya está registrado"]);
            return;
        }

        // Hashear la contraseña antes de guardarla en la base de datos
        $contraHash = password_hash($contra, PASSWORD_BCRYPT);

        // Guardar usuario en la base de datos
        $registroExitoso = $userModel->registrarUsuario([
            "nombre" => $nombre,
            "apellido" => $apellido,
            "usuario" => $usuario,
            "contra" => $contraHash
        ]);

        // Respuesta según el resultado del registro
        if ($registroExitoso) {
            echo json_encode(["status" => "success", "message" => "Registro exitoso"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar usuario"]);
        }
    }

    public function cerrarSesion()
    {
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruir todas las variables de sesión
        $_SESSION = [];

        // Destruir la sesión
        session_destroy();

        // Responder con un mensaje de éxito
        echo json_encode(["status" => "success", "message" => "Sesión cerrada exitosamente"]);
    }
}
