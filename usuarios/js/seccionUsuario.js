

let formUpdateUsuario =  document.querySelector("#formUpdateUsuario");

let identificacion = idH.value;
let email = formUpdateUsuario['email'];
let password = formUpdateUsuario['pass'];
let estado_usuario = formUpdateUsuario['estados'];
let cargo = formUpdateUsuario['cargo'];
let tipoUsuario = formUpdateUsuario['tusuario'];

const btnActualizarUsuario =  document.getElementById("actualizarUsuario");

 const updateUsuario =  async () => {


  const URL = `${URL_ENV}/api/usuarios/actualizarusuario.php`;
   const options = {
     method: 'PUT',
     headers: {
         'Content-Type':'application/json'
     },
     body: JSON.stringify({

          email:email.value,
          password:password.value,
          cargo:cargo.value,
          tipousuario:tipoUsuario.value,
          rol:rol.value,
          identificacion:identificacion,
          estado:estado_usuario.value

     })
   }

   const respond =  await fetch(URL,options);
   const usuarios = await respond.json();

   return usuarios;
   
}

const fetchDataExisteUsuario = async (identification) => {

    const options = {
        method: "GET",
      };
    
      var url = new URL(`${URL_ENV}/api/usuarios/actualizarusuario.php`);
      console.log("url");
      var params = { identification: identification };
      url.search = new URLSearchParams(params).toString();
    
      const result = await fetch(url, options) /* Uso de metodologia fetch */
        .then((response) => response.json())
        .then((data) => {

    
          setValueSelect("email",data[0].email);
          setValueSelect("cargo",data[0].cargo);
          setValueSelect("pass",data[0].clave);
          setValueSelect("estados",data[0].estado);
          setValueSelect("rol",data[0].rol);
          setValueSelect("tusuario",data[0].tipoUsuario);
    
        } );
       
    
}

fetchDataExisteUsuario(idH.value);

console.log(btnActualizarUsuario);

btnActualizarUsuario.addEventListener("click", function(){
  updateUsuario().then( resp => {
    if(resp == "success"){
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Sección usuario actualizada',
        showConfirmButton: false,
        timer: 1500
      })
    }
  })
})


