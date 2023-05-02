<?php 
$url_count = strlen(__DIR__);
$url = substr(__DIR__,0,($url_count-11));


require  $url . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($url);
$dotenv->load();

class Conexion extends PDO {




public function __construct()
{

try {

     parent::__construct('mysql:host='.$_ENV['HOSTNAME'].
                        ';dbname='   .$_ENV['BD_NAME'].
                        ';charset=utf8',
                        $_ENV['USERNAME'],
                        $_ENV['PASSWORD'],
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

}catch(PDOException $e){

    echo "error: ". $e->getMessage();
}
    
}




}

?>