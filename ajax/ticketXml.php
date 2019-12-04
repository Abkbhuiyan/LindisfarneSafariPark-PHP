<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "","lindisfarne_safari_park");
$query = "SELECT * from ticket";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows ($ret);
$doc = new DOMDocument();
$doc->formatOutput = true;
$root = $doc->createElement("Tickets");
$doc->appendChild($root);

for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_array ($ret,MYSQLI_ASSOC);

    $node = $doc->createElement( "Ticket" );	

    $ticketType = $doc->createElement( "ticketType" );
	$eventName = $doc->createElement( "eventName" );  
	$description = $doc->createElement( "description" );

	$numberOfTickets = $doc->createElement( "numberOfTickets" );  
	$unitPrice = $doc->createElement( "unitPrice" );

	
	$ticketType->appendChild($doc->createTextNode($row["ticketType"]));
    $eventName->appendChild($doc->createTextNode($row["eventName"]));
    $description->appendChild($doc->createTextNode($row["description"]));
    $numberOfTickets->appendChild($doc->createTextNode($row["numberOfTickets"]));
    $unitPrice->appendChild($doc->createTextNode($row["unitPrice"]));


	
	$node->appendChild($ticketType);       
    $node->appendChild($eventName);
    $node->appendChild($description);       
    $node->appendChild($numberOfTickets);       
    $node->appendChild($unitPrice);
  

	
	
    $root->appendChild($node);
}

echo $doc->saveXML();
?>