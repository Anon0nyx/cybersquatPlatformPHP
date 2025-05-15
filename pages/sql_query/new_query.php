<?php  
  //Start Server
$srv = new mySQLi('localhost', 'root', '', 'cybersquat', 3306, '');
if($srv->connect_error) {
  die("CONNECTION ERROR");
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
//Which form?
  if(isset($_POST['create-user'])) {
    $un = $_POST['username'];
    $pw = $_POST['password'];
    $em = $_POST['email'];
    if(filter_var($em, FILTER_SANITIZE_EMAIL) && !preg_match("/\\s/",$un) && !empty($pw)) {
      $q = "INSERT INTO credentials (username, password, email) VALUES ('" . $un . "','" . $pw . "','" . $em . "');";
      $q2 = "INSERT INTO testing (name, age, state) VALUES ('" . $un . "', 999, 'PlcHld');";
      $srv->query($q);
      $srv->query($q2);
      //Add landing page and session cookies validating login
      header('Location: ../user_pages/user_page.php');
    } else {
      //Placeholder fix for invalid inputs. Javascript would handle these more dynamically..
      header('Location: ../user_pages/user_creation.php');
      }
  }
}
$srv->close();
?>
