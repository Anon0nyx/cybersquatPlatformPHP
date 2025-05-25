<?php  
  //Start Server
include '../../templates/session_check.php';
$srv = new mySQLi('localhost', 'root', '', 'cybersquat', 3306, '');
if($srv->connect_error) {
  die("CONNECTION ERROR");
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
//Which form?
  if(isset($_POST['create-user'])) {
    $un = htmlspecialchars($_POST['username']);
    $pw = htmlspecialchars($_POST['password']);
    $em = htmlspecialchars($_POST['email']);
    if(filter_var($em, FILTER_SANITIZE_EMAIL) && !preg_match("/\\s/",$un) && !empty($pw)) {
      $q = "INSERT INTO credentials (username, password, email) VALUES ('" . $un . "','" . $pw . "','" . $em . "');";
      $q2 = "INSERT INTO testing (name, age, state) VALUES ('" . $un . "', 999, 'PlcHld');";
      $srv->query($q);
      $srv->query($q2);
      //Add landing page and session cookies validating login
      
      header('Location: ../user_pages/user_page.php');
      exit();
    } else {
      //Placeholder fix for invalid inputs. Javascript would handle these more dynamically..
      header('Location: ../user_pages/user_creation.php');
      exit();
      }
  } elseif(isset($_POST['select-button'])) {
      $res = $srv->query("SELECT * FROM credentials");
        if($res instanceof mysqli_result) {
          $_SESSION['query-results'] = $res->fetch_all(MYSQLI_ASSOC);
          header('Location: ../user_pages/user_page.php');
          exit();
        }
    }
}
$srv->close();
?>
