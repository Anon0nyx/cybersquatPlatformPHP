<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Insertion Page </title>
  <link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>

<body>
  <h1> Insert User Data Here </h1>
  <!-- NAVBAR -->
  <?php include '../../templates/navbar.php'; ?>
  <form id= "insertForm" action="../sql_query.php" method="post">
    <div id="name-container">
      <textarea id="name_input" name="name_query" placeholder="Write name here"></textarea>
    </div> 
  <button type="submit" form="insetForm">Submit</button> 
  </form>
</body>
