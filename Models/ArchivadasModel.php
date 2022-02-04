<?php

class ArchivadasModel extends Query{
    public function __construct() 
    {
        parent::__construct();
    }
    public function getTareasArchivadas(int $id_usuario)
    {
        $sql = "SELECT * FROM archivados WHERE id_usuario='$id_usuario'";
        $data = $this->selectAll($sql);
        return $data;   
    }
}

?>