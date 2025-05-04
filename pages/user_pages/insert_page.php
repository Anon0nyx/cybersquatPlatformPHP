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
  
  <!-- DropDown for Insert/Update/Delete -->
  <form id="modify_selection">
    <select id="query_selection" onchange="toggleInfoPerSelect()">
       <option value="">Select Query Option</option>
    </select>
  </form>
  

  <!-- Form Input for Query -->
  <form id= "insertForm" method="post">
    <div id="id_container">
      <textarea id="id_input" style="display: none;" placeholder="Write ID for selection here"></textarea>
    </div>
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
    /*
      HANDLE SPECIFIC 
      FUNCTION;
      UPDATE/MODIFY/DELETE
    */
  const qOptions = ["INSERT", "MODIFY", "DELETE"];
 
  qOptions.forEach(qoption=> {
    const qSelect = document.createElement('option')
    qSelect.value = qoption;
    qSelect.textContent = qoption;
    qryVal.appendChild(qSelect);
  });
 
  //Only Display ID_INPUT when needed.
  //TO DO: Do Not Display NAME/AGE/STATE On Delete Query. Drop Down All Available Ids?
  function toggleInfoPerSelect() {
    var selected = document.getElementById("query_selection");
    var idShow = document.getElementById("id_input");
    
    if(selected.value === "MODIFY" || selected.value === "DELETE") {
      idShow.style.display = "block";
    } else {
      idShow.style.display = "none";
      }
  }

    



    /*
      HANDLE QUERY VALUES
      SEND TO query_processor.php
    */
  document.getElementById('insertForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const nameInput = document.getElementById('name_input');
    const ageInput = document.getElementById('age_input');
    const stateInput = document.getElementById('state_input');
    const crud = document.getElementById('query_selection');

    const crudValue = crud.value;
    const nameValue = nameInput.value;
    const ageValue = ageInput.value;
    const stateValue = stateInput.value;
    
    try {
      const response = await fetch('../sql_query/query_processor.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ crudValue, nameValue, ageValue, stateValue })
      });
      const data = await response.json();
// Handle errors
      if (data.error) {
        alert(data.error);
      } else {
        alert('Insert Query Successful');
      }
    } catch (err) {
    alert('An error occurred while processing your request.');
    }
    this.reset();
 });


/*
    AGE VALUE RESTRICTION
      NUMBER ONLY
*/
  document.getElementById("age_input").addEventListener("input", function(){ 
    age_input.value = age_input.value.replace(/[^0-9]/g, "");
  });


/*
    STATE DROP DOWN
    CONFIGURATION
*/
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
