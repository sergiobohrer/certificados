<?php
if ( ! isset( $_GET['id'] ) || empty( $_GET['id'] ) ) {
    die( 'Uso indevido.' );
}

require_once( 'fpdf.php' );
require_once( 'model/model.php' );

$result = getParticipant( $_GET['id'] );

if ( $result == false ) {
    die( utf8_decode( 'participante não encontrado.' ) );
}

$widthCertificate = 297;
$heightCertificate = 210;

$text1 = 'Certificamos que _______________________________________________ participou do';
$text2 = 'I CONFERÊNCIA DE DESENVOLVIMENTO WEB, realizado em Volta Redonda - RJ, com duração';
$text3 = 'de 10 (dez) horas.';

$date = 'Volta Redonda, 21 de Março de 2015';

$orgLine = "__________________________________";
$orgFunc = "Organizador";

$org1name = "Afonso França de Oliveira";
$org2name = "Sérgio Bohrer Reis";

$pdf = new FPDF( 'L', 'mm', 'A4' );
$pdf->SetTextColor( 0, 0, 0 );

$pdf->AddPage();
$pdf->Image( 'img/certificado.png', 0, 0, $widthCertificate, $heightCertificate, 'PNG' );

$pdf->SetFont( 'helvetica', 'B', 50 );
$pdf->Text( ( $widthCertificate / 2 ) - 60, 93, 'CERTIFICADO' );

// Text
$pdf->SetFont( 'helvetica', '', 17 );
$pdf->Text( 27, 115, utf8_decode( $text1 ) );
$pdf->Text( 16, 125, utf8_decode( $text2 ) );
$pdf->Text( 128, 135, utf8_decode( $text3 ) );

// Participant
$pdf->SetFont( 'helvetica', 'B', 20 );
$pdf->Text( 80, 114, utf8_decode( $result['nome'] ) );

// Date
$pdf->SetFont( 'helvetica', '', 15 );
$pdf->Text( 180, 147, utf8_decode( $date ) );

// Organization1
$pdf->SetFont( 'helvetica', '', 15 );
$pdf->Text( 20, 175, $orgLine );
$pdf->Text( 39, 181, utf8_decode( $org1name ) );
$pdf->Text( 53, 187, utf8_decode( $orgFunc ) );

$pdf->Text( 175, 175, $orgLine );
$pdf->Text( 202, 181, utf8_decode( $org2name ) );
$pdf->Text( 210, 187, utf8_decode( $orgFunc ) );

$pdf->Output( 'certificado','I' );