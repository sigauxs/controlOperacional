/*const formLogin = document.getElementById("login");

let url = "http://localhost/cp/server/login-server.php";

formLogin.addEventListener("submit",(e)=>{
 
    const email = document.getElementById("email").value;
    console.log(email);
    const password = document.getElementById("password").value;
    console.log(password);

    fetchPostLogin(url,email,password);
    
   



})

const fetchPostLogin = async (url,email,password) => {
 
    const login = await fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },  
        body: JSON.stringify({"email": email , "password": password })}
        )
        .then((response) => response.json())
        .then(data => console.log(data));

        
}

/*document.addEventListener("DOMContentLoaded",()=>{
    let _datos = {
        email: "AMorgan@drummondltd.com",
        password: "77162256", 
      }

      console.log(_datos);
      
      fetch('http://localhost/cp/server/login-server.php', {
        method: "POST",
        headers: {"Content-type": "application/json; charset=UTF-8"},
        body: JSON.stringify(_datos),
       
      })
      .then(response => response.json()) 
      .then(json => console.log(json))
     
})*/


  




