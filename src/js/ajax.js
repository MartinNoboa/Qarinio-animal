
function mostrarMensaje(mensaje,status) {
    UIkit.notification({message: mensaje,status: status})
}

//Función que detonará la petición asíncrona como se hace ahora con la librería jquery
function filtrar() {
    $.post("controlador_catalogo.php", {
        busq: $("#buscarNom").val(),
        minAge: $("#minAge").val(),
        maxAge: $("#maxAge").val(),
        sort: $("#sort").val(),
        order: $('input[name="order"]:checked').val(),
        macho: $("#macho").is(":checked"),
        hembra: $("#hembra").is(":checked"),
        pequeno: $("#pequeno").is(":checked"),
        mediano: $("#mediano").is(":checked"),
        grande: $("#grande").is(":checked"),
        raza: $("#filtro-raza").val(),
        personalidad: $("#filtro-personalidad").val(),
        condicion: $("#filtro-condicion").val(),
        estado: $("#filtro-estado").val()
    }).done(function (data) {
        $("#contenido-catalogo").html(data);
        setElEditar();
        setElInfo();
    });
}

function muestraEditarPerro(id) {
    $.post("vista_editar_perro.php", {
        idPerro: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#modal-editar").html(data);
            UIkit.modal($("#modal-editar")).show();
            $("#eliminar")[0].onclick = eliminar;
            $("#btn-editar")[0].onclick = submitEdicion;
        }
    });
}

function setElEditar() {
    let botonesEditar = document.getElementsByClassName("boton-editar");
    for(btn of botonesEditar) {
        btn.addEventListener("click", function(b) {
            muestraEditarPerro(b.target.getAttribute("idPerro"));
        });
    }
}

function setElInfo() {
    let botonesInfo = document.getElementsByClassName("boton-info");
    for(btn of botonesInfo) {
        btn.addEventListener("click", function(b) {
            muestraInfoPerro(b.target.getAttribute("idPerro"));
        });
    }
}

function muestraInfoPerro(id) {
    $.post("vista_info_perro.php", {
        idPerro: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#modal-info").html(data);
            UIkit.modal($("#modal-info")).show();
        }
    });
}




//Función que detonará la petición asíncrona como se hace ahora con la librería jquery
function eliminar() {
    if(confirm("¿Estas seguro de eliminar el perro?")){
        //$.post manda la petición asíncrona por el método post. También existe $.ge
        $.post("controlador_elimina_perro.php", {
            idperro: $("#eliminar").attr("idperro")
        }).done(function (data) {
            if(parseInt(data)!==0) {
                UIkit.modal($("#modal-editar")).hide();
                filtrar();
                mostrarMensaje("Se eliminó el perro exitosamente","success");
            } else {
                mostrarMensaje("Hubo un error al eliminar al perro","danger");
            }
        });
    }

}


function submitEdicion() {
        //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controlador_editar_perro.php",{
            idPerro: $("#eliminar").attr("idPerro"),
            nombre: $("#nombre").val(),
            tamanio: $("#tamanio").val(),
            anios: $("#anios").val(),
            meses: $("#meses").val(),
            sexo: $('input[name="sexo"]:checked').val(),
            historia: $("#historia").val(),
            raza: $("#raza").val(),
            condiciones_medicas: $("#condiciones-medicas").val(),
            personalidad: $("#personalidad").val(),
            estado: $("#estado").val()
    }).done(function (data) {
        if(parseInt(data)>0) {
            UIkit.modal($("#modal-editar")).hide();
            filtrar();
            mostrarMensaje("Se actualizó el perro exitosamente","success");
        } else {
            mostrarMensaje("Hubo un error al actualizar al perro","danger");
        }
    });

}


function readTextFile(file, callback) {
    let rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("POST", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);

}

function mostrarPreguntas(){
    readTextFile("preguntas.json", function(text){
        let data = JSON.parse(text);
        let i = 0;
        let concatenacion="";
        for(i=0;i<data.length;i++){
            if(data[i].pregunta != "" && data[i].respuesta != ""){
               concatenacion+=
                '<li class="uk-closed"><a class="uk-accordion-title" href="#">'+
                data[i].pregunta +"</a>"+
                '<div class="uk-accordion-content"><p>'+data[i].respuesta + '</p></div>'+
                "</li>";
               }

        }
        document.getElementById('lista-preguntas').innerHTML=concatenacion;
    });

}



function editarPreguntas() {
    $.post("vista_editar_preguntas.php", {
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#modal-editar-preguntas").html(data);
            UIkit.modal($("#modal-editar-preguntas")).show();
            readTextFile("preguntas.json", function(text){
            let data = JSON.parse(text);
            let i = 0;
            let idCorregido;
            for(i=0;i<data.length;i++){
                idCorregido = i+1;
                document.getElementById('seccion-preguntas').innerHTML+=
                    '<div class="uk-margin">'+
                    '<label class="uk-form-label" for="nombre">Pregunta ' +idCorregido +'</label>'+
                        '<div class="uk-form-controls">'+
                            '<input class="uk-input uk-border-rounded pregunta" idpregunta='+i +'  type="text" placeholder='+ "'"
                            +data[i].pregunta + "'"
                     +' value='+"'" +data[i].pregunta+ "'"+
                    "></div></div>";
                 document.getElementById('seccion-preguntas').innerHTML+=
                    '<div class="uk-margin">'+
                    '<label class="uk-form-label" for="nombre">Respuesta ' +idCorregido +'</label>'+
                        '<div class="uk-form-controls">'+
                            '<textarea class="uk-textarea uk-border-rounded respuesta" idrespuesta='+i +' type="text" placeholder='+ "'"
                            +data[i].respuesta + "'"
                     +' value='+"'" +data[i].respuesta+ "'"+
                    ">"+data[i].respuesta  + "</textarea></div></div>";
                document.getElementById('seccion-preguntas').innerHTML+='<br>';
            }
            });
            $("#btn-editar-preguntas")[0].onclick = submitEditarPreguntas;

        }//terminacion del if
    });
}

function mostrarContacto(){
    readTextFile("contacto.json", function(text){
        let data = JSON.parse(text);
        let concatenacionMuestra="";
        let concatenacionEdita = "";
        concatenacionMuestra+="<p><span uk-icon='receiver'></span>"+
                data[0].nombre + ": "+ data[0].telefono+ "</p><p><span uk-icon='mail'></span><a href='mailto:"+ data[0].correo + "' target='_blank'> "+
            data[0].correo+
            "</a></p><p><span uk-icon='location'></span><a href='https://www.google.com.mx/maps/place/ "+data[0].direccion + "' target='_blank'>"
            +data[0].direccion + '</a></p>';
        document.getElementById('info-contacto').innerHTML=concatenacionMuestra;
    });
}

function mostrarEdicionContacto(){
    readTextFile("contacto.json", function (text) {
        let data = JSON.parse(text);
        let concatenacionEdita = "";
        concatenacionEdita+=
            '<div class="uk-margin">'+
            '<label class="uk-form-label" for="nombre">Nombre </label>'+
            '<div class="uk-form-controls">'+
            '<input class="uk-input uk-border-rounded nombre" '+'  type="text" placeholder='+ "'"
            +data[0].nombre + "'"
            +' value='+"'" +data[0].nombre+ "'"+
            "></div></div>";
        concatenacionEdita+=
            '<div class="uk-margin">'+
            '<label class="uk-form-label" for="nombre">Teléfono </label>'+
            '<div class="uk-form-controls">'+
            '<input class="uk-input uk-border-rounded telefono" '+'  type="text" placeholder='+ "'"
            +data[0].telefono + "'"
            +' value='+"'" +data[0].telefono+ "'"+
            "></div></div>";
        concatenacionEdita+=
            '<div class="uk-margin">'+
            '<label class="uk-form-label" for="nombre">Correo </label>'+
            '<div class="uk-form-controls">'+
            '<input class="uk-input uk-border-rounded correo" '+'  type="text" placeholder='+ "'"
            +data[0].correo + "'"
            +' value='+"'" +data[0].correo+ "'"+
            "></div></div>";
        concatenacionEdita+=
            '<div class="uk-margin">'+
            '<label class="uk-form-label" for="nombre">Dirección</label>'+
            '<div class="uk-form-controls">'+
            '<input class="uk-input uk-border-rounded direccion" '+'  type="text" placeholder='+ "'"
            +data[0].direccion + "'"
            +' value='+"'" +data[0].direccion+ "'"+
            "></div></div>";
        document.getElementById("seccion-contacto").innerHTML = concatenacionEdita;
    })
}

function editarContacto() {
    $.post("panelControl.php", {
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#seccion-contacto").html(data);
            readTextFile("contacto.json", function(text){
                let data = JSON.parse(text);
                document.getElementById('seccion-contacto').innerHTML+=
                        '<div class="uk-margin">'+
                        '<label class="uk-form-label" for="nombre">Nombre </label>'+
                            '<div class="uk-form-controls">'+
                                '<input class="uk-input uk-border-rounded nombre" '+'  type="text" placeholder='+ "'"
                                +data[0].nombre + "'"
                         +' value='+"'" +data[0].nombre+ "'"+
                        "></div></div>";
                 document.getElementById('seccion-contacto').innerHTML+=
                        '<div class="uk-margin">'+
                        '<label class="uk-form-label" for="nombre">Teléfono </label>'+
                            '<div class="uk-form-controls">'+
                                '<input class="uk-input uk-border-rounded telefono" '+'  type="text" placeholder='+ "'"
                                +data[0].telefono + "'"
                         +' value='+"'" +data[0].telefono+ "'"+
                        "></div></div>";
                document.getElementById('seccion-contacto').innerHTML+=
                        '<div class="uk-margin">'+
                        '<label class="uk-form-label" for="nombre">Correo </label>'+
                            '<div class="uk-form-controls">'+
                                '<input class="uk-input uk-border-rounded correo" '+'  type="text" placeholder='+ "'"
                                +data[0].correo + "'"
                         +' value='+"'" +data[0].correo+ "'"+
                        "></div></div>";
                document.getElementById('seccion-contacto').innerHTML+=
                        '<div class="uk-margin">'+
                        '<label class="uk-form-label" for="nombre">Dirección</label>'+
                            '<div class="uk-form-controls">'+
                                '<input class="uk-input uk-border-rounded direccion" '+'  type="text" placeholder='+ "'"
                                +data[0].direccion + "'"
                         +' value='+"'" +data[0].direccion+ "'"+
                        "></div></div>";
            });
            $("#editar-contacto")[0].onclick = submitEditarContacto;

        }//terminacion del if
    });
}

function submitEditarContacto(){
    if(confirm("¿Estas seguro de guardar la información de contacto?")){
        let nombre=$('.nombre').val();
        let correo=$('.correo').val();
        let direccion=$('.direccion').val();
        let telefono=$('.telefono').val();
       $.post("controlador_editar_contacto.php", {
           nombre,
           correo,
           direccion,
           telefono
        }).done(function (data) {
            if(parseInt(data)!== 0) {
                mostrarMensaje("Se actualizó la información de contacto exitosamente","success");
                mostrarContacto();
                mostrarEdicionContacto();
            } else {
                mostrarMensaje("Hubo un error al actualizar la información de contacto ","danger");
            }
        });


    }//terminacion del if confirm

}

function submitEditarPreguntas(){
    if(confirm("¿Estas seguro de guardar las preguntas frecuentes?")){
        let datos = {};
        let respuesta=$('.respuesta');
        let pregunta=$('.pregunta');
        let datosp = {};
        for(pr of respuesta){
            datos[pr.getAttribute('idrespuesta')] = pr.value;
        }
        for(pr of pregunta){
            datosp[pr.getAttribute('idpregunta')] = pr.value;
        }
        datos['length'] = respuesta.length;
        datosp['length'] = pregunta.length;

       $.post("controlador_editar_preguntas.php", {
           datos,
           datosp
        }).done(function (data) {
            if(parseInt(data)!== 0) {
                mostrarMensaje("Se actualizaron las preguntas exitosamente","success");
                mostrarPreguntas();
                UIkit.modal($("#modal-editar-preguntas")).hide();
            } else {
                mostrarMensaje("Hubo un error al actualizar las preguntas ","danger");
            }
        });


    }//terminacion del if confirm

}


function mostrarCambiarC() {
    $.post("vista_cambiarContra.php").done(function(data){
        $("#modal-cambiar-c").html(data);
        UIkit.modal($("#modal-cambiar-c")).show();
        document.getElementById("cambiarContra").onclick = sendMailContra;
    });
}

function sendMailContra(){
    document.getElementById("cambiarContra").disabled=true;
    document.getElementById("cambiarContra").innerHTML="<div uk-spinner class='uk-position-fixed uk-transform-center'></div>";
    $.post("controlador_mail_cambioContra.php", {
        mail: $("#email-contra").val()
    }).done(function(data){
        switch(parseInt(data)){
            case 200:
                mostrarMensaje("Recibirá un correo con instrucciones para cambiar su contraseña", "primary");
                UIkit.modal($("#modal-cambiar-c")).hide();
                break;
            case 404:
                mostrarMensaje("Error: La cuenta no existe", "danger");
                mostrarCambiarC();
                break;
            default:
                break;
        }
        document.getElementById("cambiarContra").disabled=false;
        document.getElementById("cambiarContra").innerHTML="Cambiar mi contraseña";
    });
}

function sendMailContraNoModal(){
    document.getElementById("cambiarContra").disabled=true;
    document.getElementById("cambiarContra").innerHTML="<div uk-spinner class='uk-position-fixed uk-transform-center'></div>";
    $.post("controlador_mail_cambioContra.php", {
        mail: $("#email-contra").val()
    }).done(function(data){
        switch(parseInt(data)){
            case 200:
                mostrarMensaje("Recibirá un correo con instrucciones para cambiar su contraseña", "primary");
                break;
            case 404:
                mostrarMensaje("Error: La cuenta no existe", "danger");
                break;
            default:
                break;
        }
        document.getElementById("cambiarContra").disabled=false;
        document.getElementById("cambiarContra").innerHTML="Cambiar mi contraseña";
    });
}

function nuevaSolicitud(){
    $.post("controlador_nueva_solicitud.php",
          {
        //recupera idUsuario y idPerro de la sesion
        idUsuario : $('#idusuario').val(),
        idPerro : $('#idperro').val(),

        //si o no
        res1 : $('input[name="1"]:checked').val(),
        res2 : $('input[name="2"]:checked').val(),
        //textarea
        res3 : $('#3').val(),
        res4 : $('#4').val(),
        //numeric
        res5 : $('#5').val(),
        //si o no
        res6 : $('input[name="6"]:checked').val(),
        //casa o dep
        res7 : $('input[name="7"]:checked').val(),
        //jardin o patio
        res8 : $('input[name="8"]:checked').val(),
        //si o no
        res9 : $('input[name="9"]:checked').val(),
        //textarea
        res10 : $('#10').val(),
        res11 : $('#11').val(),
        //si o no
        res12 : $('input[name="12"]:checked').val()
    }).done(function(data){
        if (data != 0){
          mostrarMensaje("Se completó el formulario correctamente", "success");
            //redireccionar a mis solicitudes
            setTimeout(function() {
          window.location.href = "misSolicitudes";
        }, 2000);
        }else {
            //mensaje de error
          mostrarMensaje("Error al enviar el formulario, intente nuevamente.", "danger");
        }
    });
}

function cambiarContra() {
    $.post("controlador_cambiarContra.php", {
        uid: document.getElementById("uid").value,
        contrasenia: document.getElementById("contrasenia").value,
        verifContrasenia: document.getElementById("verifContrasenia").value
    }).done(function(data, status, header){
        switch(header.status){
            case 200:
                mostrarMensaje(data, "primary");
                setTimeout(()=>location.replace("iniciarSesion"), 2500);
                break;
            default:
                mostrarMensaje(data, "danger");
                break;
        }
    });
}

function muestraSolicitudes() {
    $.get("vista_gestionar_solicitudes.php").done(function(data){
        $("#tablaSolicitudes").html(data);
        setELSolicitudes();
        setELSolicitudesPago();
        setELSolicitudesEntrevista();

    })

}

function muestraMisSolicitudes() {
    $.post("vista_misSolicitudes.php",{
        idUsuario: $("#idUsuario").val()
    }).done(function(data){
        $("#tablaMisSolicitudes").html(data);
        setELSolicitudes_UR();
        setELSolicitudesPago_UR();
        setELSolicitudesEntrevista_UR();

    })

}
function muestraAlertOperador(idUsuario) {
    msj = confirm("¿Estás seguro que quieres eliminar este operador?\nEsta acción no se puede deshacer.");
    if(msj) {
        $.post("controlador_elimina_operador.php", {
            id: idUsuario
        }).done(function(data){
            if(parseInt(data) != 0) {
                // TODO: ESTO NO ES AJAX, YA LO SÉ BERNIE. HAY QUE PASAR LA FUNCION MOSTRAR PREGUNTAS DE UTIL A OTRA FUNCION JS
                location.replace("gestionarOperadores");
                mostrarMensaje("El operador fue eliminado exitosamente", "success");
            }
            else {
                mostrarMensaje("Hubo un error al eliminar al operador.\nPor favor, intenta de nuevo.", "danger");
            }

        });
    }
}
// TODO: CAMBIAR NOMBRE DE FUNCION, MAS ESPECIFICO
function muestraAlert(idSolicitud) {
    msj = confirm("¿Estás seguro que quieres eliminar tu solicitud?\nEsta acción no se puede deshacer.");
    if(msj) {
        $.post("controlador_elimina_solicitud.php", {
            idSol: idSolicitud
        }).done(function(data){
            if(parseInt(data) != 0) {
                // TODO: ESTO NO ES AJAX, YA LO SÉ BERNIE. HAY QUE PASAR LA FUNCION MOSTRAR PREGUNTAS DE UTIL A OTRA FUNCION JS
                location.replace("misSolicitudes");
                mostrarMensaje("La solicitud fue eliminada exitosamente", "success");
            }
            else {
                mostrarMensaje("Hubo un error al eliminar la solicitud.\nPor favor, intenta de nuevo.", "danger");
            }

        });
    }
}

function editarPerfil() {
    msj = confirm("¿Estás seguro que quieres aplicar tus cambios?\nEsta acción no se puede deshacer.");
    if(msj) {
        $.post("controlador_edita_perfil.php", {
            idUsuario: $("#idUsuario").val(),
            nombre: $("#nombre").val(),
            apellido: $("#apellido").val(),
            fechaNacimiento: $("#fechaNacimiento").val(),
            telefono: $("#telefono").val(),
            principal: $("#principal").val(),
            secundaria: $("#secundaria").val(),
            numExt: $("#numExt").val(),
            numInt: $("#numInt").val(),
            cp: $("#cp").val(),
            colonia: $("#colonia").val(),
            ciudad: $("#ciudad").val(),
            estado: $("#estado").val()
        }).done(function(data) {
            if(parseInt(data) != 0) {
                mostrarMensaje("Tu perfil se actualizó correctamente","success");
            }
            else{
                mostrarMensaje("Hubo un problema actualizando tu perfil.\nPor favor, intenta de nuevo.","danger");
            }
        });
    }
}


//!!!!!!!!!!!!!!--------------------------------MANEJO SOLICITUDES ADMIN-------------------------------!!!!!!!!!

//--------------------------------funciones para actualizar estado del formulario admin


function setELSolicitudes() {
    let botonesSolicitud = document.getElementsByClassName("formulario");

    for(btn of botonesSolicitud) {
        let id = btn.getAttribute("idSolicitud");
        btn.addEventListener("click", function(b) {
            muestraSolicitud(id);
        });
    }
}

function muestraSolicitud(id) {
    $.post("vista_solicitud.php", {
        idSolicitud: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#formulario").html(data);
            $("#aprobar")[0].onclick = aprobarFormulario;
            $("#rechazar")[0].onclick = rechazarFormulario;
            UIkit.modal($("#formulario")).show();
        }
    });
}

function aprobarFormulario() {
    msj = confirm("¿Estás seguro que quieres aprobar este formulario?");
    if(msj) {
        $.post("controlador_aprobar_formulario.php", {
            idSolicitud: $("#idSolicitudActiva").val(),
            aprobar : true
        }).done(function(data){
            if(parseInt(data) > 1 ) {
                mostrarMensaje("El formulario se aprobó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al aprobar el formulario.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#formulario")).hide();


        });
    }
}

function rechazarFormulario() {
    msj = confirm("¿Estás seguro que quieres rechazar este formulario?");
    if(msj) {
        $.post("controlador_aprobar_formulario.php", {
            idSolicitud: $("#idSolicitudActiva").val(),
            aprobar : false
        }).done(function(data){
            if(parseInt(data) != 0) {
                mostrarMensaje("El formulario se rechazó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al rechazar el formulario.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#formulario")).hide();

        });
    }
}


//--------------------------------funciones para actualizar estado de la entrevista admin


function setELSolicitudesEntrevista() {
    let botonesSolicitudEntrevista = document.getElementsByClassName("entrevista");
    for(btn of botonesSolicitudEntrevista) {
        let id = btn.getAttribute("idSolicitud");
        btn.addEventListener("click", function(b) {

            muestraSolicitudEntrevista(id);

        });
    }
}

function muestraSolicitudEntrevista(id) {
    $.post("vista_aprobar_entrevista.php", {
        idSolicitud: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#entrevista").html(data);
            $("#entrevistaSi").onclick = aprobarEntrevista;
            $("#entrevistaNo").onclick = rechazarEntrevista;
            UIkit.modal($("#entrevista")).show();

        }
    });
}

function aprobarEntrevista() {
    msj = confirm("¿Estás seguro que deseas rechazar la entrevista?");
    if(msj) {
        $.post("controlador_aprobar_entrevista.php", {
            idSolicitud: $("#idSolicitudActivaEntrevista").val(),
            aprobarEntrevista : true
        }).done(function(data){
            if(parseInt(data) != 0) {
                mostrarMensaje("La entrevista se aprobó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al aprobar la entrevista.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#entrevista")).hide();


        });
    }
}

function rechazarEntrevista() {
    msj = confirm("¿Estás seguro deseas rechazar la entrevista?");
    if(msj) {
        $.post("controlador_aprobar_entrevista.php", {
            idSolicitud: $("#idSolicitudActivaEntrevista").val(),
            aprobarEntrevista : false
        }).done(function(data){
            if(parseInt(data) != 0) {
                mostrarMensaje("La entrevista se rechazó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al rechazar la entrevista.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#entrevista")).hide();

        });
    }
}



//--------------------------------funciones para actualizar estado de pago admin

function setELSolicitudesPago() {
    let botonesSolicitudPago = document.getElementsByClassName("pago");
    for(btn of botonesSolicitudPago) {
        let id = btn.getAttribute("idSolicitud");
        btn.addEventListener("click", function(b) {
            muestraSolicitudPago(id);

        });
    }
}

function muestraSolicitudPago(id) {
    $.post("vista_aprobar_pago.php", {
        idSolicitud: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#pago").html(data);
            $("#aprobarPago")[0].onclick = aprobarPago;
            $("#rechazarPago")[0].onclick = rechazarPago;
            UIkit.modal($("#pago")).show();
        }
    });
}

function aprobarPago() {
    msj = confirm("¿Estás seguro que deseas aprobar el pago?");
    if(msj) {
        $.post("controlador_aprobar_pago.php", {
            idSolicitud: $("#idSolicitudActivaPago").val(),
            aprobarPago : true
        }).done(function(data){
            if(parseInt(data) != 0) {
                mostrarMensaje("El pago se aprobó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al aprobar el pago.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#pago")).hide();


        });
    }
}

function rechazarPago() {
    msj = confirm("¿Estás seguro deseas rechazar el pago?");
    if(msj) {
        $.post("controlador_aprobar_pago.php", {
            idSolicitud: $("#idSolicitudActivaPago").val(),
            aprobarPago : false
        }).done(function(data){
            if(parseInt(data) != 0) {
                mostrarMensaje("El pago se rechazó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al rechazar el pago.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#pago")).hide();

        });
    }
}



//!!!!!!!!!!!!!!--------------------------------MANEJO SOLICITUDES USUARIO REGISTRADO-------------------------------!!!!!!!!!


//--------------------------------funciones para mostrar modal con formulario


function setELSolicitudes_UR() {
    let botonesSolicitudUR = document.getElementsByClassName("urformulario");
    for(btn of botonesSolicitudUR) {
        let id = btn.getAttribute("idSolicitud");
        btn.addEventListener("click", function(b) {
            muestraSolicitudUR(id);
        });
    }
}

function muestraSolicitudUR(id) {
    $.post("vista_solicitud_ur.php", {
        idSolicitud: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#urformulario").html(data);
            UIkit.modal($("#urformulario")).show();
        }
    });
}




//--------------------------------funciones para mostrar modal estado de entrevista


function setELSolicitudesEntrevista_UR() {
    let botonesSolicitudEntrevistaUR = document.getElementsByClassName("urentrevista");
    for(btn of botonesSolicitudEntrevistaUR) {
        let id = btn.getAttribute("idSolicitud");
        btn.addEventListener("click", function(b) {
            muestraSolicitudEntrevistaUR(id);
        });
    }
}

function muestraSolicitudEntrevistaUR(id) {
    $.post("vista_entrevista_ur.php", {
        idSolicitud: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#urentrevista").html(data);
            UIkit.modal($("#urentrevista")).show();
        }
    });
}




//--------------------------------funciones para mostrar y actualizar estado de pago

function setELSolicitudesPago_UR() {
    let botonesSolicitudPagoUR = document.getElementsByClassName("urpago");
    for(btn of botonesSolicitudPagoUR) {
        let id = btn.getAttribute("idSolicitud");
        btn.addEventListener("click", function(b) {

            muestraSolicitudPagoUR(id);
        });
    }
}

function muestraSolicitudPagoUR(id) {
    $.post("vista_pago_ur.php", {
        idSolicitud: id
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#urpago").html(data);
            $("#actualizarMetodo")[0].onclick = actualizarMetodoPago;
            UIkit.modal($("#urpago")).show();
        }
    });
}

function actualizarMetodoPago() {
    msj = confirm("¿Estás seguro que deseas usar este método de pago?");
    if(msj) {
        $.post("controlador_actualizar_pago.php", {
            idSolicitud: $("#idSolicitudActivaMetodoPago").val(),
            metodo : $("#metodoPago").val()
        }).done(function(data){
            if(parseInt(data) != 0) {
                mostrarMensaje("El método de pago se actualizó correctamente.", "success");
            }
            else {
                mostrarMensaje("Hubo un error al actualizar el método pago.\nPor favor, intenta de nuevo.", "danger");
            }
            muestraSolicitudes();
            UIkit.modal($("#urpago")).hide();


        });
    }
}
