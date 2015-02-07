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

// Kreiraj objekti od pomosni klasi
$auth = new Auth;

// Povrzi se so bazata
$db = mysql_connect("localhost","root", "usbw") or die('Can not connect to database') ;
mysql_select_db("osiguritelna_kompanija") or die('Can not select db "osiguritelna_kompanija" ');
