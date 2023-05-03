
/*Variables para identificar el dom */
const modalfpcd = new bootstrap.Modal(document.getElementById('modalFactor'))
const formFactor  = document.querySelector('form');
const btnAcciones = document.getElementById('btnAcciones');
const contenedor  = document.querySelector('tbody');

const estado = document.getElementById('estado');
const id = document.getElementById('id');
let formAction = document.getElementById('formFactor');
var opcion = ''
let resultados = '';

/* Menu desplegable */

let   factor = document.getElementById("factor_crear");
const btnCrear = document.getElementById("btnCrear");
const nombre = document.getElementById('nombrePeligro');
const peligro = document.getElementById('peligro_actualizar');
const actualizar_peligro = document.getElementById("actualizar_peligro");

const fpcd = {
    factor    : 1,
    peligro   : 2,
    control   : 3,
    desviacion: 4
};

const todosFpcdFetch = async ( tipo ) => {

    const options = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };
    
    
      var url = new URL(`${URL_ENV}/api/fpcd/fpcd.php`);
    
      var params = { tipo: tipo };

      url.search = new URLSearchParams(params).toString();
      const response = await fetch(url, options)
      console.log( response )
      const data     = await response.json();  
    
      return data;
    
}

const ingresarPeligro   = async ( idFactor,nombre ) => {

    const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        "body": JSON.stringify({
            idfactor: idFactor,
            nombre  : nombre,
         })
      };
    
    
      let url         = `${URL_ENV}/api/peligro/insertar_peligro.php`;
      const response  = await fetch(url, options)
      const respuesta = await response.json();  
        
      respuesta  == "success"  && location.reload();
      
 
}

const ActualizarPeligro = async ( idFactor,nombre ) => {

    const options = {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        "body": JSON.stringify({
            idfactor: idFactor,
            nombre: nombre,
         })
      };
    
    console.log( options )
      let url         = `${URL_ENV}/api/peligro/actualizar_peligro.php`;
      const response  = await fetch(url, options)
      const respuesta = await response.json();  
        
      respuesta  == "success"  && location.reload();
      
 
}

function renderSelect(values, selector) {
  
  const select = document.querySelector(selector);
 
  $(`${selector} option`).remove();

  for (option of values) {
    const newOption = document.createElement("option");
    let data = Object.values(option);
    newOption.value = data[0];
    newOption.text = data[1];
    select.appendChild(newOption);
  }
}


todosFpcdFetch(fpcd.factor)
                        .then( (resp ) => 
                        { 
                          renderSelect( resp , "#factor_crear");
                          renderSelect( resp , "#factor_actualizar");
                        } );

todosFpcdFetch(fpcd.peligro)
                        .then( (resp ) => 
                        { 
                          renderSelect( resp , "#peligro_actualizar");
                        } );                       



const on = (element, event, selector, handler) => {

    element.addEventListener(event, e => {
        if(e.target.closest(selector)){
            handler(e)
        }
    })
}



/* Boton crear para llamar modal en blanco */
btnCrear.addEventListener('click', ( e )=>{
     e.preventDefault();
     console.log( factor.value, nombre.value )
     ingresarPeligro( factor.value , nombre.value );
     
})

let idForm = 0


let ae = document.getElementById("btnActualizar");

ae.addEventListener("click",(e)=>{
  e.preventDefault();
  console.log($('#peligro_actualizar').select2().val())
})


on(document, 'click', '.btnEditar', e => { 

    const fila = e.target.parentNode.parentNode
    idForm = fila.children[0].innerHTML
    const nombreForm = fila.children[1].innerHTML

    nombre.value =  nombreForm;
    id.value = idForm;

    console.log(idForm);
    
    formAction.action = `${URL_ENV}/server/actualizarEmpresas.php`;
    opcion = 'editar'
    modalfpcd.show();

    
     
})


/* Evento submit para crear o editar */
/*SbtnAcciones.addEventListener('click', (e)=>{

    e.preventDefault();  

 
    const accion = {
        crear : Symbol(),
        editar: Symbol()
    }
    
    

    if( opcion == "crear"){        

       
       ingresarFactor( nombre.value );

       
    };

    if(opcion=='editar'){    
        //console.log('OPCION EDITAR')
        console.log(idForm);
        console.log(nombre.value);
    


        ActualizarFactor(idForm,nombre.value);
      
    }
    modalfpcd.hide()
})*/


