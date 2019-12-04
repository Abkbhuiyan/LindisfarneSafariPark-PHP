<?php 

	$con = mysqli_connect("localhost","root","");

	$query = "drop database if exists lindisfarne_safari_park";
	$result = mysqli_query($con,$query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>Database Dropped Successfully.</p>";

	$query = "create database lindisfarne_safari_park";
	$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>Database Created Successfully.</p>";

	$con = mysqli_connect("localhost","root","","lindisfarne_safari_park");

	$query = "CREATE TABLE user (

		  firstName varchar(30) DEFAULT NULL,
		  lastName varchar(30) DEFAULT NULL,
		  dob date DEFAULT NULL,
		  gender varchar(7) DEFAULT NULL,
		  address varchar(200) DEFAULT NULL,
		  postCode int(6) DEFAULT NULL,
		  country varchar(3) DEFAULT NULL,
		  email varchar(40) DEFAULT NULL,
		  phone int(11) DEFAULT NULL,
		  userType varchar(5) DEFAULT NULL,
		  username varchar(20) NOT NULL,
		  password varchar(20) DEFAULT NULL,
		  attempt int (11) DEFAULT NULL,
		  timeStamp  int(11) DEFAULT NULL,
		  PRIMARY KEY (username)
			)";
	$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'user' table created successfully.</p>";

	$query = "CREATE TABLE  animal (
		  animalId int(11) NOT NULL AUTO_INCREMENT,
		  sectionName varchar(50) DEFAULT NULL,
		  animalName varchar(50) DEFAULT NULL,
		  pic varchar(100) DEFAULT NULL,
		  about varchar(500) DEFAULT NULL,
		  howMuch int(11) DEFAULT NULL,
		  PRIMARY KEY (animalId)
		)";
	$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'animal' Table Created Successfully.</p>";

	$insertIntoAnimal = "INSERT INTO animal VALUES 
			('', 'Tiger Territory', 'Amur Tiger', 'tiger.jpg ', 'Unlike most cats, tigers love the water. Each tiger has its own unique striped pattern. The tiger is the biggest species of the cat family. A group of tigers is known as an ambush or streak',4),
			('',  'Deer Land',  'Axis Deer', 'axisdeer.jpg', 'Lives in herds of 100 or more. Also called the ‘chital’ or ‘spotted’ deer. Like most deer, sheds its antlers annually.',3),
			('', 'Geerafes Corner', 'Geraffe', 'giraffe.jpg', 'A giraffe’s heart is the size of a basketball and 	weighs up to 12.5kg. A giraffe has 7 neck bones – the same as a human. A giraffe’s tongue is blue! The colour works as a natural protection against the sun.', 5),
			('', 'Penguins Ice Land', 'Humboldt Penguins ', 'penguin.jpg', 'The black spots on the chest are unique to each individual. They have spines covering their mouth and tongues to keep hold of slippery fish. Penguins do not drink, but swallow water as they eat their prey. All penguins have a special gland in their body, which removes the salt from the seawater.', 7)";

	$result = mysqli_query($con, $insertIntoAnimal);
	if(!$result) echo mysqli_error($con);
	else echo "<p>Data Successfully Inserted Into 'Animal' Table.</p>";


	$query = "CREATE TABLE  VIPVisit (
		  eventId int(11) NOT NULL AUTO_INCREMENT,
		  eventName varchar(50) DEFAULT NULL,
		  eventDesc varchar(500) DEFAULT NULL,
		  eventPic varchar(100) DEFAULT NULL,
		  includes varchar(500) DEFAULT NULL,
		  eventStartDate Date,
		  PRIMARY KEY (eventId)
		) ";
	$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'VIPVisit' Table Created Successfully.</p>";

	$insertIntoVIPVisit ="INSERT INTO  VIPVisit  VALUES
		 ('', 'Zoo Keeper', 'Keepers will get to meet our  Asian hinos, lorikeets, meerkats and lemurs. ', 'zookeeper.jpg', 'As well as experience tours around  the Reptile House and Safari Drive-Through.', '2017-01-01'),
		('', 'Off Road Experience', 'Our Off road experiences are a unique treat for anyone who is an animal lover and would like to see a little of what goes on behind the scence.', 'offroad.jpg', 'Accompained by a oersonal safari guide, you and your party will get the chance to travel through the reserves in an authentic safari vehicle before we open to the general public.', '2017-02-01'),
		('', 'Feed the Elephants', 'This VIP Visit disclose to you a huge chance to feeding different types of elephants. ', 'feedelephant.jpg', 'It also includes different rides on elephant and horse. ', '2017-07-10'),
		('', 'Drive Through Reserves', 'We have four wildlife reserves full of exotic animals for you to admire though the Barbary macaque drive-through is optional, just in case you do not want to risk them clambering on your bonnet.', 'driveThroughReserves.jpg', 'As well as the monkeys, you can take a drive through the reserves to see animals such as rhinos, zebras, lions, camels and antelope, along with a host of others.','2017-06-15'),
		('', 'See Lion Presentation', 'Come and see the phenomenal sea lions display their talents at 12 noon, 1.30pm, 3pm, and 4.30pm.', 'seelion.jpg', 'The presentations allow the keepers to show off how the animals are trained for exercises and vet checks by making everything into an enjoyable game for them - the reward being loads of fish!', '2017-07-28')
		";
	$result = mysqli_query($con, $insertIntoVIPVisit);
	if(!$result) echo mysqli_error($con);
	else echo "<p>Data Successfully Inserted into 'VIPVisit' Table.</p>";


	$query = "CREATE TABLE  ticket (
		  ticketType varchar(15) NOT NULL,
		  eventName varchar(50) DEFAULT NULL,
		  unitPrice float DEFAULT NULL,
		  description varchar(70) NOT NULL,
		  PRIMARY KEY (ticketType,eventName)
		) ";
		$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'ticket' Table Created Successfully.</p>";

	$insertIntoTicket = "INSERT INTO ticket VALUES
	('Adult','Regular',20,'Regular Visit Adult Ticket.'),
	('Children','Regular',15,'Regular Visit Children Ticket'),
	('OAP','Regular',10,'Regular Visit OAP Ticket.'),
	('Family','Regular',50,'Regular Visit Family Ticket')";

	$result = mysqli_query($con, $insertIntoTicket);
	if(!$result) echo mysqli_error($con);
	else echo "<p>Data inserted into 'Ticket' table.</p>";
		
	$query = "CREATE TABLE  discount (
 		  discountID int(11) NOT NULL AUTO_INCREMENT,
		  discountStartDate date NOT NULL,
		  discountEndDate Date NOT NULL,
		  discountRate int (2) NOT NULL,
		  PRIMARY KEY (discountID)
		) ";
		$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'discount' Table Created Successfully.</p>";

	$query = "CREATE TABLE  availableTicket (
		  forDate date NOT NULL,
		  availAbleTicket int(3) NOT Null
		) ";
		$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'availAbleTicket' Table Created Successfully.</p>";



	$query = "CREATE TABLE  booking (
		  bookingId int(11) NOT NULL AUTO_INCREMENT,
		  bookingDate date DEFAULT NULL,
		  username varchar(30) DEFAULT NULL,
		  visitingDate date DEFAULT NULL,
		  eventName varchar(50) DEFAULT NULL,
		  childrenTicketQuantity int(2) DEFAULT NULL,
		  adultTicketQuantity int(2) DEFAULT NULL,
		  oapTicketQuantity int(2) DEFAULT NULL,
		  familyTicketQuantity int(2) DEFAULT NULL,
		  discount float DEFAULT NULL,
		  subTotal float DEFAULT NULL,
		  totalPrice float DEFAULT NULL,
		  PRIMARY KEY (bookingId)
		) ";
	$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>'booking' Table Created Successfully.</p>";



	$query = "insert into user values('Jehad','feni','1996-02-24','Male','Vill-west Darbarpur, Post: Munshirhat',3943,'BAN','jehadfeni@gmail.com','01831661534','admin','admin','Admin123',0,0)";
	$result = mysqli_query($con, $query);
	if(!$result) echo mysqli_error($con);
	else echo "<p>Data Successfully Inserted into user table.</p>";
	
 ?>