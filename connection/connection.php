<?php 


class Conexion extends PDO {


    private $hostname = "sigpeco.sigpeconsultores.com.co";
    private $bd_name = "cpoperacional";
    private $username =  "admincp";
    private $password =  "sigpe2022";

public function __construct()
{

try {

    parent::__construct('mysql:host='.$this->hostname.
                        ';dbname='   .$this->bd_name.
                        ';charset=utf8',
                        $this->username,
                        $this->password,
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

}catch(PDOException $e){

    echo "error: ". $e->getMessage();
}
    
}




}

?>