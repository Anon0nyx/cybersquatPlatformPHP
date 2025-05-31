<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
  $_SESSION['authorization'] = "logged";
  include '../../templates/session_check.php'; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Insertion Page </title>
  <link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>

<body>
            <!-- NAVBAR -->
  <?php include '../../templates/navbar.php'; ?>

  <h1> Log-In Page </h1> 

                          <!-- User Login -->
  <form id= "loginForm" method="post" action="../sql_query/new_query.php">
    <div id="id_container">
      <textarea id="user_input" name="username" placeholder="Username:"></textarea>
    </div>
    <div id="pass_container">
      <textarea id="pass_input" name="password" placeholder="Password:"></textarea>
    </div>
    <button name="login_button">Log In</button>
  </form>
</body>
