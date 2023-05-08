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
const nombreDesviacion            = selector( "nombreDesviacion" );
const tipoDesviacion              = selector( "tipoDesviacion" );

const factor_actualizarDesviacion     = selector( "factor_actualizarDesviacion" );
const peligro_actualizarDesviacion    = selector( "peligro_actualizarDesviacion" );
const control_actualizarDesviacion    = selector( "control_actualizarDesviacion" ); 
const tipoDesviacionActualizar        = selector( "tipoDesviacionActualizar" );
const desviaciones                    = selector( "desviaciones");


let   jerarquiaControl          = "";
const btnActualizar             = selector( "btnActualizar");
const nombreDesviacionActualizar   = selector( "nombreDesviacionActualizar");

/* end variables  */


function sameName(){
 
 nombreDesviacionActualizar.value =  $("#desviaciones option:selected").text();

}
/* Cargas de Menus */

let factores = [];

todosFpcdFetch( fpcd.factor ) //Factor
                            .then( (resp) => {
                                      
                                       renderSelect( resp , "#factor_crearDesviaciones" ); 
                                       renderSelect( resp , "#factor_actualizarDesviacion" ); 
                            }
                            )

console.log("")

todosFpcdFetch( fpcd.peligro ) //Peligro
                            .then( (resp) => {
                              setTimeout(() => {
                                const factor_crearDesviacion     =  selector( "factor_crearDesviaciones").value ;
                                const factor_actualizarControl =  selector( "factor_actualizarDesviacion" ).value ;
                                const peligros_crearDesviaciones  =  resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_crearDesviacion });
                                const peligros_actualizarControl = resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_actualizarControl });
                                
                                 renderSelect( peligros_crearDesviaciones , "#peligro_crearDesviaciones");
                                 renderSelect( peligros_actualizarControl , "#peligro_actualizarDesviacion");
                              }, 400);
                            }
                            )

todosFpcdFetch( fpcd.control ) //control
                            .then( (controles) => {
                              setTimeout(() => {
                                
                                 
                               const control     =  controles.filter((control)=>{ return control.Peligro_idPeligro == peligro_crearDesviaciones.value });
                               const control_Desviacion     =  controles.filter((control)=>{ return control.Peligro_idPeligro == peligro_actualizarDesviacion.value });
                                const primerItem =  [...control];
                          
                                 renderSelect( control , "#control_crearDesviaciones");
                                 renderSelect( control_Desviacion , "#control_actualizarDesviacion");
                              

                                
                              }, 500);
                            }
                            )
                            
todosFpcdFetch(fpcd.desviacion)
                            .then( (desviaciones) => {

                              if(!localStorage.getItem('desviaciones')){
                                console.log("desviacioones almacenadas")
                                localStorage.setItem("desviaciones",JSON.stringify(desviaciones));
                              }
                              
                              setTimeout(() => {
                                const desviacionesFiltradas = desviaciones.filter(
                                  (desviacion) => {
                                   return desviacion.Control_idControl == control_actualizarDesviacion.value
                                 })
                        
                                 const primerItem =  [...desviacionesFiltradas];
                                
                                 tipoDesviacionActualizar.value = primerItem[0].Tipo_Desviacion;
                        
                                 renderSelect( desviacionesFiltradas,"#desviaciones")
                              }, 600);
                               
                            })



const ingresarDesviacion  = async ( tipo,descripcion,idcontrol ) => {

            const options = {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                "body": JSON.stringify({
                  tipo:tipo,
                  descripcion:descripcion,
                  idcontrol:idcontrol
                 })
              };
            
            
              let url         = `${URL_ENV}/api/desviaciones/insertar_desviaciones.php`;
              
              const response  = await fetch(url, options)
         
              const respuesta = await response.json();
             
                
              respuesta  == "success"  && location.reload();
              
         
}
        
const ActualizarDesviacion = async (iddesv,descdesv,tipo) => {

  const options = {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      "body": JSON.stringify({
          iddesv  : iddesv,
          descdesv: descdesv,
          tipo    : tipo

       })
    };
  
  
    let url         = `${URL_ENV}/api/desviaciones/actualizar_desviaciones.php`;
    const response  = await fetch(url, options)
    const respuesta = await response.json();  
      
   if (respuesta == "success") {

    Swal.fire({
      title: 'desviación Actualizada',     
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
                            
                                const factor_crearDesviacion     =  selector( "factor_crearDesviaciones").value ;
                                const peligros_crearDesviaciones   =  resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_crearDesviacion });
                                 renderSelect( peligros_crearDesviaciones , "#peligro_crearDesviaciones");
                                
                              
                            });

  todosFpcdFetch(fpcd.control)
                              .then( (controles) => {

                                setTimeout(() => {
                                  const controlesFiltrados = controles.filter(
                                    (control) => {
                                     return control.Peligro_idPeligro == peligro_crearDesviaciones.value
                                   })

                                   renderSelect( controlesFiltrados,"#control_crearDesviaciones")
                                }, 500);
                                 
                              })

                           
                        })


peligro_crearDesviaciones.addEventListener("change",()=>{
  
  todosFpcdFetch( fpcd.control ) //control
  .then( (controles) => {
    setTimeout(() => {


  const controlesFiltrados =  controles.filter(
                      (control)=>{ 
                        return control.Peligro_idPeligro == peligro_crearDesviaciones.value
                      });
      

  console.log( controlesFiltrados );

 

  
  
  renderSelect( controlesFiltrados , "#control_crearDesviaciones");
               
       }, 500); });  
                                                   
                                                })








factor_actualizarDesviacion.addEventListener("change",()=>{
  
  todosFpcdFetch(fpcd.peligro)
  .then( (resp) => {
  
      const factor_actualizarDesviacion     =  selector( "factor_actualizarDesviacion").value ;
      const peligros_Desviaciones   =  resp.filter((peligro)=>{ return peligro.Factor_idFactor == factor_actualizarDesviacion });
       renderSelect( peligros_Desviaciones , "#peligro_actualizarDesviacion");
      
    
  });

todosFpcdFetch(fpcd.control)
    .then( (controles) => {

      setTimeout(() => {
        const controlesFiltrados = controles.filter(
          (control) => {
           return control.Peligro_idPeligro == peligro_actualizarDesviacion.value
         })

         renderSelect( controlesFiltrados,"#control_actualizarDesviacion")
      }, 500);
       
    })
    
    todosFpcdFetch(fpcd.desviacion)
    .then( (desviaciones) => {

      setTimeout(() => {
        const desviacionesFiltradas = desviaciones.filter(
          (desviacion) => {
           return desviacion.Control_idControl == control_actualizarDesviacion.value
         })

         const primerItem =  [...desviacionesFiltradas];
        
         tipoDesviacionActualizar.value = primerItem[0].Tipo_Desviacion;

         renderSelect( desviacionesFiltradas,"#desviaciones")
      }, 500);
       
    })
                        
                                                   
                  })


peligro_actualizarDesviacion.addEventListener("change",()=>{
               
  todosFpcdFetch(fpcd.control)
    .then( (controles) => {

      setTimeout(() => {
        const controlesFiltrados = controles.filter(
          (control) => {
           return control.Peligro_idPeligro == peligro_actualizarDesviacion.value
         })

         renderSelect( controlesFiltrados,"#control_actualizarDesviacion")
      }, 500);
       
    })
    
    todosFpcdFetch(fpcd.desviacion)
    .then( (desviaciones) => {

      setTimeout(() => {
        const desviacionesFiltradas = desviaciones.filter(
          (desviacion) => {
           return desviacion.Control_idControl == control_actualizarDesviacion.value
         })

         const primerItem =  [...desviacionesFiltradas];
        
         tipoDesviacionActualizar.value = primerItem[0].Tipo_Desviacion;

         renderSelect( desviacionesFiltradas,"#desviaciones")
      }, 500);
       
    })
           



                  })

                          

control_actualizarDesviacion.addEventListener("change",()=>{

  todosFpcdFetch(fpcd.desviacion)
  .then( (desviaciones) => {

    setTimeout(() => {
      const desviacionesFiltradas = desviaciones.filter(
        (desviacion) => {
         return desviacion.Control_idControl == control_actualizarDesviacion.value
       })

       const primerItem =  [...desviacionesFiltradas];
      
       tipoDesviacionActualizar.value = primerItem[0].Tipo_Desviacion;

       renderSelect( desviacionesFiltradas,"#desviaciones")
    }, 500);
     
  })

})


desviaciones.addEventListener("change",()=>{
  
 

  
  todosFpcdFetch(fpcd.desviacion)
  .then( (desviaciones) => {  
    
    let desviacionActual = selector( "desviaciones" );
    setTimeout(() => {


      const desviacionesFiltradas = desviaciones.filter(
        (desviacion) => {
         return desviacion.Control_idControl == control_actualizarDesviacion.value
       })

       console.log( desviacionActual.value );

       desviacionesFiltradas.forEach( (desviacionConsultada) => { 
        if(desviacionActual.value == desviacionConsultada.idDesviacion){
          tipoDesviacionActualizar.value = desviacionConsultada.Tipo_Desviacion;
        }
  })
      
       
    }, 600);
     
  })

  /*if( desviacionesLocales.length > 0){
    let desviacionesFiltradas = desviacionesLocales.filter((desviacion)=>{ return desviacion.Control_idControl == control_actualizarDesviacion.value})
    
    desviacionesFiltradas.forEach( (element) => { 
      if(desviaciones.value == element.idDesviacion){
        tipoDesviacionActualizar.value = element.Tipo_Desviacion;
      }
    });
  }*/
  
})




btnCrear.addEventListener('click', ( e )=>{
                      e.preventDefault();
                               
                      if(nombreDesviacion.value == ""){     
                        alert("Ingrese un descripcion")
                        return
                      }
  
                      console.log(tipoDesviacion.value,nombreDesviacion.value,control_crearDesviaciones.value);
                      ingresarDesviacion(tipoDesviacion.value,nombreDesviacion.value,control_crearDesviaciones.value)
                          
});

btnActualizar.addEventListener("click",(e)=>{
e.preventDefault();

    if( nombreDesviacionActualizar.value == ""){
      alert("Ingrese un descripcion")
      return;
    }

    ActualizarDesviacion(desviaciones.value,nombreDesviacionActualizar.value,tipoDesviacionActualizar.value);
}
)