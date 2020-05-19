
function mostrarMensaje(mensaje,status) {
    UIkit.notification({message: mensaje,status: status})
}

//Función que detonará la petición asíncrona como se hace ahora con la librería jquery
function filtrar() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controlador_catalogo.php", {
        minAge: $("#minAge").val(),
        maxAge: $("#maxAge").val(),
        sort: $("#sort").val(),
        order: $('input[name="order"]:checked').val(),
        macho: $("#macho").is(":checked"),
        hembra: $("#hembra").is(":checked"),
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
            muestraEditarPerro(b.srcElement.getAttribute("idPerro"));
        });
    }
}

function setElInfo() {
    let botonesInfo = document.getElementsByClassName("boton-info");
    for(btn of botonesInfo) {
        btn.addEventListener("click", function(b) {
            muestraInfoPerro(b.srcElement.getAttribute("idPerro"));
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
                mostrarMensaje("Se eliminó el perro exitosamente","primary");
            } else {
                mostrarMensaje("Hubo un error al eliminar al perro","danger");
            }
        });
    }

}


function submitEdicion() {
        //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controlador_editar_perro.php", {
        idPerro: $("#eliminar").attr("idPerro"),
        nombre: $("#nombre").val(),
        tamanio: $("#tamanio").val(),
        anios: $("#anios").val(),
        meses: $("#meses").val(),
        sexo: $('input[name="sexo"]:checked').val(),
        historia: $("#historia").val(),
        raza: $("#raza").val(),
        condiciones_medicas: $("#condiciones-medicas").val(),
        personalidad: $("#personalidad").val()
    }).done(function (data) {
        console.log(data);
        if(parseInt(data)!==0) {
            UIkit.modal($("#modal-editar")).hide();
            filtrar();
            mostrarMensaje("Se actualizó el perro exitosamente","primary");
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
    //console.log(" leyendo texto");

    rawFile.send(null);

}

//usage:
function mostrarPreguntas(){

    readTextFile("preguntas.json", function(text){
        let data = JSON.parse(text);
        //console.log(data);
        let i = 0;
        let concatenacion="";
        for(i=0;i<data.length;i++){
            concatenacion+=
                '<li class="uk-open"><a class="uk-accordion-title" href="#">'+
                data[i].pregunta +"</a>"+
                '<div class="uk-accordion-content"><p>'+data[i].respuesta + '</p></div>'+
                "</li>";
        }
        document.getElementById('lista-preguntas').innerHTML=concatenacion;
        console.log(concatenacion);
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
            //console.log(data);
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
        //console.log("a");
        let data = JSON.parse(text);
        let concatenacion="";

        concatenacion+="<p><span uk-icon='receiver'></span>"+
                data[0].nombre + ": "+ data[0].telefono+ "</p><p><span uk-icon='mail'></span><a href='mailto:"+ data[0].correo + "' target='_blank'> "+
            data[0].correo+
            "</a></p><p><span uk-icon='location'></span><a href='https://www.google.com.mx/maps/place/ "+data[0].direccion + "' target='_blank'>"
            +data[0].direccion + '</a></p>';
        document.getElementById('info-contacto').innerHTML=concatenacion;
    });
}

function editarContacto() {
    $.post("vista_editar_contacto.php", {
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#modal-editar-contacto").html(data);
            UIkit.modal($("#modal-editar-contacto")).show();
            readTextFile("contacto.json", function(text){
                let data = JSON.parse(text);
                //console.log(data);
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
                        '<label class="uk-form-label" for="nombre">Telefono </label>'+
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
                        '<label class="uk-form-label" for="nombre">Direccion</label>'+
                            '<div class="uk-form-controls">'+
                                '<input class="uk-input uk-border-rounded direccion" '+'  type="text" placeholder='+ "'"
                                +data[0].direccion + "'"
                         +' value='+"'" +data[0].direccion+ "'"+
                        "></div></div>";
            });
            $("#btn-editar-contacto")[0].onclick = submitEditarContacto;

        }//terminacion del if
    });
}
function submitEditarContacto(){
    //console.log($('.pregunta')[2]);
    if(confirm("¿Estas seguro de guardar la información de contacto?")){

        let nombre=$('.nombre').val();
        let correo=$('.correo').val();
        let direccion=$('.direccion').val();
        let telefono=$('.telefono').val();
        //console.log(correo);
       $.post("controlador_editar_contacto.php", {
           nombre,
           correo,
           direccion,
           telefono
        }).done(function (data) {
           //console.log(data);
            if(parseInt(data)!== 0) {
                mostrarMensaje("Se actualizó la información de contacto exitosamente","primary");
                mostrarContacto();
                UIkit.modal($("#modal-editar-contacto")).hide();



            } else {
                mostrarMensaje("Hubo un error al actualizar la información de contacto ","danger");
            }
        });


    }//terminacion del if confirm

}

function submitEditarPreguntas(){
    //console.log($('.pregunta')[2]);
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

        //console.log(datos);
        //console.log(datosp);
       $.post("controlador_editar_preguntas.php", {
           datos,
           datosp
        }).done(function (data) {
           console.log(data);
            if(parseInt(data)!== 0) {
                mostrarMensaje("Se actualizaron las preguntas exitosamente","primary");
                mostrarPreguntas();
                UIkit.modal($("#modal-editar-preguntas")).hide();


                //window.history.forward(1);
            } else {
                mostrarMensaje("Hubo un error al actualizar las preguntas ","danger");
            }
        });


    }//terminacion del if confirm

}



function agregarPerro() {
    $.post("controlador_agregar_perro.php", {
        nombre : $("#nombre").val(),
        size : $("#size").val(),
        meses : $("#meses").val(),
        fechaLlegada : $("#fecha").val(),
        historia : $("#historia").val(),
        genero: $('input[name="genero"]:checked').val(),
        raza: $("#raza").val(),
        estado: $("#estado").val(),
        condiciones: $("#condiciones").val(),
        personalidad: $("#personalidad").val()
    }).done(function(data){
        //console.log(data);
      if(parseInt(data) != 0){
          mostrarMensaje("Se agrego el perro exitosamente", "success");
          setTimeout(function() {
          window.location.href = "catalogo.php";
        }, 2000);
      }else{
          mostrarMensaje("Hubo un error al agregar el perro", "danger");
      }
    });
}



//funcion para agregar foto
function agregarFoto(){
    $(document).ready(function(){

    $("#agregar").click(function(){

        var fd = new FormData();
        var files = $('#foto')[0].files[0];
        fd.append('foto',files);

        $.ajax({
            url: 'controlador_agregar_foto.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    $("#img").attr("src",response);
                    $(".preview img").show(); // Display image element
                }else{
                    alert('file not uploaded');
                }
            },
        });
    });
});
}
