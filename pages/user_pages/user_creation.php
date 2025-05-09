<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../../templates/navbar.php'; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Insertion Page </title>
  <link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>

<body>
  <h1> User Creation Page </h1>
  <!-- NAVBAR -->
  <!-- Form Input for Query -->
  <form id= "userCreation" method="post">
      <div id="user_container">
        <textarea id="username" name="username" placeholder="Username"></textarea>
      </div>
      <div id="name_container">
        <textarea id="password" name="password" placeholder="Password"></textarea>
      </div> 
      <div id="age_container">
        <textarea id="email" name="email"  placeholder="Email"></textarea> 
      </div>
      <button type="submit" form="userCreation">Create User</button> 
    </form>
  </body>

<script>
//Create: submit: function to new_query.php
  document.getElementById("userCreation").addEventListener('submit', async function (event) {
  event.preventDefault();
    const un = document.getElementById("username").value;
    const pw = document.getElementById("password").value;
    const em = document.getElementById("email").value;
    if(un != "" && pw != "" && em != "") {
      let pckg = {
        crud: "VIEW",
              //table name: value, column1: value, column2: value etc...
        data: { table: "credentials", username: un, password: pw, email: em },
        where: false,
        limit: false
      };
      try {
        const response = await fetch('../sql_query/new_query.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(pckg)
        });
      } catch(err) {
          alert('An error occured.');
      }
      event.target.reset();
      alert('Post Submitted');
    } else {
      alert('You are missing an input!');
   }
  });
</script>

