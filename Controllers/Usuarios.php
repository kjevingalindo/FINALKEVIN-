<?php

class Usuarios extends Controller{
    public function __construct(){
        session_start();
        parent::__construct();
    } 
    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data = $this->model->getUsuarios();
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['id'].');">Editar</button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['id'].');">Eliminar</button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {
        if(empty($_POST['usuario'] ) || empty($_POST['clave'])){
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario, $clave);
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $msg = "ok";
            }else{
                $msg = "Usuario o contraseña incorrecta";
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $usuario = $_POST['usuario1'];
        $nombre = $_POST['nombre1'];
        $clave = $_POST['clave1'];
        $confirmar = $_POST['confirmar'];
        $respuesta = $_POST['respuesta']
        $id = $_POST['id'];
        $correo = $_POST['correo1'];

        $hash = hash("SHA256", $clave);

        if (empty($usuario) || empty($nombre)){
            $msg = "Todos los campos son obligatorios";
        }else{
            if ($id== "") {
                if ($clave != $confirmar) {
                    $msg = "Las contraseñas no coinciden";
                }else{
                    $data = $this->model->registrarUsuario($usuario, $nombre, $hash, $correo, $respuesta);
                    if ($data == "ok") {
                        $msg = "si";
                    }else if($data == "existe"){
                        $msg = "El usuario ya existe";
                    }else{
                        $msg = "Error al registrar el usuario";
                    }
                }
                
            }else{
                $data = $this->model->modificarUsuario($usuario, $nombre, $id);
                if ($data == "modificado") {
                    $msg = "modificado";
                }else{
                    $msg = "Error al modificar el usuario";
                }
            }
            
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
        $data = $this->model->eliminarUsuario($id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al eliminar usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function recuperar()
    {
        $usuario = $_POST['usuario_recuperar'];
        $respuesta = $_POST['respuesta'];

        $data = $this->model->recuperarUsuario($usuario, $respuesta);
        if ($data) {
            $_SESSION['usuarioR'] = $usuario;
            $msg = "ok";
        }else{
            $msg = "Respuesta o usuario incorrecto"
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actualizarClave()
    {
        $usuario = $_SESSION['usuarioR'];
        $clave = $_POST['clave_n'];

        $hash = hash("SHA256", $clave);

        $msg = $usuario; 
        $data = $this->model->actualizarClaveUser($usuario, $hash);

        if ($data == "modificado"){
            $msg = "modificado";
        }else{
            $msg = "Error al modificar contraseña"
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}

?>