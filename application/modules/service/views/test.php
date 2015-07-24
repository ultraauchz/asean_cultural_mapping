<?php
require_once("application/libraries/mpdf/mpdf.php");
$stylesheet = file_get_contents("css/bootstrap.min.css");
ob_start();
?>
<h1>Hahaha</h1>
<?php
$html = ob_get_contents();
$pdf = new mPDF('th', 'A4', '0', '');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
?>
<div style="text-align: left;"><?php $pdf->WriteHTML($stylesheet, 1);?></div>
<div style="text-align: left;"><?php $pdf->WriteHTML($html, 2);?></div>
<?php
$pdf->Output();