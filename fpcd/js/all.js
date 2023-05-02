
/*Variables para identificar el dom */
const modalfpcd = new bootstrap.Modal(document.getElementById('modalFactor'))
const formFactor  = document.querySelector('form');
const btnAcciones = document.getElementById('btnAcciones');
const contenedor  = document.querySelector('tbody');
const nombre = document.getElementById('nombre')
const estado = document.getElementById('estado');
const id = document.getElementById('id');
let formAction = document.getElementById('formFactor');
var opcion = ''
let resultados = '';


/* Form Elements*/



/* Funcion Mostrar para construir tr y td */
const mostrar = (factores) => {
    factores.forEach(factor => {
        resultados += `<tr>
                            <td class='col-md-3'>${factor.idFactor}</td>
                            <td class='col-md-7' style='text-transform:capitalize'>${factor.NombreFactor}</td>
                            <td class="text-center col-md-2"><i style="cursor:pointer" class="fa-solid fa-pen-to-square icon_edit me-2 btnEditar"></i></td>
                       </tr>
                    `    
    })
    contenedor.innerHTML = resultados
    
}

/* Funcion fetch para traer las empresas */
const fpcd = {
    factor    : 1,
    peligro   : 2,
    control   : 3,
    desviacion: 4
};

const todosFactoresFetch = async ( tipo ) => {

    const options = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };
    
    
      var url = new URL(`${URL_ENV}/api/fpcd/fpcd.php`);
    
      var params = { tipo: tipo.factor };

      url.search = new URLSearchParams(params).toString();
      const response = await fetch(url, options)
      console.log( response )
      const data     = await response.json();  
      console.log( data );
      mostrar(data);
}

todosFactoresFetch(fpcd);


/*Checked assign value */
/*estado.addEventListener("change",()=>{
    if(estado.checked){
        estado.value = "1";
    }else{
        estado.value = "0";
    }
})*/


const on = (element, event, selector, handler) => {

    element.addEventListener(event, e => {
        if(e.target.closest(selector)){
            handler(e)
        }
    })
}



/* Boton crear para llamar modal en blanco */
btnCrear.addEventListener('click', ()=>{

     nombre.value = '';
     modalfpcd.show()
     opcion = 'crear';
     formAction.action = ``;
     console.log("crear")
     console.log(formAction.action);
     
})

let idForm = 0


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
btnAcciones.addEventListener('click', (e)=>{

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
})

const ingresarFactor = async ( data ) => {

    const options = {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        "body": JSON.stringify({
            nombre: data,
         })
      };
    
    
      let url        = `${URL_ENV}/api/fpcd/insertar_factor.php`;
      const response = await fetch(url, options)
      const respuesta     = await response.json();  
        
      respuesta  == "success"  && location.reload();
      
 
}

const ActualizarFactor = async ( id,nombre ) => {

    const options = {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        "body": JSON.stringify({
            id: id,
            nombre: nombre,
         })
      };
    
    console.log( options )
      let url         = `${URL_ENV}/api/fpcd/actualizar_factor.php`;
      const response  = await fetch(url, options)
      const respuesta = await response.json();  
        
      respuesta  == "success"  && location.reload();
      
 
}