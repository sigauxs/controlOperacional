<?php
//prueb
//$url_count = strlen(__DIR__);
//$url = substr(__DIR__,0,($url_count-11));

$url_count = strlen(__DIR__);
$url = substr(__DIR__,0,($url_count-11));



require  $url . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($url);
$dotenv->load();


$mysqli = new mysqli($_ENV['HOSTNAME'], $_ENV['USERNAME'],$_ENV['PASSWORD'],$_ENV['BD_NAME']);

/* verificar la conexi��n */
if (mysqli_connect_errno()) {
    printf("Fall�� la conexi��n: %s\n", mysqli_connect_error());
    exit();
}

//printf("Conjunto de caracteres inicial: %s\n", $mysqli->character_set_name());

/* cambiar el conjunto de caracteres a utf8 */
if (!$mysqli->set_charset("utf8")) {
 //   printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
    exit();
} else {
 //   printf("Conjunto de caracteres actual: %s\n", $mysqli->character_set_name());
}

//$mysqli->close();

?>