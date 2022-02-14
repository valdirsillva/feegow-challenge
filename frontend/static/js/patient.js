"use strict"
// objeto que receberá os ddaos preenchidos no formulario
const DATA = {};

const selected = document.querySelector('select');
const buttonClick = document.querySelector('button');

// iife
(function() {
    const inputs = document.querySelectorAll('.data');

    /**
     * Pega parâmetros via get
     */
    const params = new URLSearchParams(document.location.search.substring(1));
    const professional = params.get("professional");
    const specialties = params.get("specialties");
    
    /**
     * add o id do profisional especialidade no objeto [DATA]
     */
    DATA['professional'] = professional;
    DATA['specialties'] = specialties;
    
  
    const resource = `http://localhost/feegow/feegow-challenge/app/index.php?getlist=source_id`;

    fetch(resource)
    .then((response) => {
        return response.json();
    })
    .then(data => {
       doMap(data);
    })
    .catch(err => {
       console.log("Houve um erro ao retornar os dados.");
    })
  

    inputs.forEach(function(currentInput) {
        currentInput.addEventListener("change", (input) => {
          setValues(input);
        })
    })

})();


function setValues( input ) {
   

    var message =  document.querySelector('#message');
    
    var inputValue = input.target.value;
    var inputName = input.target.name;  

    DATA[inputName] = inputValue;
}


    /**
     * usando async e await  
     */

     buttonClick.addEventListener("click", async () => {
        var URL = 'http://localhost/feegow/feegow-challenge/app/index.php'; 
        let keys = Object.keys(DATA);

        if(keys.length < 6) {
           return message.innerHTML = 'Por favor preencher todos os campos !'; 
        }

        message.innerHTML = '';


        DATA['action'] = 'ADD'; // tipo de método 

        const res = await fetch(URL, {
            method: "post",
            headers: {
              'Content-Type': 'application/json;charset=utf-8'
            },

            body: JSON.stringify(DATA)
        });

        if (res.status === 201 ) {
            toastr.success('Dados salvo com sucesso !');

            document.querySelectorAll('.data')
            .forEach(function(currentInput) {
               currentInput.value = '';
           })
        }
    })


function doMap(data) {
    data.content.map(source => {

       var option = createNodeDOM('option');

       option.value = source.origem_id;
       option.textContent = source.nome_origem;

       append(selected, option);
    })
}

function createNodeDOM(element) {
    return document.createElement(element);
}

function append(parent, element) {
    return parent.appendChild(element);
}
