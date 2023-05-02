


let formUpdatePersona =  document.querySelector("#formUpdatePersona");

let pnombre = formUpdatePersona['pnombre'];
let snombre = formUpdatePersona['snombre'];
let papellido = formUpdatePersona['papellido'];
let sapellido = formUpdatePersona['sapellido'];

let btnActualizarPersona = document.getElementById("actualizarPersonal");


 
 const updatePersona =  async () => {


  const URL = `${URL_ENV}/api/usuarios/actualizarpersona.php`;
   const options = {
     method: 'PUT',
     headers: {
         'Content-Type':'application/json'
     },
     body: JSON.stringify({

      pnombre:pnombre.value,
      snombre:snombre.value,
      papellido:papellido.value,
      sapellido:sapellido.value,
      identificacion:identificacion

     })
   }

   const respond =  await fetch(URL,options);
   const persona = await respond.json();

   return persona;
   
}


const fetchDataExistePersona = async (identification) => {

    const options = {
        method: "GET",
      };
    
      var url = new URL(`${URL_ENV}/api/usuarios/actualizarpersona.php`);

      var params = { identification: identification };
      url.search = new URLSearchParams(params).toString();
    
      const result = await fetch(url, options) /* Uso de metodologia fetch */
        .then((response) => response.json())
        .then((resp) => {

          console.log(resp);
          setValueSelect("pnombre",resp[0].nombre);
          setValueSelect("snombre",resp[0].snombre);
          setValueSelect("papellido",resp[0].papellido);
          setValueSelect("sapellido",resp[0].sapellido);
        } );
       
    
}

fetchDataExistePersona(idH.value);


btnActualizarPersona.addEventListener("click",()=>{
  updatePersona().then(
    
    resp => {
      console.log("resp");
      if(resp=="success"){
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Sección persona actualizada',
          showConfirmButton: false,
          timer: 1500
        })
      }
    }

  );
})
