<?php

function flash_message($type, $message) {
        $_SESSION['message'] = array('type' => $type, 'message' => $message);
}


?>