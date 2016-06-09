<?php
  
//==============================================================
//==============================================================
//==============================================================

require_once __DIR__ . '/../../vendor/autoload.php';

$mpdf = new mPDF();

$mpdf->SetDisplayMode('fullpage');

// LOAD HTML and a stylesheet
$stylesheet = file_get_contents('mpdfstylePaged.css');
$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$html = file_get_contents('body.htm');
$mpdf->WriteHTML($html);

$mpdf->Output();

exit;
//==============================================================
//==============================================================
//==============================================================

  

