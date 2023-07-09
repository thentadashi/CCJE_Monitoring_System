<?php

$file = $_GET['file'];

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

header('Content-Disposition: attachment; filename="' . basename($file) . '"');

readfile($file);
?>