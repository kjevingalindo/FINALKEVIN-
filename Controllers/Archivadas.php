<?php
class Archivadas extends Controller{
    public function __constructor(){
        session_start();
        parent::__constructor();
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $id = $_SESSION['id_usuario'];
        $data = $this->model->getTareasArchivadas($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
?>
