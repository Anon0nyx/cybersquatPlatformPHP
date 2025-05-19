<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../../templates/session_check.php'; ?>
  <?php include '../../templates/navbar.php'; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Insertion Page </title>
  <link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>

<body>
  <!-- Form Input for Query -->
  <form action="../sql_query/new_query.php" id="userCreation" method="POST">
      <div id="user_container">
        <textarea type="text" id="username" name="username" placeholder="Username: No Spaces"></textarea>
      </div>
      <div id="name_container">
        <textarea type="password" name="password" placeholder="Password"></textarea>
      </div> 
      <div id="age_container">
        <textarea type="email" name="email"  placeholder="Email: Valid Format"></textarea> 
      </div>
      <button type="submit" form="userCreation" name="create-user" value="TESTVALUE">Create User</button> 
    </form>
  </body>

