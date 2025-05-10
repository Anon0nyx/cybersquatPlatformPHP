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
$data = $pckg['data'];
$where = $pckg['where'];
$limit = $pckg['limit'];
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
  INSERT INTO `{$data['table']}`(`{$dataKeys[1]}`, `{$dataKeys[2]}`, `{$dataKeys[3]}`)
  VALUES ('{$data['username']}', '{$data['password']}', '{$data['email']}');
  ";
$srv->query($query);
if(!$srv->query($query)) {
  die("Query Failed " . $srv->error);
}

$srv->close();
?>
