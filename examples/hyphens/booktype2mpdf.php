<?php

$file_input  = isset($argv[1]) ? $argv[1] : "input.html";
$file_output = isset($argv[2]) ? $argv[2] : "output.pdf";
$file_style = isset($argv[3]) ? $argv[3] : "style.css";

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

// ----  added to process hyphen testing -----
// set language for correct hyphenation
$mpdf->SHYlang = "de";
// MARK added these, they are set in the main config.php
$mpdf->SHYleftmin = 4;
$mpdf->SHYrightmin = 2;
$mpdf->SHYcharmin = 2;
$mpdf->SHYcharmax = 10;
// end MARK added
$mpdf->defaultCSS['BODY']['HYPHENS'] = 'auto';
$mpdf->defaultCSS['TABLE']['HYPHENS'] = 'auto';
$mpdf->defaultCSS['P']['HYPHENS'] = 'auto';

/* Add Styling */
if (file_exists($file_style)) {
    $css_data = file_get_contents($file_style);
    $mpdf->WriteHTML($css_data, 1);
}

$mpdf->WriteHTML($html);

$mpdf->Output($file_output);
//$mpdf->Output();
exit;
