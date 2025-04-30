<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SQL Query Executor</title>
  <link rel="stylesheet" href="../stylesheets/sql_query.css">

  <!-- CodeMirror Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/codemirror.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.12/mode/sql/sql.min.js"></script>
</head>
<body>
  <?php include '../templates/navbar.php'; ?>
  <main>
    <h1>SQL Query Executor</h1>

    <!-- Query Form -->
    <form method="post" id="query-form">
      <?php include 'query_area.php'; ?>
      <button type="submit">Run Query</button>
    </form>

    <!-- Placeholder for dynamic table results -->
    <div id="results-container" class="hidden" style="margin-bottom: 50px;">
      <h2>Query Results</h2>
      <div id="table-schema"></div>
      <div id="table-data"></div>
    </div>
  </main>

  <!-- THIS SHIT IS NOT MINE BELOW BUT IT GIVE US SYNTAX HIGHLIGHTING SO WHOO -->
  <script>
    document.getElementById('query-form').addEventListener('submit', async function (e) {
    e.preventDefault(); // Prevent default form submission

    // Get the query from CodeMirror or textarea
    const queryEditor = document.getElementById('query-editor');
    const query = queryEditor.value;

    // Send the query to the server
    try {
      const response = await fetch('query_processor.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ query })
      });

      const data = await response.json();

      // Handle errors
      if (data.error) {
        alert(data.error);
      } else {
        // Update schema and data tables
        document.getElementById('table-schema').innerHTML = data.schema || '<p>No schema available.</p>';
        document.getElementById('table-data').innerHTML = data.data || '<p>No data available.</p>';

        // Show the results container
        document.getElementById('results-container').classList.remove('hidden');
      }
    } catch (err) {
    console.error('Error fetching query results:', err);
    alert('An error occurred while processing your request.');
  }
});
</script>
    <style>
      /* Styling for results container */
      .hidden {
        display: none;
      }

      #results-container {
        margin-top: 20px;
        padding: 20px;
        width: 90%;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      #results-container h2 {
        color: #444;
      }
    </style>
  </body>
</html>
