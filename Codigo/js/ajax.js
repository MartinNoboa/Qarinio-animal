//Función que detonará la petición asíncrona como se hace ahora con la librería jquery
function filtrar() {
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controlador_buscar.php", {
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

//Asignar al botón buscar, la función buscar()
document.getElementById("filtrar").onclick = filtrar;