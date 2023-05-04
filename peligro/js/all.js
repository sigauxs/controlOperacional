
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
const idPeligro = document.getElementById("idPeligro");

const fpcd = {
    factor    : 1,
    peligro   : 2,
    control   : 3,
    desviacion: 4
};



const todosFpcdFetch    = async ( tipo ) => {

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

const ActualizarPeligro = async ( idpeligro,nombre ) => {

    const options = {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        "body": JSON.stringify({
            idpeligro: idpeligro,
            nombre: nombre,
         })
      };
    
    
      let url         = `${URL_ENV}/api/peligro/actualizar_peligro.php`;
      const response  = await fetch(url, options)
      const respuesta = await response.json();  
        
     if (respuesta == "success") {

      Swal.fire({
        title: 'Peligro Actualizado',     
        confirmButtonText: 'Ok',
      }).then((result) => {
        if (result.isConfirmed) {
              location.reload();
        }
      })

      
     }  
      
 
}

const renderSelect      = function (values, selector) {
  
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


const selector = ( identificador ) => {
   return document.getElementById(`${ identificador }`);
}

const factor_actualizar = selector( "factor_actualizar"  );
const nombrePeligro     = selector( "nombrePeligro_actualizar" );
const ae                = selector( "btnActualizar" );

/* Cargue menu desplegable e inputs por defecto */

setTimeout(() => { // input idPeligro
  idPeligro.value = $('#peligro_actualizar').select2().val();
 }, 1000);


todosFpcdFetch(fpcd.factor) // M factores
                        .then( (resp ) => 
                        { 
                          renderSelect( resp , "#factor_crear");
                          renderSelect( resp , "#factor_actualizar");


                        

                        } );

todosFpcdFetch(fpcd.peligro) // M Peligros
                        .then( (resp ) => 
                        { 
                          setTimeout(() => {
                            const factor = selector( "factor_actualizar").value ;
                            const peligros = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor })
                            console.log( peligros )
                             renderSelect( peligros , "#peligro_actualizar");
                          }, 500);
                        
                        } ); 


                      
/* End Cargue menu desplegable e inputs por defecto */


/* Eventos para cargar menu e input dinamicamente */
factor_actualizar.addEventListener("change",()=>{
  
  todosFpcdFetch(fpcd.peligro)
                        .then( (resp ) => 
                        { 
                           const factor = selector( "factor_actualizar").value ;

                           const peligros = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor })
                           renderSelect( peligros , "#peligro_actualizar");
                        } );   

                        setTimeout(() => {
                          idPeligro.value = $('#peligro_actualizar').select2().val();
                         }, 500);

                        })


$('#peligro_actualizar').on( "change", function() {

  
                          setTimeout(() => {
                            idPeligro.value = $('#peligro_actualizar').select2().val();
                           }, 500);
                           
                         } );
/* end Eventos para cargar menu e input dinamicamente */





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


ae.addEventListener("click",(e)=>{
  e.preventDefault();
  
  if( nombrePeligro.value == ""){
    alert("Ingrese un descripción");
    return;
  }

  ActualizarPeligro(idPeligro.value,nombrePeligro.value);
    
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


