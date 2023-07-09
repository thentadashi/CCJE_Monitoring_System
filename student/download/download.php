<?php
// Set the content type and headers
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="Parent-Consent.docx"');

// Read the file and output its contents
readfile('Parent-Consent.docx');
?>
