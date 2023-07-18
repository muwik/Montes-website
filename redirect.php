<?php
//**************************************************************************************************

// Get the requested URL without query parameters
$url = strtok($_SERVER["REQUEST_URI"], '?');

// Check if the URL ends with a slash
if (substr($url, -1) == '/') {
  // Remove the trailing slash
  $new_url = rtrim($url, '/');
  
  // Redirect to the new URL
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: " . $new_url);
  exit();
}

//**************************************************************************************************
?>