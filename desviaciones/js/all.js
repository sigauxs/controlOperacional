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

const factor_crearDesviaciones    = selector( "factor_crearDesviaciones"  );
const peligro_crearDesviaciones   = selector( "peligro_crearDesviaciones" );
const control_crearDesviaciones   = selector( "control_crearDesviaciones" );

const factor_actualizarControl  = selector( "factor_actualizarControl" );
const peligro_actualizarControl = selector( "peligro_actualizarControl" );
const jerarquia                 = selector( "jerarquia" );
const jerarquiaId               = selector( "jerarquiaId" );
const nombreControl             = selector( "nombreControl" );
const control                   = selector( "control");
let   jerarquiaControl          = "";
const btnActualizar             = selector( "btnActualizar");
const nombreControlActualizar   = selector( "nombreControlActualizar");

/* end variables  */


function sameName(){
 nombreControlActualizar.value = control.textContent.trim();
 console.log( nombreControlActualizar.value )
}
/* Cargas de Menus */


todosFpcdFetch( fpcd.factor ) //Factor
                            .then( (resp) => {
                                       renderSelect( resp , "#factor_crearDesviaciones" ); 
                                       renderSelect( resp , "#factor_actualizarControl" ); 
                            }
                            )

todosFpcdFetch( fpcd.peligro ) //Peligro
                            .then( (resp) => {
                              setTimeout(() => {
                                const factor_crearDesviacion     =  selector( "factor_crearDesviaciones").value ;
                                const factor_actualizarControl =  selector( "factor_actualizarControl" ).value ;
                                const peligros_crearDesviaciones  =  resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_crearDesviacion });
                                const peligros_actualizarControl = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_actualizarControl });
                                
                                 renderSelect( peligros_crearDesviaciones , "#peligro_crearDesviaciones");
                                 renderSelect( peligros_actualizarControl , "#peligro_actualizarControl");
                              }, 400);
                            }
                            )

todosFpcdFetch( fpcd.control ) //control
                            .then( (controles) => {
                              setTimeout(() => {
                                
                                 
                               const control     =  controles.filter((control)=>{ return control.Peligro_idPeligro == peligro_crearDesviaciones.value });
                                
                                const primerItem =  [...control];
                          
                                 renderSelect( control , "#control_crearDesviaciones");
                                 
                              

                                
                              }, 500);
                            }
                            )
                            




const ingresarControl  = async ( idpeligro,idjerarquia,nombreControl ) => {

            const options = {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                "body": JSON.stringify({
                    idpeligro  : idpeligro,
                    idjerarquia: idjerarquia,
                    nombrecontrol     : nombreControl,
                 })
              };
            
            
              let url         = `${URL_ENV}/api/control/insertar_control.php`;
              
              const response  = await fetch(url, options)
         
              const respuesta = await response.json();
             
                
              respuesta  == "success"  && location.reload();
              
         
}
        
const ActualizarControl = async (idcontrol,jerarquiaId,descontrol) => {

  const options = {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      "body": JSON.stringify({
          idcontrol:   idcontrol,
          idjerarquia: jerarquiaId,
          descontrol:  descontrol

       })
    };
  
  
    let url         = `${URL_ENV}/api/control/actualizar_control.php`;
    const response  = await fetch(url, options)
    const respuesta = await response.json();  
      
   if (respuesta == "success") {

    Swal.fire({
      title: 'Control Actualizado',     
      confirmButtonText: 'Ok',
    }).then((result) => {
      if (result.isConfirmed) {
            location.reload();
      }
    })

    
   }  
    

}

/* End carga de Menus */

$(document).ready(function() {
  todosFpcdFetch(fpcd.peligro)
});



factor_crearDesviaciones.addEventListener("change",()=>{
  
  todosFpcdFetch(fpcd.peligro)
                            .then( (resp) => {
                              setTimeout(() => {
                                const factor_crearDesviacion     =  selector( "factor_crearDesviaciones").value ;
                                const peligros_crearDesviaciones   =  resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_crearDesviacion });
                                 renderSelect( peligros_crearDesviaciones , "#peligro_crearDesviaciones");
                                
                              }, 350);
                            }
                            )
  todosFpcdFetch( fpcd.control ) //control
                            .then( (controles) => {
                              setTimeout(() => {
                    
                     
                            const controlesFiltrados =  controles.filter(
                                                (control)=>{ 
                                                  return control.Peligro_idPeligro == control_crearDesviaciones.value
                                                });
                                
                            const primerItem =  [...controlesFiltrados];
                            console.log( controlesFiltrados );
                            controles = controlesFiltrados;
                           
                                                      
                            
                            renderSelect( controlesFiltrados , "#control_crearDesviaciones");
                                         
                                 }, 500); });
                           
                        })

factor_actualizarControl.addEventListener("change",()=>{
  
                          todosFpcdFetch(fpcd.peligro)
                            .then( (resp) => {

                              const factor_actualizarControl =  selector( "factor_actualizarControl" ).value ;
                              const peligros_actualizarControl = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_actualizarControl });
                              renderSelect( peligros_actualizarControl , "#peligro_actualizarControl");
                                                  
                            })

                          todosFpcdFetch( fpcd.control ) //control
                            .then( (controles) => {
                              setTimeout(() => {
                    
                     
                            const controlesFiltrados =  controles.filter(
                                                (control)=>{ 
                                                  return control.Peligro_idPeligro == peligro_actualizarControl.value
                                                });
                                
                            const primerItem =  [...controlesFiltrados];
                            console.log( controlesFiltrados );
                            controles = controlesFiltrados;
                           
                            jerarquiaId.value = primerItem[0].Jerarquia_idJerarquia;
                            
                            
                            renderSelect( controlesFiltrados , "#control");
                                         
                                 }, 500); });
                        
                                                   
                  })


peligro_actualizarControl.addEventListener("change",()=>{
                todosFpcdFetch( fpcd.control ) //control
                            .then( (controles) => {
                              setTimeout(() => {
                    
                     
                            const controlesFiltrados =  controles.filter((control)=>{ return control.Peligro_idPeligro == peligro_actualizarControl.value });
                                
                            const primerItem =  [...controlesFiltrados];
                            console.log( controlesFiltrados );
                            controles = controlesFiltrados;
                           
                            jerarquiaId.value = primerItem[0].Jerarquia_idJerarquia;
                            
                            
                            renderSelect( controlesFiltrados , "#control");
                                         
                  }, 500);
                }
                )

                console.log( controles )
                  })

                          

control.addEventListener("change",()=>{

  todosFpcdFetch( fpcd.control ) //control
  .then( (controles) => {
    setTimeout(() => {


      console.log(control.value);

  const controlesFiltrados =  controles.filter((control)=>{ return control.Peligro_idPeligro == peligro_actualizarControl.value });
      
  const primerItem =  [...controlesFiltrados];
  controles = controlesFiltrados;

  controlesFiltrados.forEach( (element) => { 
        if(control.value == element.idControl){
          jerarquiaId.value = element.Jerarquia_idJerarquia;
        }
  });
 
  
  
  console.log
               
}, 500);
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
                     ingresarControl(  peligro_crearControl.value ,jerarquia.value , nombreControl.value);
                          
});

btnActualizar.addEventListener("click",(e)=>{
e.preventDefault();

    if( nombreControlActualizar.value == ""){
      alert("Ingrese un descripcion")
      return;
    }

    ActualizarControl(control.value,jerarquiaId.value,nombreControlActualizar.value);
}
)