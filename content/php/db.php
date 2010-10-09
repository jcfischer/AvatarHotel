<?php

// Database module for IN, Week6, HA
// jcf, 9.10.2010
//

$dsn = "flamingo";
$dbConn = "";
$dbResult = "";

 
function open_db() {
  global $dsn, $dbConn;
  $dbConn = odbc_connect($dsn, "","");
  return true;
}

function close_db() {
  global $dbConn;
  odbc_close($dbConn);
}

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
  while (list($key,$value) = each($values)) {
    $insert = $key . "='" . $value . "'";
    array_push($inserts, $insert );
  }
  $sql .= implode(", ", $inserts);
  $sql .= " WHERE " . $primary_key . "='" . $id . "'";
  $dbResult = odbc_exec($dbConn, $sql);
}

// insert a new row into table with $values
// with $values
function insert_row($table, $values) {
  global $dbConn, $dbResult;
  $sql = "INSERT INTO " . $table . " ";
  $columns = array();
  $vals = array();
  while (list($key,$value) = each($values)) {
    array_push($columns, $key);
    array_push($vals, "'" . $value . "'");
  }
  $sql .= "(" . implode(", ", $columns) . ") ";
  $sql .= " VALUES (" . implode(", ", $vals) . ")";
  // echo $sql;
  $dbResult = odbc_exec($dbConn, $sql);
}

function delete_row($table, $primary_key, $id) {
  global $dbConn, $dbResult;
  $sql = "DELETE FROM " . $table . " WHERE " . $primary_key . "='" . $id ."'";
  $dbResult = odbc_exec($dbConn, $sql);
}

function next_row() {
  global $dbResult;
  return odbc_fetch_row($dbResult);
}

function get_column_value($column) {
  global $dbResult;
  return odbc_result($dbResult, $column);
}

?>
