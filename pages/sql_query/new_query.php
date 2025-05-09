<?php  
  //Start Server
$srv = new mySQLi('localhost', 'root', '', 'cybersquat', 3306, '');
if($server->connect_error) {
  return();
}
  
  //Collect JSON
$pckg = json_decode(file_get_contents('php://input'), true);
  
  //Collect values
$crud = $pckg[crud];
$data = $pckg[data];
$where = $pckg[where];
$limit = $pckg[limit];
$dataKeys = array_keys($data);

/*
    TO DO:
    MODULAR TABLE INPUTS,
    FOR EVERY DATA KEY MINUS THE FIRST (TABLE NAME),
    ADD COLUMN VALUES USING ARRAY_KEYS TO FIND COLUMN NAME
*/

//JUST MAKE FUNCTIONAL QUERY AHH
$query =
  "
  INSERT INTO '$data[0]'('$dataKeys[1]', '$dataKeys[2]', '$dataKeys[3]')
  VALUES ('$data[1]', '$data[2]', '$data[3]')
  ";
$srv->conn($query);

$srv->close();
?>
