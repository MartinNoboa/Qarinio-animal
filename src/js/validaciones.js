const form = document.querySelector('#sign-up');
let email=form.elements.namedItem('email');


email.addEventListener('input',validar);

form.addEventListener('submit',function(e){
   e.preventDefault(); 
});
function validar(e){
    let target =e.target;
    console.log(e.target.name);
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
        if(validarEmail(target.value)){
            //target.classList.add('uk-text-success');
            target.classList.remove('uk-text-danger');
        }else{
            target.classList.add('uk-text-danger');
            target.classList.remove('uk-text-success');
        }
    }
    
    
    
}

function validarEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}