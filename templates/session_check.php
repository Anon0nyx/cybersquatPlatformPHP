<?php
if(session_status() === PHP_SESSION_NONE) {
  session_set_cookie_params([ 
    'lifetime' => 30,
    'path' => '/',
    'domain' => ''
   // 'secure' => true,
   // 'httponly' => true
  ]);
  session_start();
 //$_SESSION['authorization'] = "not_logged";
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
