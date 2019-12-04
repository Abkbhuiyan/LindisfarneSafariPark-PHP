<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "","lindisfarne_safari_park");
$query = "SELECT * from animal";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows ($ret);
$doc = new DOMDocument();
$doc->formatOutput = true;
$root = $doc->createElement("Animals");
$doc->appendChild($root);

for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_array ($ret,MYSQLI_ASSOC);

    $node = $doc->createElement( "Animal" );	

    $animalId = $doc->createElement( "animalId" );
	$sectionName = $doc->createElement( "sectionName" );  
	$animalName = $doc->createElement( "animalName" );
	$pic = $doc->createElement( "pic" ); 
	$about = $doc->createElement( "about" );  
	$howMuch = $doc->createElement( "howMuch" );

	
	$animalId->appendChild($doc->createTextNode($row["animalId"]));
    $sectionName->appendChild($doc->createTextNode($row["sectionName"]));
    $animalName->appendChild($doc->createTextNode($row["animalName"]));
    $pic->appendChild($doc->createTextNode($row["pic"]));
    $about->appendChild($doc->createTextNode($row["about"]));
    $howMuch->appendChild($doc->createTextNode($row["howMuch"]));


	
	$node->appendChild($animalId);       
    $node->appendChild($sectionName);
    $node->appendChild($animalName);       
    $node->appendChild($pic);
    $node->appendChild($about);       
    $node->appendChild($howMuch);
  

	
	
    $root->appendChild($node);
}

echo $doc->saveXML();
?>