<?php

class Todas extends Controller{
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
        $id = $_SESSION['id_usuario'];
        $data = $this->model->getTareas($id);

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>

            <button class="btn btn-primary" type="button" onclick="btnEditarTarea('.$data[$i]['id_tarea'].');"  title="Editar"><i class="fas fa-edit"></i></button>

            <button class="btn btn-danger" type="button" onclick="btnEliminarTarea('.$data[$i]['id_tarea'].');" title="Eliminar"><i class="fas fa-trash"></i></button>

            <button class="btn btn-info" type="button" onclick="btnArchivarTarea('.$data[$i]['id_tarea'].')" title="Archivar"><i class="fas fa-file-upload"></i> </button>
            
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function agregar()
    {
        $id = $_POST['id'];
        $id_tarea = $_POST['id_tarea'];
        $titulo = $_POST['titulo'];
        $fecha_actual = $_POST['fecha_actual'];
        $fecha_ven = $_POST['fecha_vencimiento'];
        $contenido = $_POST['contenido'];
        $prioridad = $_POST['prioridad'];
   
        if (empty($titulo) || empty($fecha_actual) || empty($fecha_ven) || empty($contenido) || empty($prioridad)){
            $msg = "Todos los campos son obligatorios";
        } if ($id_tarea == ""){
            $data = $this->model->agregarTarea($id, $titulo, $fecha_actual, $fecha_ven, $contenido, $prioridad);

            if ($data == "ok") {
                $msg = "si";
            }else{
                $msg = "Error al registrar tarea";
            }    
        }else{
            $data = $this->model->modificarTarea($id_tarea, $titulo, $fecha_actual, $fecha_ven, $contenido, $prioridad);
            if ($data == "modificado") {
                $msg = "modificado";
            }else{
                $msg = "Error al modificar el usuario";
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function eliminar(int $id)
    {
        $data = $this->model->eliminarTarea($id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al eliminar la tarea";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar(int $id_tarea)
    {
        $data = $this->model->editarTarea($id_tarea);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function archivar(int $id)
    {
        $data = $this->model->archivartarea($id);
        if ($data == 1){
            $msg = "ok";
        }else{
            $msg = "Error al archivar la tarea";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}

?>