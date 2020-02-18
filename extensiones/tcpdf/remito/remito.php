<?php
//CAPTURO LOS ELEMENTOS DEL REMITO QUE VIENEN POR VARIABLES GET


//FECHA
$dia = $_GET["dia"];
$mes = $_GET["mes"];
$ano = $_GET["ano"];
//ENCABEZADO

$partido = $_GET["partido"];
$municipio = $_GET["municipio"];
$organo = $_GET["organo"];
$establecimiento = $_GET["establecimiento"];
$cuit = $_GET["cuit"];
$tipo = $_GET["tipo"];
$cuposComedor = $_GET["cuposComedor"];
$cuposDmc= $_GET["cuposDmc"];

// CUERPO DEL REMITO
$cuerpoRemito= $_GET["cuerpoRemito"];


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->SetAutoPageBreak(false, 0);
		// set bacground image
	//	$img_file = K_PATH_IMAGES.'image_demo.jpg';
	//	$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		// restore auto-page-break status
		$this->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Agustin Guerra');
$pdf->SetTitle('Remito - Viejo Almacén');
$pdf->SetSubject('Viejo Almacén');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 24);

// add a page
$pdf->AddPage();

// Print a text
$fecha = '


<table>
<tr>
	<td style="width:200px">'.$dia.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$mes.'&nbsp;&nbsp;&nbsp;&nbsp;'.$ano.'</td>
</tr>



</table>



';


$pdf->writeHTML($fecha, false, false, false, false, '');


$encabezado = '
<table>


<tr><td></td></tr>
	<tr><td></td></tr>
	<tr>
		<td style="width:440px">Partido: '.$partido.'</td>
		
	</tr>
	<tr>
		<td style="width:440px">'.$municipio.'</td>
	</tr>

	<tr><td style="width:430px">'.$organo.'</td><td style="width:430px">'.$establecimiento.'</td></tr>
	
	<tr><td style="width:430px">'.$cuit.'</td><td style="width:430px">'.$tipo.'</td></tr>
	<hr>
	<tr><td style="width:430px">Cupos Comedor: '.$cuposComedor.'</td><td style="width:430px">Cupos DMC: '.$cuposDmc.'</td></tr>
	



</table><hr>
';
$pdf->writeHTML($encabezado, false, false, false, false, '');

$cuerpoRemito2 = explode(",", $cuerpoRemito);

$cuerpoFinal=array_chunk($cuerpoRemito2,3);

if(sizeof($cuerpoFinal) > 16){

$paginas = (floor(sizeof($cuerpoFinal) / 16))+1;

echo $paginas;

}else{

	$cuerpo = '';
	foreach($cuerpoFinal as $value){
		$cuerpo = $cuerpo.'<table>
		<tr>
		<td style="width:430px">'.$value[0].'</td>
		<td style="width:100px">'.$value[1].'</td>
		<td style="width:100px">'.$value[2].'</td>
		</tr></table>';	
	
	
	}
			
		$pdf->writeHTML($cuerpo, false, false, false, false, '');
	
	
}


	

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('remito.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
