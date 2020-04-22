//Función que detonará la petición asíncrona como se hace ahora con la librería jquery
function filtrar() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controlador_catalogo.php", {
        minAge: $("#minAge").val(),
        maxAge: $("#maxAge").val(),
        sort: $("#sort").val(),
        order: $('input[name="order"]:checked').val(),
        macho: $("#macho").val(),
        hembra: $("#hembra").val(),
    }).done(function (data) {
        $("#contenido-catalogo").html(data);
    });
}

function editarPerro(id) {
    console.log(id);
}

//Asignar al botón buscar, la función buscar()
document.getElementById("filtrar").onclick = filtrar;
let botonesEditar = document.getElementsByClassName("boton-editar");

for(btn of botonesEditar) {
    btn.addEventListener("click", function(b) {
        editarPerro(b.srcElement.getAttribute("idPerro"));
    });
}
