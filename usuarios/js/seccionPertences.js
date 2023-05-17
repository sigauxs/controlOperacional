

let areaH = document.getElementById("areaH");
let locacionH = document.getElementById("locacionH");
let estadoH = document.getElementById("estadoH");
let numeradorH = document.getElementById("numeradorH");
let idH = document.getElementById("idH");
let usuarioH = document.getElementById("idUsuario");

const formUpdatePertence = document.querySelector("#formUpdatePertence");

const btnActualizarPertenece =  document.getElementById("actualizarPertenece");

let estado = formUpdatePertence['estado_pertenece'];
let area = formUpdatePertence['area'];
let locacion = formUpdatePertence['locacion'];


const fetchDataExistentePertence = async (area) => {

    const options = {
        method: "GET",
      };
    
      var url = new URL(`${URL_ENV}/api/usuarios/perteneceusuario.php`);
      var params = { area: area };
      url.search = new URLSearchParams(params).toString();
    
      const result = await fetch(url, options) /* Uso de metodologia fetch */
        .then((response) => response.json())
        .then((data) => {

 setTimeout(() => {
           setValueSelect("area",data[0].AREA);
           setValueSelect("vp",data[0].VP);
           setValueSelect("dpto",data[0].DPTO);
           setValueSelect("sede",data[0].SEDE);
}, "1000")

        } );
       
    
}

/* funcion para obtener los datos meditante fecth */
const fetchDataSelectPertenece = async (selector,ruta) => {

    const options = {
      method: "GET",
    };
  
    var url = new URL(`${URL_ENV}/api/menus/${ruta}.php`);
    var params = {};
    url.search = new URLSearchParams(params).toString();
  
    const result = await fetch(url, options) /* Uso de metodologia fetch */
      .then((response) => response.json())
      .then((data) => renderSelect(data, selector)); /* Function render para crear select */
    
  };

/* Funcion para renderizar el menu y las opciones  */
  function renderSelect(values, selector) {
  
    const select = document.querySelector(selector);
    const textSelect = select.children[0].text
    
  
    $(`${selector} option`).remove();
  
    let defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.text = textSelect;
    defaultOption.selected = true;
    select.appendChild(defaultOption);
  
    for (option of values) {
      const newOption = document.createElement("option");
      let data = Object.values(option);
      newOption.value = data[0];
      newOption.text = data[1];
      select.appendChild(newOption);
    }
  }

 let setValueSelect = (selector,valor) => {
    let select =  document.getElementById(`${selector}`).value = valor;
 }

 
 const updatePertenece =  async () => {


   const URL = `${URL_ENV}/api/usuarios/perteneceusuario.php`;
    const options = {
      method: 'PUT',
      headers: {
          'Content-Type':'application/json'
      },
      body: JSON.stringify({
          numerador:numeradorH.value,
          area:area.value,
          estado:estado.value,
          locacion:locacion.value
      })
    }

    const respond =  await fetch(URL,options);
    const perteneces = await respond.json();

    return perteneces;
    
 }



  fetchDataSelectPertenece("#area","areas"); /* Invvocar funciones para obtener los datos de areas */
  fetchDataSelectPertenece("#dpto","dpto"); /* Invvocar funciones para obtener los datos de departamentos */
  fetchDataSelectPertenece("#vp","vp"); /* Invvocar funciones para obtener los datos de departamentos */



setValueSelect("locacion",locacionH.value);
fetchDataExistentePertence(areaH.value);
setValueSelect("estado_pertenece",estadoH.value);


btnActualizarPertenece.addEventListener("click", function(){
  updatePertenece().then( 
    resp => {
      if(resp.status == "success"){
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Sección pertence actualizada',
          showConfirmButton: false,
          timer: 1500
        })
      }
    });
})

/* funcion para ejecutar Modal para crear Locacion y area 4-11-2011 */

const modalPertence = new bootstrap.Modal(document.getElementById('modalPertenece'))
let formPertenece = document.getElementById("formRegistrarPertence");
const btncrearPertenece =  document.getElementById("crearPertenece");

fetchDataSelectPertenece("#rarea","areas"); /* Invvocar funciones para obtener los datos de areas */
fetchDataSelectPertenece("#rdpto","dpto"); /* Invvocar funciones para obtener los datos de departamentos */
fetchDataSelectPertenece("#rvp","vp"); /* Invvocar funciones para obtener los datos de departamentos */

$(document).ready(function(e) {
  $("#rsede").change(function() {

    let sede = document.getElementById("rsede");

    console.log(sede);
    var parametros = $("#rsede").val();

    $.ajax({
      data: {
        parametros
      },
      url: './data/vp.php',
      type: 'post',
      beforeSend: function() {
      
      },
      success: function(response) {
        $("#rvp").html(response);
 
        console.log(vp);
      },
      error: function() {
        alert("error")
      }
    });
  })

  $("#rvp").change(function() {
    var parametros = $("#rvp").val();
    $.ajax({
      data: {
        parametros
      },
      url: './data/dpto.php',
      type: 'post',
      beforeSend: function() {
    
      },
      success: function(response) {
        $("#rdpto").html(response);

      },
      error: function() {
        alert("error")
      }
    });
  })

  $("#rdpto").change(function() {
    var parametros = $("#rdpto").val();
    $.ajax({
      data: {
        parametros
      },
      url: './data/area.php',
      type: 'post',
      beforeSend: function() {
  
      },
      success: function(response) {
        $("#rarea").html(response);
     

      },
      error: function() {
        alert("error")
      }
    });
  })

})

let btnRegistroLocacion = document.getElementById('registrarPertenceModal');
btnRegistroLocacion.setAttribute("disabled",true);
btncrearPertenece.addEventListener('click', ()=>{
 $('#modalPertenece').appendTo('body').modal('show');
 btnRegistroLocacion.setAttribute("disabled",true);
});

let btnCancelarLocacion = document.getElementById("btnCancelarLocacion");

btnCancelarLocacion.addEventListener("click",()=>{
  document.getElementById('formRegistrarPertence').reset();
})


formPertenece.addEventListener('change', ()=>{
 let count = 0;
 [...formPertenece.elements].forEach((input) => {
     if(input.value == "" || input.value == 0 ){
       input.style.outline = "2px solid red";
       count +=1;
     }else{
       input.style.outline = "0";
       count-=1;
     }
 });  

console.log(count);
 if(count <= -2){
  btnRegistroLocacion.removeAttribute("disabled");
 }else{
  btnRegistroLocacion.setAttribute("disabled",true);
 }

formPertenece.elements[7].style.outline = 0 ;
formPertenece.elements[2].style.outline = 0 ;
});


/* Validar si el usuario de pertenece existe. */
let areaSelectRegister = document.getElementById('rarea');

const validatePerteneceUsuario = async ()=> {

  const options = {
    method: "GET",
  };

  let url = new URL(`${URL_ENV}/api/usuarios/rwpertenece.php`);

    let params = {
    area: formPertenece.elements['rarea'].value,
    locacion: formPertenece.elements['rlocacion'].value,
    usuario: usuarioH.value
  };


  url.search = new URLSearchParams(params).toString();
  const respond =  await fetch(url,options);
  const pertenece = await respond.json();

  return pertenece;

};

areaSelectRegister.addEventListener("change", function(){

validatePerteneceUsuario().then(
    resp => {
      console.log(resp);
       if(resp == 1){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'el usuario ya existe, Cambie de Área',
        })
        btnRegistroLocacion.setAttribute("disabled",true);
       }
    }
  );

});

/* End */

/* Guardar locacion & area */
const registrarLocacionArea = async (locacion,area,usuario,estado) => {
  const URL = `${URL_ENV}/api/usuarios/rwpertenece.php`;
  const options = {
    method: 'POST',
    headers: {
        'Content-Type':'application/json'
    },
    body: JSON.stringify({
        locacion:locacion,
        area:area,
        usuario:usuario,
        estado:estado
    })
  }

  const respond =  await fetch(URL,options);
  const perteneces = await respond.json();

  return perteneces;
}

btnRegistroLocacion.addEventListener("click",()=>{
 
  registrarLocacionArea(
  formPertenece.elements['rlocacion'].value,
  formPertenece.elements['rarea'].value,
  usuarioH.value,
  formPertenece.elements['restado_pertenece'].value).then(
     resp => {
      console.log(resp);
       if(resp == "success"){
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Usuario agregado a la locación y área exitosamente.',
          showConfirmButton: false,
          timer: 1500
        })

        document.getElementById('formRegistrarPertence').reset();
       }
     }
    );

    setTimeout(()=>{
      $('#modalPertenece').appendTo('body').modal('hide');
    },1700)
});

