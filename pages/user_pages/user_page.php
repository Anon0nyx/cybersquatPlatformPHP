<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Interface Page</title>
	<link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>
<body>
	<?php include '../../templates/navbar.php'; ?>
	<main>
		<h1> PlaceHolder PlaceHolder </h1>
			<form method="post" id="select-form">
				<button id="select-button">Select All</button>
			</form>
		<div id="results-container" class="hidden" style="margin-bottom: 50px;">
			<h2> Results </h2>
			<div id="table-schema"></div>
			<div id="table-data"></div>
		</div>
	</main>
</body


<!-- some shit dylan found (with bad tabbing) -->
    <script>
        // Get the query from CodeMirror or textarea
  document.getElementById("select-form").addEventListener('submit', async function (e) { 
	e.preventDefault();
		const query = "SELECT * FROM testing";
        // Send the query to the server
        try {
            const response = await fetch('./sql_query/query_processor.php', {
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
