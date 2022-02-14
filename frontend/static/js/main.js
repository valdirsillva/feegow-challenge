"use strict"

const resultsSearch = document.querySelector('.card-results');
const medicals = document.querySelector('form');
const elementSelect = document.getElementById('especialidades');

const progresso = document.getElementById('divCarregando');
const text = document.getElementById('loader-text');
const loader = document.querySelector('.loader');

elementSelect.addEventListener("change", (event) => {
   onChangeElement(); 
})

window.addEventListener("load", async () => {

    const API = 'http://localhost/feegow-challenge/app/';
    
    const data = await fetch(API).then((response) => response.json());

    mapper(data);

})


function mapper(specialties) {
    specialties.content.map(specialtie => {
       var option = createNodeDOM('option');
       option.value = specialtie.especialidade_id;
       option.textContent = specialtie.nome;

       append(elementSelect, option);
    });
}

function createNodeDOM(element) {
    return document.createElement(element);
}

function append(parent, element) {
    return parent.appendChild(element);
}

function onChangeElement() {
    var specialtieId = event.target.value;

    loading(); 

    const resource = `http://localhost/feegow-challenge/app/index.php?id=${specialtieId}&specialties=professional`;

    fetch(resource).then((response) => {

        
        if (! response.ok) {
            throw new Error(`Falha na sua solicitação com status ${response.status}`);
        }

        if ( response.status === 200 ) {
            loadingComplete(); 
        }

        return response.json();

    })
    .then(data => {       
        let mapper = doMap(data);
        let filterResults = mapper.filter(specialties => specialties.especialidade_id === parseInt(specialtieId));

        createBox(filterResults);

        console.log(data.status)

    })
    .catch(err => {
       console.log(err);
    })
}


function doMap(all) {
    let newArray = [];
    let newObject = {};

    all.content.forEach(function(profissional){ 

        profissional.especialidades.map(especialidade => {
            
            const { especialidade_id, nome_especialidade } = especialidade;
        
            newObject = {
                especialidade_id: especialidade_id,
                especialidade: nome_especialidade,
                profissional_id: profissional.profissional_id,
                nome: profissional.nome,
                crm: profissional.conselho,
                foto: profissional.foto
            }
       })
       
       newArray.push(newObject);
   });

   return newArray;   
}



function createBox(data) {
    var template = '';

    let totalResults = data.length;

    resultsSearch.textContent = `${totalResults} ${data[0].especialidade} encontrados`;

    medicals.innerHTML = '';
   
    data.map(medico => {

        const {foto, nome, crm, profissional_id, especialidade_id } = medico;

        let image = foto === null ? 'default.jpg' : foto;

        template = `
        <div class="col-sm-4">
        <div class="card">
        <div class="card-body">
            <img src=${image}  />
            <div class="info">
                <h4>${nome}</h4>
                <span>CRM ${crm}</span>
                <a href="schedule.html?professional=${profissional_id}&specialties=${especialidade_id}"  class="btn btn-primary button-schedule">
                Agendar
                </a>
            </div>
        </div>
        </div>
    </div>`;

    medicals.innerHTML += template;

    });

   
}
   
function loading() {
    progresso.classList.add('progresso');
    text.style.display = 'block';
    text.classList.add('loader-text');
}

function loadingComplete() {
    progresso.classList.remove('progresso');
    text.style.display = 'none';
    loader.style.display = 'none';
    text.classList.remove('loader-text');
}

