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
  <form id= "insertForm" method="post">
    <div id="name-container">
      <textarea id="name_input" name="name_query" placeholder="Write name here"></textarea>
    </div> 
  <button type="submit" form="insertForm">Submit</button> 
  </form>
</body>

<script>
  document.getElementById('insertForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const nameInput = document.getElementById('name_input');
    const nameValue = nameInput.value;
    const insert = '1';
    try {
      const response = await fetch('../sql_query/query_processor.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ insert, nameValue })
      });
      const data = await response.json();
// Handle errors
      if (data.error) {
        alert(data.error);
      }
    } catch (err) {
    alert('An error occurred while processing your request.');
    }
 });

</script>
