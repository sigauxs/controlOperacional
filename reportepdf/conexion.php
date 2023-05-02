<?php

//$mysqli = new mysqli("localhost", "admincp", "sigpe2022", "cpoperacional");
$mysqli = new mysqli($_ENV['HOSTNAME'], $_ENV['USERNAME'],$_ENV['PASSWORD'],$_ENV['BD_NAME']);

/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
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