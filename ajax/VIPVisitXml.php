<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "","lindisfarne_safari_park");
$query = "SELECT * from VIPVisit";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows ($ret);
$doc = new DOMDocument();
$doc->formatOutput = true;
$root = $doc->createElement("VIPVisits");
$doc->appendChild($root);

for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_array ($ret,MYSQLI_ASSOC);

    $node = $doc->createElement( "Visit" );	

    $eventId = $doc->createElement( "eventId" );
	$eventName = $doc->createElement( "eventName" );  
	$eventDesc = $doc->createElement( "eventDesc" );
	$eventPic = $doc->createElement( "eventPic" ); 
	$includes = $doc->createElement( "includes" );  
	$eventStartDate = $doc->createElement( "eventStartDate" );

	
	$eventId->appendChild($doc->createTextNode($row["eventId"]));
    $eventName->appendChild($doc->createTextNode($row["eventName"]));
    $eventDesc->appendChild($doc->createTextNode($row["eventDesc"]));
    $eventPic->appendChild($doc->createTextNode($row["eventPic"]));
    $includes->appendChild($doc->createTextNode($row["includes"]));
    $eventStartDate->appendChild($doc->createTextNode($row["eventStartDate"]));


	
	$node->appendChild($eventId);       
    $node->appendChild($eventName);
    $node->appendChild($eventDesc);       
    $node->appendChild($eventPic);
    $node->appendChild($includes);       
    $node->appendChild($eventStartDate);
  

	
	
    $root->appendChild($node);
}

echo $doc->saveXML();
?>