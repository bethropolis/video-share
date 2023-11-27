<?php
require 'config.php'; // Include config file
// Get the file path from the URL parameter and validate it as a string
$path_file = filter_input(INPUT_GET, 'path', FILTER_SANITIZE_STRING);
// prevent directory traversal
$path_file = str_replace('../', '', $path_file);


$file = VIDEOS_FOLDER . '/' . $path_file;


// Check if the file exists and is readable
if (file_exists($file) && is_readable($file)) {
  // Remove any previously set headers
  header_remove();
  // Set headers for download
  header('Content-Description: File Transfer');
  header('Content-Type: ' . mime_content_type($file)); // Set Content-Type based on file's MIME type
  header('Content-Disposition: attachment; filename="' . basename($file) . '"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($file));
  // Clear the output buffer and flush the system output buffer
  ob_clean();
  flush();
  // Output the file
  readfile($file);
  // Check if the user canceled the download
  if (connection_aborted()) {
    // User canceled the download
    echo "Download canceled. 😔";
    exit(); // Terminate the script
  }
} else {
  // File not found
  echo "File not found. 😢";
  exit(); // Terminate the script
}
?>
