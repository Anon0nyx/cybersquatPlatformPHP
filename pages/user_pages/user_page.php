<!DOCTYPE html>
<?php include '../../templates/session_check.php'; ?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Interface Page</title>
	<link rel="stylesheet" href="../../stylesheets/sql_query.css">
</head>
<body>
	<?php include '../../templates/navbar.php'; ?>
	<main>
		<h1> Interactive User Page </h1>
			<form method="POST" name="select-form" action="../sql_query/new_query.php">
				<button name="select-button">Select All</button>
			</form>
		<div id="results-container" class="hidden" style="margin-bottom: 50px;">
			<h2> Results </h2>
			<div id="table-schema"></div>
			<div id="table-data"></div>
		</div>
	</main>
</body>

