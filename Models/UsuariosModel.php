<?php

class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $id, $respuesta;
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
    public function registrarUsuario(string $usuario, string $nombre, string $clave, string $correo, string $respuesta)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->correo = $correo;
        $this->respuesta = $respuesta;
        
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios (usuario, nombre, clave, email, respuesta) VALUES (?,?,?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave, $this->correo, $this->respuesta);

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

    public function recuperarUsuario(string $usuario, string $respuesta)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' and respuesta = '$respuesta'";
        $data = $this->select($sql);
        return $data;
    }

    public function actualizarClaveUser(string $usuario, string $clave) 
    {
        $this->usuario = $usuario;
        $this->clave = $clave;

        $sql = "UPDATE usuarios SET clave=? WHERE usuario = ? ";
        $datos = array($this->clave, $this->usuario);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }

        return $res;
    }

}

?>