document.addEventListener("DOMContentLoaded",()=>{
   
    

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

        var url = new URL("https://controlope.sigpeconsultores.com.co/hallazgo2.php");//Cambie la ruta de http://localhost/cp/api
        var params = {factorRiesgo:factorRiesgo, peligroRiesgo:peligroRiesgo, controles:controles,desviaciones:desviaciones};
        url.search = new URLSearchParams(params).toString();

        const response = await fetch(url, options);
        const data =  await response.json();
        return data;
      }

   
      fetchDataHallazgo(factoresRiesgo,"","","","")
              .then( dataHallazgo => {
                localStorage.setItem("factoresRiesgo",JSON.stringify(dataHallazgo));
                
                const menu = document.querySelector("#menu");
                const factores = dataHallazgo.map(function(factor) {
                 

                  const lvl1 = document.createElement("li");
                  lvl1.setAttribute("id",`${factor.NombreFactor}`);
                  lvl1.setAttribute("class","item");

                  const lvl1Btn = document.createElement("a");
                  lvl1Btn.setAttribute("class","btn");
                  lvl1Btn.setAttribute("href",`#${factor.NombreFactor}`)
                  lvl1Btn.textContent = factor.NombreFactor;

                  const lvl1subMenu = document.createElement("div");
                  lvl1subMenu.setAttribute("class","submenu");

                  const lvl1subMenuA = document.createElement("a");
                  lvl1subMenuA.setAttribute("href","#");
                  lvl1subMenuA.textContent = "item"


                  menu.appendChild(lvl1);
                  lvl1.appendChild(lvl1Btn);
                  lvl1.appendChild(lvl1subMenu);
                  lvl1subMenu.appendChild(lvl1subMenuA);
              });
             
              console.log(factores);
              })

      fetchDataHallazgo("",peligroRiesgo,"","").then( peligroRiesgo => {

        let fr = JSON.parse(localStorage.getItem("factoresRiesgo"));
        let idsFactorRiesgo = [];
        fr.map((factorRiesgo)=>{
          console.log(factorRiesgo);
          let factorRiesgoMenu = document.querySelector(`#${factorRiesgo.NombreFactor}`);
          console.log(factorRiesgoMenu);
        });
        console.log(idsFactorRiesgo);
        console.log( peligroRiesgo )
      
      });


      fetchDataHallazgo("","",controles,"").then( controles => { console.log( controles )});
      fetchDataHallazgo("","","",desviaciones).then( desviaciones => { console.log( desviaciones)});
      
})
