<?php

    $name = $_FILES("foto")("name");
    //luego cambiar esto por funcion de renombrar foto
    $url = "img/perros/".$name;

    //mueve la foto de donde esta guardada temporalmente 
    $temp_loc = $_FILES("foto")("tmp_name");
    if (move_uploaded_file($temp_loc,$url)){
        //0 sin errores, 1 con errores.
        echo 0;
    }else{
        echo 1;
    }
    

}