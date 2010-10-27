<?php

// short form of htmlspecialchars
function h($value) {
  return htmlspecialchars($value);
}

// returns the value of $key 
// this works both for GET and POST requests
// the value is sanitized to protect against
// xss attaacks

function params($key) {
  if (isset($_REQUEST[$key])) {
    $value = $_REQUEST[$key];
  } else
  {
    $value = "";
  }
  return h($value);
}

// wraps the $value in <td> and escapes the string
function show_cell($value) {
  $cell = "<td>" . h($value, ENT_QUOTES, 'UTF-8') ."</td>\n";        
  return $cell;
}
?>

