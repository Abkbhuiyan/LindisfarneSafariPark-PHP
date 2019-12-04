<?php 
    session_start();
    $userType = $_SESSION['userType'];
    $login = $_SESSION['login'];
    if($_SESSION['login']!=true)
    header('location:login.html');
    elseif ($userType!='user') header('location:index.php'); 
    else {
        include_once('header.php');

        function fillEvent()
    {
        $con = mysqli_connect("localhost","root","","lindisfarne_safari_park");
        $output = '';
        $query = "select eventName from VIPVisit ORDER BY eventName";
        $result= mysqli_query($con, $query);

            while ($row= mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                $eventName = $row['eventName'];
                $output .='<option value="'.$eventName.'">'.$eventName.'</option>';
            }

            return $output;
    }
 ?>

<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet"  href="jquery-ui11.css">
        <link rel="stylesheet"  href="style1.css">
        <script src="jquery11-1.12.4.js"></script>
        <script src="jquery-ui11.js"></script>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css"/>
        <link href="css/datepicker2.css" rel="stylesheet" type="text/css"/>
        <link href="css/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/fullcalendar.print.min.css" rel="stylesheet" type="text/css" media="print"/>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
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
       <script>
            $( function() {
                $("#visitingDate").datepicker({minDate: 0, });
            } );
        </script>
      
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
                    $query = "select forDate as 'Ticket Date', availAbleTicket as 'Available Ticket' from availableticket" ;
                    $result = mysqli_query($con, $query);
                    ?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                    <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    ?>        
                        var events = new Array();
                        event = new Object();
                        event.title = "<?php echo 'Available '.$row['Available Ticket'] ?>";
                        event.start = "<?php echo $row['Ticket Date'] ?>";
                        //event.end =    "<?php //echo $row['Discount End Date'] ?>";
                        event.color = "blue";
                        event.allDay = true;
                        events.push(event);
                        $('#calendar').fullCalendar('addEventSource', events);
                    <?php }?>
                        });
                    </script>
                        
                         </div>
                    
                        <div class="booking-right" style="padding: 20px;">
       <script type="text/javascript">
        $(document).ready(function(){
           
           $('#eventName').change(function(){
                var eventName = $(this).val();
                //var date = $('#visitingDate').val();
                $.ajax({
                    url:'fetchData.php',
                    method:'POST',          
                    data:{'eventName':eventName},
                    success:function(data){
                        //alert(data);
                
                        result = $.parseJSON(data);
                        for(i in result){
                            //alert(result[i].ticketType);
                            if (result[i].ticketType =='Adult') {
                                
                                $('.adultTicketPriceHtml').html(result[i].unitPrice);
                                $('.adultTicketPrice').val(result[i].unitPrice);
                            } 
                            else if (result[i].ticketType=='Children') {
                                $('.childrenTicketPriceHtml').html(result[i].unitPrice);
                                $('.childrenTicketPrice').val(result[i].unitPrice);
                            }
                            else if (result[i].ticketType=='OAP') {
                                $('.oapTicketPriceHtml').html(result[i].unitPrice);
                                $('.oapTicketPrice').val(result[i].unitPrice);
                            }
                            else if (result[i].ticketType=='Family') {
                                $('.familyTicketPriceHtml').html(result[i].unitPrice);
                                $('.familyTicketPrice').val(result[i].unitPrice);
                            }
                        }
                    
                    }
                });
          });

        });
            
    </script>
    
                            <form action="confirmBooking.php" method="post" enctype="multipart/form-data">
                                <table align="center">
                                    <caption>Ticket Booking</caption>

                                    <tr>
                                        <td><label for="visitingDate">Visiting Date</label></td>
                                        <td>:<input type="text" id="visitingDate" name="visitingDate" value="<?php echo date("Y-m-d"); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="eventName">Visit To Event</label></td>
                                        <td>:<select name="eventName" id="eventName"> 
                                             <option value="Regular">Regular</option>   
                                                  <?php echo fillEvent(); ?>  
                                             </select> 
                                        </td>
                                    </tr>

                                <tr>
                                <td colspan="2">
                                <table align="left" cellpadding="10px" >
                                    <caption>Tickets</caption>
                                    <thead>
                                        <td>Ticket Type</td>
                                        <td>Quantity</td>
                                        <td>Price</td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            <label for="adultticket">Adult (16-64 years)</label>
                                            </td>
                                            <td>
                                            <input type="number" id="adultticket" name="adultTicketQuantity" style="width: 45px" />
                                            </td>
                                            <td>
                                            <label for="adultTicketPrice" class="adultTicketPriceHtml">20 </label>
                                            <input type="hidden" name="adultTicketPrice" class="adultTicketPrice" value="20" />
                                            </td>
                                            
                                            
                                        </tr>

                                        <tr>
                                            <td>
                                            <label for="childrenTicket">Children (3-16 years)</label>
                                            </td>
                                            <td>
                                            <input type="number" id="childrenTicketQuantity" name="childrenTicketQuantity" style="width: 45px" />
                                            </td>
                                            <td>
                                            <label for="childrenTicketPrice" class="childrenTicketPriceHtml"> 15 </label>
                                            <input type="hidden" name="childrenTicketPrice"  class="childrenTicketPrice" value="15" />
                                            </td>
                                            
                                            
                                        </tr>

                                        <tr>
                                            <td>
                                            <label for="oapticket">Old Age Pensioner (64 years up)</label>
                                            </td>
                                            <td>
                                            <input type="number" id="oapTicketQuantity" name="oapTicketQuantity" style="width: 45px" />
                                            </td>
                                            <td>
                                            <label for="oapTicketPrice" class="oapTicketPriceHtml"> 10 </label>
                                            <input type="hidden" name="oapTicketPrice"  class="oapTicketPrice" value="10" />
                                            </td>
                                            
                                            
                                        </tr>

                                        <tr>
                                            <td>
                                            <label for="familyticket">Family (2 adults, 2 childs)</label>
                                            </td>
                                            <td>
                                            <input type="number" id="familyTicket" name="familyTicketQuantity" style="width: 45px" />
                                            </td>
                                            <td>
                                            <label for="familyTicketPrice" class="familyTicketPriceHtml">50  </label>
                                            <input type="hidden" name="familyTicketPrice"  class="familyTicketPrice" value="50" />
                                            </td>
                                            
                                            
                                        </tr>
                                    </tbody>
                                        
                                </table>
                                </td>
                                </tr>
                                
                                    <tr> 
                                        <td colspan="2" align="center"><input type="submit" value="Continue Booking" name="addBooking" /></td>
                                    </tr>
                                </table>
                            </form>
                </div>
            </div>
        </div>
        
    </div>
   
</body>
</html>
<?php } ?>