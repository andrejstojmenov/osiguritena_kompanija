<?php

// Startuvaj sesija
session_start();

// Vlkuci pomosni funckii
require ('functions.php');

// Vkluci pomosni klasi
foreach (glob("classes/*.php") as $filename)
{
	include $filename;
}
include 'fpdf17/fpdf.php';
include 'tfpdf/tfpdf.php';

// Kreiraj objekti od pomosni klasi
$auth = new Auth();
$pdf=new FPDF();
$tpdf=new tFPDF();


// Povrzi se so bazata
$db = mysql_connect("localhost","root", "usbw") or die('Can not connect to database') ;
mysql_select_db("osiguritelna_kompanija") or die('Can not select db "osiguritelna_kompanija" ');
