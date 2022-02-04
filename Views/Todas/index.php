<?php include "Views/Plantillas/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Tareas - Todas</li>
</ol>

<button class="btn btn-primary mb-2" type="button" onclick="frmTarea();">Nuevo</button>

<table class="table table-light" id="tblTodas">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Entrega</th>
            <th>Contenido</th>
            <th>Prioridad</th>
            <th></th>
        </tr>
    </thead>
    <tbody>  
    </tbody>
</table>

<div id="nueva_tarea" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_tarea">Nueva Tarea</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmTarea">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id_usuario']; ?>">
                        <input type="hidden" id="id_tarea" name="id_tarea">
                        <input id="titulo" class="form-control" type="text" name="titulo" placeholder="Titulo">
                    </div>
                    <?php 
                        $actual_f = date("Y-m-d"); 
                    ?>
                    <div class="row" id="fechas">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_actual">Fecha Trabajo</label>
                                <input id="fecha_actual" class="form-control" type="date" name="fecha_actual" min="<?php echo $actual_f?>" value="<?php echo $actual_f?>" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_vencimiento">Fecha Entrega</label>
                                <input id="fecha_vencimiento" class="form-control" type="date" name="fecha_vencimiento" min="<?php echo $actual_f?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contenido">Contenido</label>
                        <input id="contenido" class="form-control" type="textarea" name="contenido" placeholder="Contenido">
                    </div>
                    <div class="form-group">
                        <label for="contenido">Prioridad</label>
                        <select name="prioridad" id="prioridad" class="form-control">
                            <option value="importante">Importante</option>
                            <option value="regular">Regular</option>
                            <option value="irrelevante">Irrelevante</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="agregarTarea(event);" id="btnAccion">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Plantillas/footer.php"; ?>