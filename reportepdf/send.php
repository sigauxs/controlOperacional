	<script>
	let para =  'jsalgadoecheverria@gmail.com';
      let copia = 'j.andres_2124@hotmail.com';
      let link =  'http::///hola mundo'
      let idIns = 12;

      const fetchSenEmail = async (to,cc,link,idIns) => {

     let _datos = {
        to: to,
        cc: cc, 
        link:link,
        idIns:idIns
}
const options = {
  method: 'POST',
  headers: {
              'Content-Type': 'application/json',
            },
            body:JSON.stringify(_datos)
};

var url = `https://sigpesendmail.herokuapp.com/api/send-email`;

console.log(url);
const response = await fetch(url, options);
const data = await response.json();

return data;

}

fetchSenEmail(para,copia,link,idIns).then(resp => console.log(resp) )
	
	
	</script>
	