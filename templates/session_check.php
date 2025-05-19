<?php
  switch(session_status()) {
    case PHP_SESSION_ACTIVE:
      session_start();
      echo '<script> alert("Session Not Active & Started"); </script>';
    
    case PHP_SESSION_NONE:
      echo '<script> alert("Session Already Active"); </script>';

  }
?>
