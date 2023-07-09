<?php
// Set the content type and headers
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="Personal_data_Sheet.docx"');

// Read the file and output its contents
readfile('Personal_data_Sheet.docx');
?>
