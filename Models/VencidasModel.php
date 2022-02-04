<?php

class VencidasModel extends Query{
    public function __construct() 
    {
        parent::__construct();
    }
    public function getTareasVencidas(int $id_usuario)
    {
        $dia = date("Y-m-d");
        $sql = "SELECT * FROM tareas WHERE id_usuario='$id_usuario' and fechaVen < '$dia'";
        $data = $this->selectAll($sql);
        return $data;   
    }
}

?>