function verifLogin(){
    let form = document.querySelector('#sign-up');
    let email=form.elements.namedItem("email");
    let telefono=form.elements.namedItem("telefono");
    let contrasenia=form.elements.namedItem("contrasenia");
    let verifContrasenia=form.elements.namedItem("verifContrasenia");

    email.addEventListener('input',validar);
    telefono.addEventListener('input',validar);
    contrasenia.addEventListener('input',validar);
    verifContrasenia.addEventListener('input',validar);
}

function verifCambContr(){
    let form = document.querySelector('#change-pass');
    let contrasenia=form.elements.namedItem("contrasenia");
    let verifContrasenia=form.elements.namedItem("verifContrasenia");
    contrasenia.addEventListener('input',validarContras);
    verifContrasenia.addEventListener('input',validarContras);
}

function validar(e){
    let target =e.target;
    //console.log(target.value.length);
    if(target.name == 'email'){
        if(validarEmail(target.value)){
            //target.classList.add('uk-text-success');
            target.classList.remove('uk-text-danger');
        }else{
            target.classList.add('uk-text-danger');
            target.classList.remove('uk-text-success');
        }
    }
    
    if(target.name == 'telefono'){
        if(target.value.length  == 10 && !isNaN(target.value)){
            //target.classList.add('uk-text-success');
            target.classList.remove('uk-text-danger');
        }else{
            target.classList.add('uk-text-danger');
            target.classList.remove('uk-text-success');
        }
    }
    validarContras(e);
}

function validarContras(e){
    target = e.target;
    // Validate lowercase letters
    let lowerCaseLetters = /[a-z]/g;
    // Validate capital letters
    let upperCaseLetters = /[A-Z]/g;
    // Validate numbers
    let numbers = /[0-9]/g;

    let minuscula = document.getElementById("minuscula");
    let mayuscula = document.getElementById("mayuscula");
    let numero = document.getElementById("numero");
    let caracteres = document.getElementById("caracteres");
    let coincidir = document.getElementById("coincidir");

    let validNum = document.getElementById('contrasenia').value.match(numbers);
    let validMin = document.getElementById('contrasenia').value.match(lowerCaseLetters);
    let validCaps = document.getElementById('contrasenia').value.match(upperCaseLetters);
    let validLen = document.getElementById('contrasenia').value.length >= 8;
    let validVerif = document.getElementById('contrasenia').value == document.getElementById('verifContrasenia').value;


    if(target.name == 'contrasenia' || target.name == 'verifContrasenia'){
        if(validNum){
            numero.classList.remove('uk-text-danger');
            numero.classList.add('uk-text-success');
        }else{
            numero.classList.remove('uk-text-success');
            numero.classList.add('uk-text-danger');
        }
        if(validMin){
            minuscula.classList.remove('uk-text-danger');
            minuscula.classList.add('uk-text-success');
        }else{
            minuscula.classList.remove('uk-text-success');
            minuscula.classList.add('uk-text-danger');
        }
        if(validCaps){
            mayuscula.classList.remove('uk-text-danger');
            mayuscula.classList.add('uk-text-success');
        }else{
            mayuscula.classList.remove('uk-text-success');
            mayuscula.classList.add('uk-text-danger');
        }
        if(validLen){
            caracteres.classList.remove('uk-text-danger');
            caracteres.classList.add('uk-text-success');
        }else{
            caracteres.classList.remove('uk-text-success');
            caracteres.classList.add('uk-text-danger');
        }

        if(validVerif){
            coincidir.classList.remove('uk-text-danger');
            coincidir.classList.add('uk-text-success');
        }else{
            coincidir.classList.remove('uk-text-success');
            coincidir.classList.add('uk-text-danger');
        }

        if(validNum && validMin && validCaps && validLen && validVerif){
            document.getElementById("terminar").disabled = false;
        } else{
            document.getElementById("terminar").disabled = true;
        }
    }
}

function validarEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}