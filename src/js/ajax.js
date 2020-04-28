
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

function editarPerro(id) {
    $.post("controlador_editar_perro.php", {
        idPerro: id
    }).done(function (data) {
        $("#modal-editar").html(data);
        UIkit.modal($("#modal-editar")).show();
        $("#eliminar")[0].onclick = eliminar;
    });
}

//Asignar al botón buscar, la función buscar()
document.getElementById("filtrar").onclick = filtrar;

function setElEditar() {
    let botonesEditar = document.getElementsByClassName("boton-editar");
    for(btn of botonesEditar) {
        btn.addEventListener("click", function(b) {
            editarPerro(b.srcElement.getAttribute("idPerro"));
        });
    }
}

setElEditar();



//Función que detonará la petición asíncrona como se hace ahora con la librería jquery
function eliminar() {
        //$.post manda la petición asíncrona por el método post. También existe $.get
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


 
