
/*Variables para identificar el dom */
const modalEmpresas = new bootstrap.Modal(document.getElementById('modalEmpresas'))
const formEmpresas = document.querySelector('form')
const contenedor = document.querySelector('tbody');
const nombre = document.getElementById('nombre')
const estado = document.getElementById('estado');
const id = document.getElementById('id');
let formAction = document.getElementById('formEmpresas');
var opcion = ''
let resultados = '';

/* Funcion Mostrar para construir tr y td */
const mostrar = (empresas) => {
    empresas.forEach(empresa => {
        resultados += `<tr>
                            <td class='col-md-3'>${empresa.idEpresas}</td>
                            <td class='col-md-5' style='text-transform:capitalize'>${empresa.NombreEmpresa}</td>
                            <td class='col-md-2 text-center'>${empresa.estado == 1 ? 'Activo' : 'Inactivo' }</td>
                            <td class='col-md-3' style="display:none">${empresa.estado}</td>
                            <td class="text-center col-md-2"><i style="cursor:pointer" class="fa-solid fa-pen-to-square icon_edit me-2 btnEditar"></i></td>
                       </tr>
                    `    
    })
    contenedor.innerHTML = resultados
    
}

/* Funcion fetch para traer las empresas */
const todasEmpresasFetch = async () => {

    const urlEmpresas = `${URL_ENV}/api/empresas.php`;

    console.log( urlEmpresas );
    const response = await fetch(urlEmpresas , {
        method: 'GET'
    });
    const data = await response.json();
    mostrar(data);
}

todasEmpresasFetch();


/*Checked assign value */
estado.addEventListener("change",()=>{
    if(estado.checked){
        estado.value = "1";
    }else{
        estado.value = "0";
    }
})


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
     estado.value = '';
     $('#estado').prop("checked", false);
     modalEmpresas.show()
     opcion = 'crear';
     
     formAction.action = `${URL_ENV}/server/nuevaEmpresas.php`;
     console.log("crear")
     console.log(formAction.action);
     
})

let idForm = 0
on(document, 'click', '.btnEditar', e => {    
    const fila = e.target.parentNode.parentNode
    idForm = fila.children[0].innerHTML
    const nombreForm = fila.children[1].innerHTML
    const estadoForm = fila.children[3].innerHTML


    nombre.value =  nombreForm;
    estado.value =   estadoForm;
    id.value = idForm;
    
    formAction.action = `${URL_ENV}/server/actualizarEmpresas.php`;
    
    if(estado.value == 1){
        $('#estado').prop("checked", true);
    }else{
        $('#estado').prop("checked", false);
    }


    opcion = 'editar'
     
    modalEmpresas.show();

    
     
})




/* Evento submit para crear o editar */
formEmpresas.addEventListener('submit', (e)=>{
    e.preventDefault();
    if(opcion=='crear'){        

         if(estado.value == "" | estado.value == undefined ){
            estado.value = 0;
        }

        fetch(`${URL_ENV}/api/nuevaEmpresas.php`, {
            method:'POST',
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify({
                nombre:nombre.value,
                estado:estado.value,
            })
        })
        .then( response => response.json() )
        .then( data => {
            if (data == "success"){
                //location.reload();
            }
        })
    }
    if(opcion=='editar'){    
        //console.log('OPCION EDITAR')
        console.log(idForm);
        console.log(nombre.value);
        console.log(estado.value);
        if(estado.value == "" | estado.value == undefined | estado.value == 0){
            estado.value = 0;
        }

        fetch(`${URL_ENV}/api/actualizarEmpresas.php`,{
            method: 'PUT',
            headers: {
                'Content-Type':'application/json'
            },
            body: JSON.stringify({
                idEmpresa: idForm,
                nombre:nombre.value,
                estado:estado.value,
            })
        })
        .then( response => response.json() )
        .then( data => {
            if (data == "success"){
                location.reload();
            }
        })
    }
    modalEmpresas.hide()
})