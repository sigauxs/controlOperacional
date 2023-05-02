
console.log("Hola mundo");

let email = document.querySelector("#email");

     email.addEventListener('change',chargeEmail);


function chargeEmail(e) {


    const  si = "@drummondltd.com";
           email.value += si;



        let str = email.value;
        let regex = /@/gi, result, indices = [];
            while ( (result = regex.exec(str)) ) {
                    indices.push(result.index);
                    }

       if(indices.length > 1){

         let cut = email.value.slice(0,indices[1]);
         email.value = cut;
       }
}



// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()