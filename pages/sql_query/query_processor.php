<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'cybersquat', 3306, '');

// Check connection
if ($conn->connect_error) {
  die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Initialize response array
$response = ['schema' => '', 'data' => '', 'error' => ''];
$insert = $_POST['insert'] ?? null;
$nameValue = $_POST['nameValue'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (!empty($_POST['insert']) && !empty($_POST['nameValue'])) {
    $nameValue = $conn->real_escape_string($_POST['nameValue']);  // Prevent SQL injection
    $query = "INSERT INTO testing (name, age, state) 
              VALUES ('$nameValue', 999, 'PLACEHOLDER');";
  $conn->query($query);
} else if (!empty($_POST['query'])) {
    $query = $_POST['query'];
    $result = $conn->query($query);

    if ($result) {
      // Handle SELECT queries that return result sets
      if ($result instanceof mysqli_result) {
        /*
           IN HERE WE NEED TO ADD LOGIC TO HANDLE
           DIFFERENT SQL SERVER RESPONSES - IE
           INSERTING DATA
           DELETING DATA
           UPDATING DATA
         */
        // Build the schema table
        $schemaHtml = '<table><thead><tr><th>Column</th><th>Type</th><th>Key</th></tr></thead><tbody>';
        foreach ($result->fetch_fields() as $field) {
          $schemaHtml .= '<tr>';
          $schemaHtml .= '<td>' . htmlspecialchars($field->name) . '</td>';
          $schemaHtml .= '<td>' . htmlspecialchars($field->type) . '</td>';
          $schemaHtml .= '<td>' . ($field->flags & MYSQLI_PRI_KEY_FLAG ? 'Primary Key' : 'None') . '</td>';
          $schemaHtml .= '</tr>';
        }
        $schemaHtml .= '</tbody></table>';
        $response['schema'] = $schemaHtml;

        // Build the data table
        $dataHtml = '<table><thead><tr>';
        while ($field = $result->fetch_field()) {
          $dataHtml .= '<th>' . htmlspecialchars($field->name) . '</th>';
        }
        $dataHtml .= '</tr></thead><tbody>';
        while ($row = $result->fetch_assoc()) {
          $dataHtml .= '<tr>';
          foreach ($row as $cell) {
            $dataHtml .= '<td>' . htmlspecialchars($cell) . '</td>';
          }
          $dataHtml .= '</tr>';
        }
        $dataHtml .= '</tbody></table>';
        $response['data'] = $dataHtml;
      } else if ($conn->affected_rows > 0) { // This will tell us if we are using UPDATE/INSERT/DELETE 
        // Non-SELECT query result
        $response['data'] = '<p>Query executed successfully.</p>';
        $response['schema'] = '<p>No schema available for this query.</p>';
      } else {
        $response['data'] = '<p>No rows were affected</p>';
        $response['schema'] = '<p>Broken query</p>';
      }
    } else {
      // Query execution error
      $response['error'] = 'Error: ' . htmlspecialchars($conn->error);
    }
  } else {
    $response['error'] = 'No query provided!';
  }
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
