
function mostarMensaje(mensaje,status) {
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
                mostarMensaje("Se eliminó el perro exitosamente","primary");
            } else {
                mostarMensaje("Hubo un error al eliminar al perro","danger");
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
            mostarMensaje("Se actualizó el perro exitosamente","primary");
        } else {
            mostarMensaje("Hubo un error al actualizar al perro","danger");
        }
    });

}

function readTextFile(file, callback) {
    let rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

//usage:
readTextFile("preguntas.json", function(text){
    let data = JSON.parse(text);
    console.log(data);
    let i = 0;
    for(i=0;i<data.length;i++){
        document.getElementById('lista-preguntas').innerHTML+= 
            '<li class="uk-open"><a class="uk-accordion-title" href="#">'+
            data[i].pregunta +"</a>"+
            '<div class="uk-accordion-content"><p>'+data[i].respuesta + '</p></div>'+
            "</li>"; 
    }
});

function editarPreguntas() {
    $.post("vista_editar_preguntas.php", {
      
    }).done(function (data,status,header) {
        if(header.status===200 && status == 'success'){
            $("#modal-editar-preguntas").html(data);
            UIkit.modal($("#modal-editar-preguntas")).show();
            readTextFile("preguntas.json", function(text){
            let data = JSON.parse(text);
            console.log(data);
            let i = 0;
            for(i=0;i<data.length;i++){
                document.getElementById('seccion-preguntas').innerHTML+= 
                    '<div class="uk-margin">'+
                    '<label class="uk-form-label" for="nombre">' + data[i].pregunta+'</label>'+
                        '<div class="uk-form-controls">'+
                            '<input class="uk-input uk-border-rounded" id="nombre" type="text" placeholder='
                            +data[i].respuesta
                     +" value="+data[i].respuesta+
                    "></div></div>";
            }
            });
        }
    });
}

document.getElementById("editar-preguntas").onclick=editarPreguntas;



