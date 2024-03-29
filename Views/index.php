<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Iniciar Sesión</title>
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-dark">
        <div id="layutAuthentication">
            <div id="layutAuthentication_content">
                <main>
                    <div class="contaimer"> 
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class ="text-center font-weight-light my-4">Iniciar cession</h3></div>
                                    <div class="card-body">
                                        <form id="frmLogin" method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="usuario"><i class="fas fa-user"></i> Usuario</label>
                                                <input class="form-control py-4" id="usuario" name="usuario" type="text" placeholder="Ingrese usuario" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="correo"><i class="fas fa-envelope"></i> email</label>
                                                <input class="form-control py-4" id="correo" name="correo" type="correo" placeholder="example@gmail.com" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="clave"><i class="fas fa-key"></i> Contraseña</label>
                                                <input class="form-control py-4" id="clave" name="clave" type="password" placeholder="Ingrese contraseña" />
                                            </div>

                                            <button class="btn text-primary" type="button" onclick="frmRecuperar();"><a>¿Olvidaste tu contraseña?</a></button>

                                            <div class="alert alert-danger text-center d-none" role="alert" id="alerta">

                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
                        
                                                <button class="btn btn-primary m-2" type="submit" onclick="frmLogin(event);">Iniciar sesión</button>

                                                <button class="btn btn-danger m-2" type="button" onclick="frmRegister();">Registrar</button> 
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title">Nuevo Usuario</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="frmUsuario">
                                        <div class="form-group">
                                            <label for="usuario">Usuario</label>
                                            <input type="hidden" id="id" name="id">
                                            <input id="usuario1" class="form-control" type="text" name="usuario1" placeholder="Usuario">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input id="nombre1" class="form-control" type="text" name="nombre1" placeholder="Nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="correo">correo</label>
                                            <input id="correo1" class="form-control" type="email" name="correo1" placeholder="example@gmail.com">
                                        </div>
                                        <div class="row" id="claves">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="clave">Contraseña</label>
                                                    <input id="clave1" class="form-control" type="password" name="clave1" placeholder="Contraseña">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="confirmar">Confirmar Contraseña</label>
                                                    <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Confirmar Contraseña">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="my-select">Cuestión de seguridad</label>
                                            <select id="pregunta_secreta" class="form-control" name="pregunta_secreta">
                                                <option >¿Cuáles son los nombres de padre?</option>
                                                <option >¿Cuáles son los nombres de madre?</option>
                                                <option >¿Cuál es su spelicula favorita?</option>
                                                <option >¿Cuando es su cumpleaños?</option>
                                                <option >¿Cuál es su nombre de su mascota?</option>
                                                <option >¿Cuál es su empleo soñado?</option>
                                                <option >¿Deporte favorito?</option>
                                            </select>
                                        </div>
                                        <div class ="form-group">
                                            <label for="respuesta">Respuesta</label>
                                            <input id="respuesta" class="form-control" type="text" name="respuesta">
                                        </div>
                                        <button class="btn btn-primary" type="button" onclick="registrarUser(event);" id="btnAccion">Registrar</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="recuperar" class="modal fade" tabindex="-1" role="dialog" aira-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title" id="title">Recuperar Contraseña</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="frmRecuperar">
                                        <div class="form-group">
                                            <label for="usuario_recuperar">Usuario</label>
                                            <input type="hidden" id="id" name="id">
                                            <input id="usuario_recuperar" class="form-control" type="text" name="usuario_recuperar" placeholder="Usuario">
                                        </div>

                                        <div class="form-group">
                                            <label for="my-select">Pregunta secreta</label>
                                            <select id="pregunta_secreta" class="form-control" name="pregunta_secreta">
                                            <option >¿Cuáles son los nombres de padre?</option>
                                                <option >¿Cuáles son los nombres de madre?</option>
                                                <option >¿Cuál es su spelicula favorita?</option>
                                                <option >¿Cuando es su cumpleaños?</option>
                                                <option >¿Cuál es su nombre de su mascota?</option>
                                                <option >¿Cuál es su empleo soñado?</option>
                                                <option >¿Deporte favorito?</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="respuesta">Respuesta</label>
                                            <input id="respuesta" class="form-control" type="text" name="respuesta" placeholder="Ingrese su respuesta">
                                        </div>

                                        <button class="btn btn-primary" type="button" onclick="recuperarContraseña(event);" id="btnAction">Recuperar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="actualizar_clave" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="title">Recuperar Contraseña</h5>
                                    <button class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="frmActualizarClave">
                                        <div class="form-group">
                                            <label for="clave_n">Contraseña Nueva</label>
                                            <input type="hidden" id="usuario" name="usuario">
                                            <input id="clave_n" class="form-control" type="password" name="clave_n" placeholder="Contraseña">
                                        </div>
                                        <div class="form-group">
                                            <label for="clave_c">Confirmar Contraseña</label>
                                            <input id="clave_c" class="form-control" type="password" name="clave_c" placeholder="Confirmar Contraseña" >
                                        </div>

                                        <button class="btn btn-primary" type="button" onclick="actualizarClave(event);" id="btnAccion">Actualizar</button>
                                    </from>
                                </div>
                            </div>
                        </div> 
                    </div>
                    
                    


                    
                </main>
            </div>

        </div>
        <script src="<?php echo base_url; ?>Assets/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url; ?>Assets/demo/datatables-demo.js"></script>
        <script>
            const base_url = "<?php echo base_url; ?>";
        </script>
        <script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>

    </body>
</html>
