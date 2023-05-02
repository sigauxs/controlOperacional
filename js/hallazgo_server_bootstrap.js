document.addEventListener("DOMContentLoaded",()=>{
   
    
      const cardBody = document.querySelector('#card-body');
      const factoresRiesgo = 1;
      const peligroRiesgo = 2;
      const controles = 3;
      const desviaciones = 4;
   

      const fetchDataHallazgo = async (factorRiesgo,peligroRiesgo,controles,desviaciones) =>{

        const options = {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        };

        var url = new URL("https://controlope.sigpeconsultores.com.co/api/hallazgo.php");
        var params = {factorRiesgo:factorRiesgo, peligroRiesgo:peligroRiesgo, controles:controles,desviaciones:desviaciones};
        url.search = new URLSearchParams(params).toString();

        const response = await fetch(url, options);
        const data =  await response.json();
        return data;
      }

   
      fetchDataHallazgo(factoresRiesgo,"","","","")
              .then( dataHallazgo => {
                localStorage.setItem("factoresRiesgo",JSON.stringify(dataHallazgo));
                })
              
            
     


});

/* */