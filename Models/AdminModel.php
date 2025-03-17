<?php
class AdminModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }


    public function login($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario_usuario = ? AND rol_usuario = 1";
        $data = array($usuario);
        return $this->select($sql, $data);
    }

    public function buscarUsuario($usuario)
    {
        $sql = "SELECT id FROM usuarios WHERE usuario_usuario = ?";
        return $this->select($sql, [$usuario]);
    }

    public function registrarUsuario($data)
    {
        $sql = "INSERT INTO usuarios (nombre_usuario, apellido_usuario, usuario_usuario, password_usuario) VALUES (?, ?, ?, ?)";
        $datosEnviar = array($data['nombre'], $data['apellido'], $data['usuario'], $data['contra']);
        return $this->insertar($sql, $datosEnviar);
    }


    
}
