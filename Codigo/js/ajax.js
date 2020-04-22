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
    });
    console.log(id);
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
