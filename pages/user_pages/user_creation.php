<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Insertion Page </title>
  <link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>

<body>
  <h1> User Creation Page </h1>
  <!-- NAVBAR -->
  <?php include '../../templates/navbar.php'; ?>
  <!-- Form Input for Query -->
  <form id= "userCreation" method="post">
      <div id="user_container">
        <textarea id="username" placeholder="Username"></textarea>
      </div>
      <div id="name_container">
        <textarea id="password" placeholder="Password"></textarea>
      </div> 
      <div id="age_container">
        <textarea id="email" placeholder="Email"></textarea> 
      </div>
      <button type="submit" form="userCreation">Create User</button> 
    </form>
  </body>
<script>


//Create submit function to query_processor.php
  document.getElementById("userCreation").addEventListener('submit', async function (e) {
  e.preventDefault();
    const unID = document.getElementById("username");
    const pwID = document.getElementById("password");
    const emID = document.getElementById("email");
    const un = unID.value;
    const pw = pwID.value;
    const em = emID.value;
    const crudValue = "newUser";
    
    try {
      const response = await fetch('../sql_query/query_processor.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ crudValue, un, pw, em })
      });
      const data = await response.json();

      if(data.error) {
        alert(data.error);
      } else {
        alert('User Created Successfully');
      }
    } catch(err) {
        alert('An error occured.');
    }
    this.reset();
  });



</script>
