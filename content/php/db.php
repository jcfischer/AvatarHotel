<?php

// Database module for IN, Week6, HA
// jcf, 9.10.2010 - 13.10.2010
//

include("dbinfo.php");

// these are global variables. I'm not happy with this design
// choice but don't know enough PHP to make a proper object that
// encapsulates this knowledge. Maybe week 7 will have the answer?
$dbConn = "";
$dbResult = "";


// open the database and store a reference to it in $dbConn
function open_db() {
  global $dsn, $dbConn;
  $dbConn = odbc_connect($dsn, "","");
  if ($dbConn == FALSE) {
    return false;
  } else {
    return true;
  }
}

// close the db
function close_db() {
  global $dbConn;
  odbc_close($dbConn);
}

// lista all rows in table, using the $order 

function list_rows($table, $order) {
  global $dbConn, $dbResult;

  $sql = "select * from " . $table . " ORDER BY " . $order;
  $dbResult = odbc_exec($dbConn, $sql);
  return odbc_num_rows($dbResult);
}

// selects one row 
// returns TRUE or FALSE depending on if row was found
// use 'get_column_value' to get a result columns
function select_row($table, $column, $value) {
  global $dbConn, $dbResult;
  $sql = "select * from " . $table . " WHERE " . $column . " = '" . $value . "'";
  $dbResult = odbc_exec($dbConn, $sql);
  $res = odbc_fetch_row($dbResult);
  return $res;
}

// updates the row selected by $id (in column $key)
// with $values
function update_row($table, $primary_key, $id, $values) {
  global $dbConn, $dbResult;
  $sql = "UPDATE " . $table . " SET ";
  $inserts = array();
  while (list($key,$data_description) = each($values)) {
    $type = $data_description['type'];
    $value = $data_description['value'];
    $value_sql = quote_value($type, $value);
    $insert = $key . "=" . $value_sql;
    array_push($inserts, $insert );
  }
  $sql .= implode(", ", $inserts);
  $sql .= " WHERE " . $primary_key . "='" . $id . "'";
  // echo $sql;
  $dbResult = odbc_exec($dbConn, $sql);
  return $dbResult;
}



// insert a new row into table with $values
// with $values
function insert_row($table, $values) {
  global $dbConn, $dbResult;
  $sql = "INSERT INTO " . $table . " ";
  $columns = array();
  $vals = array();
  while (list($key,$data_description) = each($values)) {
    $type = $data_description['type'];
    $value = $data_description['value'];
    $value_sql = quote_value($type, $value);
    array_push($columns, $key);
    array_push($vals, $value_sql);
  }
  $sql .= "(" . implode(", ", $columns) . ") ";
  $sql .= " VALUES (" . implode(", ", $vals) . ")";
  // echo $sql;
  $dbResult = odbc_exec($dbConn, $sql);
}

// quotes the $value if it's a string
function quote_value($type, $value) {
  $val = "";
  if($type == 'string') {
    $val = "'" . $value . "'";
  } else {
    $val = $value; 
  }
  return $val;
}

// delete a row from $table where $primary_key = $id
//
function delete_row($table, $primary_key, $id) {
  global $dbConn, $dbResult;
  $sql = "DELETE FROM " . $table . " WHERE " . $primary_key . "='" . $id ."'";
  $dbResult = odbc_exec($dbConn, $sql);
}

// fetch the next row of a result set
function next_row() {
  global $dbResult;
  return odbc_fetch_row($dbResult);
}


// return the value of a specific column in a result
function get_column_value($column) {
  global $dbResult;
  return odbc_result($dbResult, $column);
}

?>

