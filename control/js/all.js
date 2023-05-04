const idPeligro_control = document.getElementById("idpeligro_control");
const btnCrear          = document.getElementById("btnCrear");

/*Variables para identificar el dom */

const fpcd = {
    factor    : 1,
    peligro   : 2,
    control   : 3,
    desviacion: 4
};



/* Peticiones HTTP */
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

const jerarquias = async () => {
  const options = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  };


  var url = new URL(`${URL_ENV}/api/jerarquia.php`);



  const response = await fetch(url, options)
  console.log( response )
  const data     = await response.json();  

  return data;
}

/* End Peticiones HTTP */


/*  funcion para renderizar select */
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
/*  end funcion para renderizar select */



/* Utilidades */
const selector = ( identificador ) => {
   return document.getElementById(`${ identificador }`);
}
/* Utilidades */


/* Variables */

const factor_crearControl  = selector( "factor_crearControl"  );
const peligro_crearControl = selector( "peligro_crearControl" );
const jerarquia            = selector( "jerarquia" );
const nombreControl        = selector( "nombreControl" );

/* end variables  */


/* Cargas de Menus */


todosFpcdFetch( fpcd.factor ) //Factor
                            .then( (resp) => {
                                       renderSelect( resp , "#factor_crearControl" ); 
                            }
                            )

todosFpcdFetch( fpcd.peligro ) //Peligro
                            .then( (resp) => {
                              setTimeout(() => {
                                const factor_crearControl   = selector( "factor_crearControl").value ;
                                const peligros_crearControl = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_crearControl })
                                
                                 renderSelect( peligros_crearControl , "#peligro_crearControl");
                              }, 500);
                            }
                            )


jerarquias() // Jerarquia
          .then( (jerarquias) => {

            renderSelect( jerarquias,"#jerarquia" )

          } )


const ingresarControl  = async ( idpeligro,idjerarquia,nombreControl ) => {

            const options = {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                "body": JSON.stringify({
                    idpeligro  : idpeligro,
                    idjerarquia: idjerarquia,
                    nombre     : nombreControl,
                 })
              };
            
            
              let url         = `${URL_ENV}/api/control/insertar_control.php`;
              const response  = await fetch(url, options)
              const respuesta = await response.json();  
                
              respuesta  == "success"  && location.reload();
              
         
}
        

/* End carga de Menus */


factor_crearControl.addEventListener("change",()=>{
  
  todosFpcdFetch(fpcd.peligro)
                            .then( (resp) => {
                              setTimeout(() => {
                                const factor_crearControl   = selector( "factor_crearControl").value ;
                                const peligros_crearControl = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_crearControl })
                                
                                 renderSelect( peligros_crearControl , "#peligro_crearControl");
                              }, 350);
                            }
                            ) 

                           
                        })


btnCrear.addEventListener('click', ( e )=>{
                      e.preventDefault();
                       /*console.log(
                       peligro_crearControl.value,
                       jerarquia.value              ,         
                       nombreControl.value  );   */                
                      if(nombreControl.value == ""){     
                        alert("Ingrese un descripcion")
                        return
                      }
  
                      console.log(peligro_crearControl.value , jerarquia.value , nombreControl.value)
                     //ingresarControl( peligro_crearControl.value , jerarquia.value , nombreControl.value );
                          
})                       