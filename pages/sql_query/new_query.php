<?php  
  //Start Server
$srv = new mySQLi('localhost', 'root', '', 'cybersquat', 3306, '');
if($srv->connect_error) {
  die("CONNECTION ERROR");
}
  
  //Collect JSON
$pckg = json_decode(file_get_contents('php://input'), true);
if(!$pckg) {
die("Invalid JSON");
}
  //Collect values
$crud = $pckg['crud'];
$where = $pckg['where'] ?? null;
$limit = $pckg['limit'] ?? null;
/*
    TO DO:
    MODULAR TABLE INPUTS,
    FOR EVERY DATA KEY MINUS THE FIRST (TABLE NAME),
    ADD COLUMN VALUES USING ARRAY_KEYS TO FIND COLUMN NAME
*/
  //INSERT = xxxxx
  //DELETE = xxxxx
if($crud === "00100101") {
  $data = $pckg['data'];
  $dataKeys = array_keys($data);
  $query =
    "INSERT INTO ". $data['table'] . " (" . $dataKeys[1] . "," . $dataKeys[2] . "," . $dataKeys[3] . ") VALUES ('" . $data['username'] . "','" . $data['password'] . "','" . $data['email'] . "');";
  echo "<h1>" . $query . "</h1>";
  $srv->query($query);
    if($data['table'] == "credentials") {
      $query2 = "INSERT INTO testing (name) VALUES ('" . $data['username'] . "', 999, 'PlcHL');";
    $srv->query($query2);
    }
} elseif($crud === "001100110") {
$query = "SELECT * FROM testing";
$result = $srv->query($query);
  $response = ['schema' => '', 'data' => '', 'error' => ''];
  if ($result instanceof mysqli_result) {
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
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
$srv->close();
?>
