
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
function mostrarPreguntas(){
    readTextFile("preguntas.json", function(text){
        let data = JSON.parse(text);
        console.log("a");
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
            console.log(data);
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

document.getElementById("editar-preguntas").onclick=editarPreguntas;

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
        
        console.log(datos);
        console.log(datosp);
       $.post("controlador_editar_preguntas.php", {
           datos,
           datosp
        }).done(function (data) {
           console.log(data);
            if(parseInt(data)!== 0) {
                mostarMensaje("Se actualizaron las preguntas exitosamente","primary");
                UIkit.modal($("#modal-editar-preguntas")).hide();
                mostrarPreguntas();
                //filtrar();
                //location.reload(true);
            } else {
                mostarMensaje("Hubo un error al actualizar las preguntas ","danger");
            }
        });

 
    }//terminacion del if confirm
   
}

