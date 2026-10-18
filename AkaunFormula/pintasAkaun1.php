<?php
// Path to the PDF
$file = 'files/sample.pdf';

// Check if the file exists
if (file_exists($file)) {

    // Decide behavior: "inline" or "attachment"
    $action = isset($_GET['action']) && $_GET['action'] === 'download' ? 'attachment' : 'inline';

    // Set headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: ' . $action . '; filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));
    header('Cache-Control: public, must-revalidate, max-age=0');
    header('Pragma: public');

    // Output the PDF
    readfile($file);
    exit;
} else {
    echo "File not found.";
}
?>
