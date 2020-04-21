if(window.matchMedia("(max-width: 700px)").matches){
    $("#filterMenu")[0].classList.remove("uk-align-left");
    $("#listaFiltro")[0].setAttribute("uk-nav", "multiple: false")
}

let ageSlider = document.getElementById('ageSlider');
noUiSlider.create(ageSlider, {
    start: [0,144],
    connect: true,
    step: 1,
    range: {
        'min': [0],
        '40%': [12, 12],
        'max': [144]
}, format: {
    // 'to' the formatted value. Receives a number.
    to:  value => {
        if(value/12<1)
            return parseInt(value) + " meses";
        else if(value == 144)
            return parseInt(value/12) + "+ años";
        else
            return parseInt(value/12) + " años"
    },
        // 'from' the formatted value.
        // Receives a string, should return a number.
        from: function(value) {
        let res = value.replace(/ meses/, '');
        if(isNaN(res)){
            res = value.replace(/ años/, '')*12;
            if(isNaN(res)){
                res = value.replace("+ años", '')*12;
            }
        } else(res=Number(res));
        return res;
    }
}
});
let ageSliderValueElement = document.getElementById('ageSlider-value');
ageSlider.noUiSlider.on('update', function (values) {
    ageSliderValueElement.innerHTML = values.join(' - ');
});

let miA = document.getElementById('minAge');
let maA = document.getElementById('maxAge');

ageSlider.noUiSlider.on('update', function (values) {
    miA.value = ageSlider.noUiSlider.options.format.from(values[0]);
    maA.value = ageSlider.noUiSlider.options.format.from(values[1]);
});