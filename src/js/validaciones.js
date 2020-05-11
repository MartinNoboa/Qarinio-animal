var form = document.querySelector('#sign-up');
let email=form.elements.namedItem("email");
let telefono=form.elements.namedItem("telefono");
let contrasenia=form.elements.namedItem("contrasenia");
let verifContrasenia=form.elements.namedItem("verifContrasenia");


email.addEventListener('input',validar);
telefono.addEventListener('input',validar);
contrasenia.addEventListener('input',validar);
verifContrasenia.addEventListener('input',validar);

function validar(e){
    let target =e.target;
    console.log(target.value.length);
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
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    // Validate numbers
    var numbers = /[0-9]/g;
    
    var minuscula = document.getElementById("minuscula");
    var mayuscula = document.getElementById("mayuscula");
    var numero = document.getElementById("numero");
    var caracteres = document.getElementById("caracteres");
    var coincidir = document.getElementById("coincidir");
  
    
       if(target.name == 'contrasenia' || target.name == 'verifContrasenia'){
           
           if(document.getElementById('contrasenia').value.match(numbers)){
               numero.classList.remove('uk-text-danger');
                numero.classList.add('uk-text-success');
               document.getElementById("terminar").disabled = false;
              }else{
                numero.classList.remove('uk-text-success');
                numero.classList.add('uk-text-danger');
                  document.getElementById("terminar").disabled = true;
            }
            if(document.getElementById('contrasenia').value.match(lowerCaseLetters)){
                minuscula.classList.remove('uk-text-danger');
                minuscula.classList.add('uk-text-success');
                document.getElementById("terminar").disabled = false;
              }else{
                minuscula.classList.remove('uk-text-success');
                minuscula.classList.add('uk-text-danger');
                  document.getElementById("terminar").disabled = true;
            }
            if(document.getElementById('contrasenia').value.match(upperCaseLetters)){
                mayuscula.classList.remove('uk-text-danger');
                mayuscula.classList.add('uk-text-success');
                document.getElementById("terminar").disabled = false;
              }else{
                mayuscula.classList.remove('uk-text-success');
                mayuscula.classList.add('uk-text-danger');
                document.getElementById("terminar").disabled = true;
            }
            if(document.getElementById('contrasenia').value.length >= 8){
                caracteres.classList.remove('uk-text-danger');
                caracteres.classList.add('uk-text-success');
                document.getElementById("terminar").disabled = false;
              }else{
                caracteres.classList.remove('uk-text-success');
                caracteres.classList.add('uk-text-danger');
                  document.getElementById("terminar").disabled = true;
            }
           
            if(document.getElementById('contrasenia').value ==                      document.getElementById('verifContrasenia').value ){
                    coincidir.classList.remove('uk-text-danger');
                    coincidir.classList.add('uk-text-success');   
                    document.getElementById("terminar").disabled = false;
                }else{
                    coincidir.classList.remove('uk-text-success');
                    coincidir.classList.add('uk-text-danger');
                    document.getElementById("terminar").disabled = true;
            }
           
    }
    
    
    
    
    
}

function validarEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}