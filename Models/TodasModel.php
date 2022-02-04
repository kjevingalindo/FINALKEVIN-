<?php

class TodasModel extends Query{
    private $id, $titulo, $fecha_actual, $fecha_ven, $contenido, $prioridad;
    public function __contruc()
    {
        parent:: __contruc();
    }

    public function getTareas(int $id_usario)
    {
        $sql = "SELECT * FROM tareas WHERE id_usuario='$id_usuario'";
        $data = $this->sellectAll($sql)
        return $data;
    }

    public function editarTarea(int $id_tarea)
    {
        $sql = "SELECT * FROM tareas WHERE id_tarea = $id_tarea";
        $data = $this->select($sql);

        return $data;
    }

    public function modificarTarea(int $id,string $titulo, string $fecha_actual, string $fecha_ven, string $contenido, string $prioridad)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->fecha_actual = $fecha_actual;
        $this->fecha_ven = $fecha_ven;
        $this->contenido = $contenido;
        $this->prioridad = $prioridad;

        $sql = "UPDATE tareas SET titulo=?, fecha=?, fechaVen=?, texto=?, prioridad=? WHERE id_tarea=? ";
        $datos = array($this->titulo, $this->fecha_actual, $this->fecha_ven, $this->contenido, $this->prioridad,$this->id);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "modificado";
        }else{
            $res = "error";
        }

        return $res;
    }

    public function agregarTarea(int $id, string $titulo, string $fecha_actual, string $fecha_ven, string $contenido, string $prioridad)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->fecha_actual = $fecha_actual;
        $this->fecha_ven = $fecha_ven;
        $this->contenido = $contenido;
        $this->prioridad = $prioridad;

        $sql = "INSERT * FROM tareas (id_usuario, titulo, fecha, fechaVen, texto, prioridad) VALUES (?,?,?,?,?,?)";

        $datos = array($this-> $id, $this->$titulo, $this->$fecha_actual, $this->$fecha_ven, $this->$contenido, $this->$prioridad );

        $data = $this->save($sql, $datos);

        if ($data == 1){
            $res = "ok";
        }else{
            $res = "error";
        }

        return $res;
    }

    public function eliminarTarea(int $id)
    {
        $this->id= $id;
        $sql = "DELETE FROM tareas WHERE id_tarea = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);

        return $data;
    }

    public function archivartarea(int $id)
    {
        $sql_s = "SELECT * FROM tareas WHERE id_tarea='$id'";
        $data = $this->select($sql_s);

        $this->id_usuario = $data['id_usuario'];
        $this->id = $id;
        $this->titulo = $data['titulo'];
        $this->fecha_actual = $data['fecha'];
        $this->fecha_ven = $data['fechaVen'];
        $this->contenido = $data['texto'];
        $this->prioridad = $data['prioridad'];

        $sql_a = "INSERT INTO archivados (id_usuario, id_tarea, titulo, fecha, fechaven, texto, prioridad)VALUES (?,?,?,?,?,?,?)";
        $datos_a = array($this->id_usuario, $this->$id, $this->titulo, $this->fecha_actual, $this->fecha_ven, $this->contenido, $this->prioridad);

        $sql = "DELETE FROM tareas WHERE id_tarea = ?";
        $datos = array($this->id);
        $data_t = $this->save($sql, $datos);

        return $data_t;
    }

}
?>