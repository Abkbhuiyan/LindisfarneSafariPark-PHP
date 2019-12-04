<?php
    
    session_start();
    $userType = $_SESSION['userType'];
    $username = $_SESSION['username'];
    $login = $_SESSION['login'];
    if($_SESSION['login']!=true)
    header('location:login.html');
    else{   include_once('header.php');
            if ($_POST) {

                $bookingDate = date("Y-m-d");
                $visitingDate =$_POST['visitingDate'];
                $eventName =$_POST['eventName'];
                $childrenTicketQuantity = $_POST['childrenTicketQuantity'];
                $adultTicketQuantity = $_POST['adultTicketQuantity'];
                $oapTicketQuantity = $_POST['oapTicketQuantity'];   
                $familyTicketQuantity = $_POST['familyTicketQuantity']; 
                $subTotal  =$_POST['subTotal'];
                $discount=$_POST['discount'];
                $totalPrice=$_POST['totalPrice'];

                if ($visitingDate != null && $eventName != null && $username != null) {
                         $con = mysqli_connect("localhost", "root", "", "lindisfarne_safari_park");
                            $numTicket=$childrenTicketQuantity + $adultTicketQuantity+$oapTicketQuantity+$familyTicketQuantity;
                         $query ="select * from availableticket where    forDate='$visitingDate' ";
                         $booking = false;
                            $numOfRow = mysqli_num_rows(mysqli_query($con,$query));
                            $row = mysqli_fetch_array(mysqli_query($con,$query),MYSQLI_ASSOC); 
                            $availAbleTicket=0;
                            if ($numOfRow >0 ) {
                                $availAbleTicket = $row['availAbleTicket'];
                                if ($availAbleTicket >= $numTicket) {
                                    $booking =true;
                                }else echo "Ticket Out of stock please try another date or event";
                            }else{
                                $availAbleTicket = 500;
                                if ($availAbleTicket >= $numTicket) {
                                    $booking =true;
                                }else echo "Ticket Out of stock please try another date or event";
                            }

                            if ($booking==true) {
                                $query = "insert into booking values ('','$bookingDate','$username', '$visitingDate','$eventName','$childrenTicketQuantity','$adultTicketQuantity','$oapTicketQuantity','$familyTicketQuantity','$discount','$subTotal','$totalPrice')" ;
                                 $result = mysqli_query($con, $query);

                                 if (!$result) {
                                     echo mysqli_error($con);
                                 }else{
                                    echo "Thank you for booking.";
                                    echo $username;
                                    $query = "select email from user where username='$username'";
                                    $result = mysqli_query($con, $query);
                                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                                    $email = $row['email'];
                                    mail('$email','Confirmation','Your Booking COmpleted.', 'From: jehadfeni@gmail.com'); 
                                    echo "An email has been sent to your email address.";

                                     if ($numOfRow == 0) {
                                            $availAbleTicket = 500 - $numTicket; //echo $numTicket;
                                            $query = "insert into availableticket values('$visitingDate',$availAbleTicket)";
                                            $result=mysqli_query($con, $query);
                                    }else{
                                            $query ="select * from availableticket where    forDate='$visitingDate' ";
                                            $result=mysqli_query($con,$query);
                                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                            $availAbleTicket = $row['availAbleTicket']-$numTicket;
                                            $query="update availableticket set availAbleTicket=$availAbleTicket where forDate='$visitingDate'";
                                            mysqli_query($con, $query);
                                     }
                                }
                            }
                }               
             }
        }
?>