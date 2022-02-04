<?php

class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $id;
    public function __construct() 
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {

        $clave = hash("SHA256", $clave);
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $usuario, string $nombre, string $clave)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios (usuario, nombre, clave) VALUES (?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave);

            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }

        

        return $res;
    }

    public function editarUser(int $id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $data = $this->select($sql);

        return $data;
    }
    public function modificarUsuario(string $usuario, string $nombre, int $id)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;

        $sql = "UPDATE usuarios SET usuario=?, nombre=? WHERE id = ? ";
        $datos = array($this->usuario, $this->nombre, $this->id);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }

        return $res;
    }

    public function eliminarUsuario(int $id)
    {
        $this->id = $id;
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);

        return $data;
    }

}

?>