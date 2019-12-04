<?php 
    session_start();
    $userType = $_SESSION['userType'];
    $login = $_SESSION['login'];
    if($_SESSION['login']!=true)
    header('location:login.html');
    elseif ($userType!='user') header('location:index.php'); 
    else {
        include_once('header.php');
 ?>

<!DOCTYPE html>
<html>
    <head>
        
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css"/>
        <link href="css/datepicker2.css" rel="stylesheet" type="text/css"/>
        <link href="css/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/fullcalendar.print.min.css" rel="stylesheet" type="text/css" media="print"/>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/moment.min.js" type="text/javascript"></script>
        <script src="js/fullcalendar.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/moment-datepicker.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
       <style type="text/css">
           table{
            width:100%;
            border-spacing: 10px; 
            border-collapse: separate;
            
           }
           caption{
            font-weight: bold;
            font-size: 30px;
           }
           thead{
            font-weight: bold; font-size: 20px;
           }
           tbody{
             font-size: 15px;
           }
           p{
             font-size: 20px;
           }
           #check{
            font-weight: bold; font-size: 25px;
           }
       </style>
    </head>
    <body>
       
    <div class="booking-panel">
        <div class="panel panel-deafult">
            <div class="panel-body">
                <div class="booking">
                    <div class="booking-left">
                       <div id="calendar"></div>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "lindisfarne_safari_park");
                    $query = "select discountRate as 'Discount Rate', discountStartDate as 'Discount Start Date',discountEndDate as 'Discount End Date' from discount" ;
                    $result = mysqli_query($con, $query);
                    ?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                    <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>        
                        var events = new Array();
                        event = new Object();
                        event.title = "<?php echo 'Save '.$row['Discount Rate'].'%' ?>";
                        event.start = "<?php echo $row['Discount Start Date'] ?>";
                        event.end =    "<?php echo $row['Discount End Date'] ?>";
                        event.color = "blue";
                        event.allDay = true;
                        events.push(event);
                        $('#calendar').fullCalendar('addEventSource', events);
                    <?php }?>
                        });
                    </script>
                        
                         </div>
                    
                        <div class="booking-right" style="padding: 20px;">

                            <table >
                            <caption>Opening and Closing Times</caption>
                            <thead>
                                <td>Dates</td>
                                <td>Opening</td>
                                <td>Last entry</td>
                                <td>Closing</td>
            
                            </thead>
                            <tbody>
                                <tr><td>From 20 February 2017</td>
                                <td>10:00</td>
                                <td>16:30</td>
                                <td>17:30</td>
                                </tr><tr><td>From 1 April 2017</td>
                                <td>09:00</td>
                                <td>17:00</td>
                                <td>18:00</td>
                                </tr><tr><td>From 4 September 2017</td>
                                <td>10:00</td>
                                <td>16:30</td>
                                <td>17:30</td>
                                </tr><tr><td>From 21 October 2017</td>
                                <td>10:00</td>
                                <td>16:00</td>
                                <td>17:00</td>
                                </tr><tr><td>From 30 October 2017</td>
                                <td>10:30</td>
                                <td>15:00</td>
                                <td>16:00</td>
                                </tr></tbody>
                            </table><br />

                            <p>Lindisfarne Safari Park is open every day of the year except Christmas Day.</p>

                            <p id="check">Bag checks in progress</p> <br />

                            <p>We always want to make sure that Lindisfarne Safari Park is a safe and secure place to visit. In line with increased security measures being implemented across the UK, we will be carrying out bag checks at the Zoo entrance. We would also recommend, wherever possible, you leave large bags at home.</p>
                   
                </div>
            </div>
        </div>
        
    </div>
   
</body>
</html>
<?php } ?>