const resetValue = 0;


let sedes = document.getElementById("sedes");
let form = document.querySelector("#formInspeccion");




sedes.addEventListener("change",()=>{
  $("#sedes option:selected").each(function () {
 
    let idSede = $(this).val();
  
    if(idSede != 0){
      fetchDataSelect(idSede,"","","#vp_idSede","");


      form.elements[3].value = "";
      form.elements[4].value = "";
    
      console.log(idSede);

      fetchDataSelect("","","","#locacion",idSede);
      

    }else if(idSede == "" || idSede ==  undefined || idSede ==  0 ){

      form.elements[2].value = "";
      form.elements[3].value = "";
      form.elements[4].value = "";
      form.elements[5].value = "";


    }

   
  });
 
})

let vicepresidencia = document.getElementById("vp_idSede");	
vicepresidencia.addEventListener("change",()=>{



  $("#vp_idSede option:selected").each(function () {

    let idVicepresidencia = $(this).val();
  
    if(idVicepresidencia != 0){

      fetchDataSelect("",idVicepresidencia,"","#dpto","");
     


      const dptoSelectIndex = document.getElementById("dpto").selectedIndex;

      if( dptoSelectIndex == 1){
        
      }

    }else if(idVicepresidencia == 0){
 
      form.elements[4].value = "";
      form.elements[5].value = "";

  
      $( "#dpto" ).prop( "disabled", true );

    }

    

    
  });





})

let dpto = document.getElementById("dpto");
dpto.addEventListener("change",()=>{
 $("#dpto option:selected").each(function () {
    let area_idDpto = $(this).val();

    if(area_idDpto != 0){  
      fetchDataSelect("","",area_idDpto,"#area","");
    
      }else{
      form.elements[5].value = "";
   
    }


  });
})



let area = document.getElementById("area");
area.addEventListener("change",()=>{
  let locacion = form.elements['locacion'].value;
 $("#area option:selected").each(function () {
    let area_id = $(this).val();
    if(area_id != 0){  
      SelectDelegadoyPertenece(area_id,locacion,"","#delegado");
      SelectDelegadoyPertenece(area_id,locacion,1,"#responsable");
 
     
      }else{
      form.elements['delegado'].value = "";
      form.elements['responsable'].value = "";
  
 
    }
  });
})



const fetchDataSelect = async (vp_idsede,dpto,area,selector,locacion) => {
  const options = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };


  var url = new URL(`${URL_ENV}/server/inspeccion-server.php`);

  var params = { vp_idsede: vp_idsede, dpto:dpto, area:area, locacion:locacion };
  
  url.search = new URLSearchParams(params).toString();
  console.log(url);
  const sedes = await fetch(url, options)
    .then((response) => response.json())
    .then((data) => renderSelect(data, selector));
  
};

const SelectDelegadoyPertenece = async (area,locacion,rol,selector) => {
  const options = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };


  var url = new URL(`${URL_ENV}/server/select_delegado.php`);

  var params = { area: area, locacion:locacion, rol:rol };
  
  url.search = new URLSearchParams(params).toString();

  const sedes = await fetch(url, options)
    .then((response) => response.json())
    .then((data) => renderSelect(data, selector));
  
};

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


