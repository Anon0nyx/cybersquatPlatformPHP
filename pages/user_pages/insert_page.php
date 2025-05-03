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
    <div id="name_container">
      <textarea id="name_input" name="name_query" placeholder="Write name here"></textarea>
    </div> 
    <div id="age_container">
      <textarea id="age_input" placeholder="Age"></textarea> 
    </div>
    <div>
      <select id="state_input">
        <option value="">Select a State</option>
      </select>
    </div>
  <button type="submit" form="insertForm">Submit</button> 
  </form>
</body>

<script>
  document.getElementById('insertForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const nameInput = document.getElementById('name_input');
    const ageInput = document.getElementById('age_input');
    const stateInput = document.getElementById('state_input');

    const nameValue = nameInput.value;
    const ageValue = ageInput.value;
    const stateValue = stateInput.value;
    const insert = '1';
    try {
      const response = await fetch('../sql_query/query_processor.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ insert, nameValue, ageValue, stateValue })
      });
      const data = await response.json();
// Handle errors
      if (data.error) {
        alert(data.error);
      }
    } catch (err) {
    alert('An error occurred while processing your request.');
    }
  alert('Insert Query Successful');
  this.reset();
 });
  document.getElementById("age_input").addEventListener("input", function(){ 
    age_input.value = age_input.value.replace(/[^0-9]/g, "");
  });

//THANK YOU CHATGPT I DONT WANT TO WRITE ALL THE STATES
  const states = [
    "AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", 
    "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", 
    "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", 
    "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", 
    "WI", "WY"
  ];
  const select = document.getElementById("state_input");
  states.forEach(state => {
    const option = document.createElement("option");
    option.value = state;
    option.textContent = state;
    select.appendChild(option);
  });

</script>
