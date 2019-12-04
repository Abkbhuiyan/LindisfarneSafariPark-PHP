<?php
header('Content-Type: text/xml; charset=utf-8');
$con=mysqli_connect("localhost", "root", "","lindisfarne_safari_park");
$query = "SELECT * from user";
$ret=mysqli_query($con,$query);
$num_results = mysqli_num_rows ($ret);
$doc = new DOMDocument();
$doc->formatOutput = true;
$root = $doc->createElement("Users");
$doc->appendChild($root);

for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_array ($ret,MYSQLI_ASSOC);

    $node = $doc->createElement( "User" );	

    $firstName = $doc->createElement( "firstName" );
	$lastName = $doc->createElement( "lastName" );  
	$dob = $doc->createElement( "dob" );
	$gender = $doc->createElement( "gender" ); 
	$address = $doc->createElement( "address" );  
	$postCode = $doc->createElement( "postCode" );
    $country = $doc->createElement( "country" );
    $email = $doc->createElement( "email" );  
    $phone = $doc->createElement( "phone" );
    $userType = $doc->createElement( "userType" );
     $username = $doc->createElement( "username" );

	
	$firstName->appendChild($doc->createTextNode($row["firstName"]));
    $lastName->appendChild($doc->createTextNode($row["lastName"]));
    $dob->appendChild($doc->createTextNode($row["dob"]));
    $gender->appendChild($doc->createTextNode($row["gender"]));
    $address->appendChild($doc->createTextNode($row["address"]));
    $postCode->appendChild($doc->createTextNode($row["postCode"]));
    $country->appendChild($doc->createTextNode($row["country"]));
    $email->appendChild($doc->createTextNode($row["email"]));
    $phone->appendChild($doc->createTextNode($row["phone"]));
    $userType->appendChild($doc->createTextNode($row["userType"]));
    $username->appendChild($doc->createTextNode($row["username"]));


	
	$node->appendChild($firstName);       
    $node->appendChild($lastName);
    $node->appendChild($dob);       
    $node->appendChild($gender);
    $node->appendChild($address);       
    $node->appendChild($postCode);
    $node->appendChild($country);
    $node->appendChild($email);       
    $node->appendChild($phone);
    $node->appendChild($userType);
    $node->appendChild($username);

	
	
    $root->appendChild($node);
}

echo $doc->saveXML();
?>