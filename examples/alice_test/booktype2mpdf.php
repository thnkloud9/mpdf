<?php

$file_input  = "alice-in-wonderland.html";
$file_output = "output.pdf";
//$file_output = "unprocessed.pdf";

/* Include mPDF library */
require_once __DIR__ . '/../../vendor/autoload.php';

/* Read content */
$html = file_get_contents($file_input);

/* Create PDF */
$mpdf = new mPDF();

// Specify whether to substitute missing characters in UTF-8 (multibyte) documents
$mpdf->useSubstitutions = false;
//Disables complex table borders etc. to improve performance
$mpdf->simpleTables = true;
// Don't generate Table of Contents from H elements, we use Booktype's ToC with sections and chapters
$mpdf->h2toc = array();
// Generate PDF bookmarks from H elements
$mpdf->h2bookmarks = array('H1' => 0, 'H2' => 1, 'H3' => 2);

/* Add Styling */
if (file_exists("style.css")) {
    $css_data = file_get_contents("style.css");
    $mpdf->WriteHTML($css_data, 1);
}

$mpdf->WriteHTML($html);
$mpdf->Output($file_output);
//$mpdf->Output();
exit;
