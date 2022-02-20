let tblUsuarios;
let tblTodas;
let tblTodasPendientes;
let tblTodasVencidas;
let tblTodasArchivadas;

document.addEventListener("DOMContentLoaded", function(){
    tblUsuarios = $('#tblUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [ 
            {
                'data' : 'id'
            },
            {
                'data' : 'usuario'
            },
            {
                'data' : 'nombre'
            },
            {
                'data' : 'email'
            },
            {
                'data' : 'acciones'
            }
        ]
    } );
})

document.addEventListener("DOMContentLoaded", function(){
    tblTodas = $('#tblTodas').DataTable( {
        ajax: {
            url: base_url + "Todas/listar",
            dataSrc: ''
        },
        columns: [ 
            {
                'data' : 'id_usuario'
            },
            {
                'data' : 'titulo'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'fechaVen'
            },
            {
                'data' : 'texto'
            },
            {
                'data' : 'prioridad'
            },
            {
                'data' : 'acciones'
            }
        ]
    } );
})

document.addEventListener("DOMContentLoaded", function(){
    tblTodasPendientes = $('#tblTodasPendientes').DataTable( {
        ajax: {
            url: base_url + "Pendientes/listar",
            dataSrc: ''
        },
        columns: [ 
            {
                'data' : 'id_usuario'
            },
            {
                'data' : 'titulo'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'fechaVen'
            },
            {
                'data' : 'texto'
            },
            {
                'data' : 'prioridad'
            }
        ]
    } );
})

document.addEventListener("DOMContentLoaded", function(){
    tblTodasVencidas = $('#tblTodasVencidas').DataTable( {
        ajax: {
            url: base_url + "Vencidas/listar",
            dataSrc: ''
        },
        columns: [ 
            {
                'data' : 'id_usuario'
            },
            {
                'data' : 'titulo'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'fechaVen'
            },
            {
                'data' : 'texto'
            },
            {
                'data' : 'prioridad'
            }
        ]
    } );
})

document.addEventListener("DOMContentLoaded", function(){
    tblTodasArchivadas = $('#tblTodasArchivadas').DataTable( {
        ajax: {
            url: base_url + "Archivadas/listar",
            dataSrc: ''
        },
        columns: [ 
            {
                'data' : 'id_usuario'
            },
            {
                'data' : 'titulo'
            },
            {
                'data' : 'fecha'
            },
            {
                'data' : 'fechaVen'
            },
            {
                'data' : 'texto'
            },
            {
                'data' : 'prioridad'
            }
        ]
    } );
})




function frmLogin(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");

    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    }else if (clave.value == ""){
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    }else{
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok"){
                    window.location = base_url + "Usuarios";
                }else{
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }
    }
}

function frmRegister(){
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}

function frmRecuperar(){
    document.getElementById("frmRecuperar").reset();
    $("#recuperar").modal("show");
}

function registrarUser(e){
    e.preventDefault();
    const usuario = document.getElementById("usuario1");
    const nombre = document.getElementById("nombre1");
    const clave = document.getElementById("clave1");
    const confirmar = document.getElementById("confirmar");
    const respuesta = document.getElementById("respuesta");

    if (usuario.value == "" || nombre.value == "" || respuesta.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario registrado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal('hide');
                    tblUsuarios.ajax.reload();
                    location.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Usuario modificado con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#nuevo_usuario").modal('hide');
                    tblUsuarios.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
            }
        }
    }
}

function btnEditarUser(id){
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";

    const url = base_url + "Usuarios/editar/"+id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario1").value = res.usuario;
            document.getElementById("nombre1").value = res.nombre;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");

        }
    }
}

function btnEliminarUser(id){
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El usuario se eliminara!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/"+id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Eliminado!',
                            'Usuario eliminado con exito.',
                            'success'
                        )
                        tblUsuarios.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje!',
                             res,
                            'error'
                        )
                    }
                }
            }
            
        }
    })
}

function recuperarContraseña(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario_recuperar");
    if (usuario.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
        })
    }else{
        const url = base_url + "Usuarios/recuperar";
        const frm = document.getElementById("frmRecuperar");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Datos correctos',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();
                    $("#recuperar").modal('hide');
                    $("#actualizar_clave").modal("show");

                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();

                }
            }
        }

    }

}

function actulizarClave(e) {
    e.preventDefault();
    const clave_n = document.getElementById("clave_n");
    const clave_c = document.getElementById("clave_c");

    if (clave_n.value == "" || clave_c.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        const url = base_url + "Usuarios/actualizarClave";
        const frm = document.getElementById("frmActualizarClave");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Contraseña actualizada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();
                    $("#actualizar_clave").modal("hide");

                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();

                }
            }
        }
    }
    
}

// TAREAS

function frmTarea(){
    document.getElementById("title_tarea").innerHTML = "Nueva Tarea";
    document.getElementById("btnAccion").innerHTML = "Agregar";
    document.getElementById("id_tarea").value = "";
    const frm = document.getElementById("frmTarea");
    frm.reset();
    $("#nueva_tarea").modal("show");
}

function agregarTarea(e) {
    e.preventDefault();
    const titulo = document.getElementById("titulo");
    const fecha_actual = document.getElementById("fecha_actual");
    const fecha_ven = document.getElementById("fecha_vencimiento");
    const contenido = document.getElementById("contenido");
    const prioridad = document.getElementById("prioridad");

    if (titulo.value == "" || fecha_actual.value == "" || fecha_ven.value == "" || contenido.value == "" || prioridad.value == "" ) {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 1500
        })
    }else{
        const url = base_url + "Todas/agregar";
        const frm = document.getElementById("frmTarea");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Tarea registrada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();
                    $("#nueva_tarea").modal('hide');
                    tblTodas.ajax.reload();
                    location.reload();
                }else if (res == "modificado"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Tarea modificada con éxito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    frm.reset();
                    $("#nueva_tarea").modal('hide');
                    tblTodas.ajax.reload();
                }else{
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
            }
        }
    } 
}

function btnEditarTarea(id_tarea){
    document.getElementById("title_tarea").innerHTML = "Editar Tarea";
    document.getElementById("btnAccion").innerHTML = "Modificar";

    const url = base_url + "Todas/editar/"+id_tarea;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_tarea").value = res.id_tarea;
            document.getElementById("titulo").value = res.titulo;
            document.getElementById("fecha_actual").value = res.fecha;
            document.getElementById("fecha_vencimiento").value = res.fechaVen;
            document.getElementById("contenido").value = res.texto;
            document.getElementById("prioridad").value = res.prioridad;
            $("#nueva_tarea").modal("show");

        }
    }
}

function btnEliminarTarea(id_tarea){
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "La tarea se eliminara!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Todas/eliminar/"+id_tarea;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Eliminado!',
                            'Tarea eliminada con exito.',
                            'success'
                        )
                        tblTodas.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje!',
                             res,
                            'error'
                        )
                    }
                }
            }
            
        }
    })
}

function btnArchivarTarea(id_tarea){
    Swal.fire({
        title: 'Esta seguro de archivar?',
        text: "La tarea no se elimanara solo sera archivada!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Todas/archivar/"+id_tarea;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok"){
                        Swal.fire(
                            'Archivado!',
                            'Tarea archivada con exito.',
                            'success'
                        )
                        tblTodas.ajax.reload();
                    }else{
                        Swal.fire(
                            'Mensaje!',
                             res,
                            'error'
                        )
                    }
                }
            }
            
        }
    })
}
