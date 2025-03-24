<?php
class Query extends Conexion
{
    private $pdo, $con, $sql, $datos;
    public function __construct()
    {
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }
    public function select(string $sql, array $datos = [])
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;
            $stmt = $this->con->prepare($this->sql);
            $stmt->execute($this->datos); // Pasar los parámetros aquí
            return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve una fila
        } catch (PDOException $e) {
            error_log("Error en select: " . $e->getMessage()); // Registrar el error
            return false; // Devuelve false en caso de error
        }
    }
    public function selectAll(string $sql, array $datos = [])
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;
            $stmt = $this->con->prepare($this->sql);
            $stmt->execute($this->datos); // Pasar los parámetros aquí
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todas las filas
        } catch (PDOException $e) {
            error_log("Error en selectAll: " . $e->getMessage()); // Registrar el error
            return false; // Devuelve false en caso de error
        }
    }

    public function save(string $sql, array $datos)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;
            $stmt = $this->con->prepare($this->sql);
            $success = $stmt->execute($this->datos); // Ejecutar la consulta
            return $success ? 1 : 0; // Devuelve 1 si fue exitoso, 0 si no
        } catch (PDOException $e) {
            error_log("Error en save: " . $e->getMessage()); // Registrar el error
            return 0; // Devuelve 0 en caso de error
        }
    }

    public function insertar(string $sql, array $datos)
    {
        try {
            $this->sql = $sql;
            $this->datos = $datos;
            $stmt = $this->con->prepare($this->sql);
            $success = $stmt->execute($this->datos); // Ejecutar la consulta
            return $success ? $this->con->lastInsertId() : 0; // Devuelve el ID o 0
        } catch (PDOException $e) {
            error_log("Error en insertar: " . $e->getMessage()); // Registrar el error
            return 0; // Devuelve 0 en caso de error
        }
    }

    public function editar(string $sql, array $datos)
    {
        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($datos);
            return $stmt->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $e) {
            error_log("Error en ejecutar: " . $e->getMessage());
            return 0; // Devuelve 0 si hay error
        }
    }

    
    public function eliminar(string $sql, array $datos)
    {
        try {
            $stmt = $this->con->prepare($sql);
            $stmt->execute($datos);
            return $stmt->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $e) {
            error_log("Error en eliminar: " . $e->getMessage());
            return 0; // Devuelve 0 si hay error
        }
    }
}
