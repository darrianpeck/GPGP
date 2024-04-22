<?php  
    //set a SESSION VARIABLE to restrict this page to only a valid user / must sign on to use the page:
        
        session_start();    //join an existing session, if any, otherwise start a new session / must sign on to see the page
        /*
        if($_SESSION['member_role']== "member", "admin"){
            //true branch says: valid user, let them see the page
        }
        else{
            //false branch, INVALID user, return them to create event page or home page
            header("Location: createEventREMAKE.php");    //currently taking user to create event page, will change to login page 
        }
        */

    $eventNameMsg = ""; //define a global variable with no content
    $eventBeginDateMsg = "";
    $eventEndDateMsg = "";
    $eventLocationNameMsg = "";
    $eventAddress1Msg = "";
    //$eventAddress2Msg = "";   //this is optional for the user, don't need it to be filled out
    $eventCityMsg = "";
    $eventStateMsg = "";
    $eventZipMsg = "";
    $eventPhoneNumberMsg = "";
    $eventLocationNote1Msg = "";
    //$eventLocationNote2Msg = "";  //this is optional for the user, don't need it to be filled out
    $eventLocationUrlMsg = "";

    $inEventName = ""; //default value to display on the form the first time it is requested
    $inEventBeginDate = "";
    $inEventEndDate = "";
    $inEventLocationName = "";
    $inEventAddress1 = ""; 
    $inEventAddress2 = "";
    $inEventCity = "";
    $inEventState = "";
    $inEventZip = "";
    $inEventPhoneNumber = "";
    $inEventLocationNote1 = "";
    $inEventLocationNote2 = "";
    $inEventLocationUrl = "";

    $confirmMessage = false;    //make this variable available to the whole page

    if(isset($_POST['submit'])) { 

       echo "<h3>You hit submit!!!</h3>";         // testing

        //process form data into PHP variables
            $inEventName = $_POST['event_name']; //get data from fields if submitted
            $inEventBeginDate = $_POST['event_begin_date'];
            $inEventEndDate = $_POST['event_end_date'];
            $inEventLocationName = $_POST['event_location_name'];
            $inEventAddress1 =  $_POST['event_address1'];
            $inEventAddress2 = $_POST['event_address2'];
            $inEventCity = $_POST['event_city'];
            $inEventState = $_POST['event_state'];
            $inEventZip = $_POST['event_zip'];
            $inEventPhoneNumber = $_POST['event_phone_number'];
            $inEventLocationNote1 = $_POST['event_location_note1'];
            $inEventLocationNote2 = $_POST['event_location_note2'];
            $inEventLocationUrl = $_POST['event_location_url'];

        //when a field is not filled out, can do this for each input
            function validateEventName($inName){
                if($inName == ""){
                    //invalid
                    global $validInput, $eventNameMsg;
                    $validInput = false;
    
                    //display error message
                    $eventNameMsg = "Please enter a valid event name.";
                }
            }

            function validateEventBeginDate($inBeginDate){
                if($inBeginDate == ""){
                    global $validInput, $eventBeginDateMsg;
                    $validInput = false;
    
                    $eventBeginDateMsg = "Please enter a valid event begin date.";
                }
            }

            function validateEventEndDate($inEndDate){
                if($inEndDate == ""){
                    global $validInput, $eventEndDateMsg;
                    $validInput = false;
    
                    $eventEndDateMsg = "Please enter a valid event end date.";
                }
            }

            function validateEventLocation($inLocationName){
                if($inLocationName == ""){
                    global $validInput, $evnetLocationNameMsg;
                    $validInput = false;
    
                    $evnetLocationNameMsg = "Please enter a valid event location name.";
                }
            }

            function validateAddress1($inAddress1){
                if($inAddress1 == ""){
                    global $validInput, $eventAddress1Msg;
                    $validInput = false;
    
                    $eventAddress1Msg = "Please enter a valid event address.";
                }
            }

            function validateEventCity($inCity){
                if($inCity == ""){
                    global $validInput, $eventCityMsg;
                    $validInput = false;
    
                    $eventCityMsg = "Please enter a valid event city.";
                }
            }

            function validateEventState($inState){
                if($inState == ""){
                    global $validInput, $eventStateMsg;
                    $validInput = false;
    
                    $eventStateMsg = "Please choose a valid event state.";
                }
            }

            function validateEventZip($inZip){
                if($inZip == ""){
                    global $validInput, $eventZipMsg;
                    $validInput = false;
    
                    $eventZipMsg = "Please enter a valid event zip code.";
                }
            }

            function validateEventPhoneNumber($inPhoneNumber){
                if($inPhoneNumber == ""){
                    global $validInput, $eventPhoneNumberMsg;
                    $validInput = false;
    
                    $eventPhoneNumberMsg = "Please enter a valid event phone number.";
                }
            }

            function validateEventLocationNote1($inLocationNote1){
                if($inLocationNote1 == ""){
                    global $validInput, $eventLocationNote1Msg;
                    $validInput = false;
    
                    $eventLocationNote1Msg = "Please enter a valid event location note, or N/A.";
                }
            }

            function validateEventLocationUrl($inLocationUrl){
                if($inLocationUrl == ""){
                    global $validInput, $eventLocationUrlMsg;
                    $validInput = false;
    
                    $eventLocationUrlMsg = "Please enter a valid event location URL.";
                }
            }

        $validInput = true;
            validateEventName($inEventName);
            validateEventBeginDate($inEventBeginDate);
            validateEventEndDate($inEventEndDate);
            validateEventLocation($inEventLocationName);
            validateAddress1($inEventAddress1);
            validateEventCity($inEventCity);
            validateEventState($inEventState);
            validateEventZip($inEventZip);
            validateEventPhoneNumber($inEventPhoneNumber);
            validateEventLocationNote1($inEventLocationNote1);
            validateEventLocationUrl($inEventLocationUrl);

        if ($validInput){  
            require 'dbConnect.php';

            //build mySQL
                $sql ="INSERT INTO gpgp_event";
                $sql .= "(event_name, event_begin_date, event_end_date, event_location_name, event_address1, event_address2, event_city, event_state, event_zip, event_phone_number, event_location_note1, event_location_note2, event_location_url)";
                $sql .="VALUES ";
                $sql .="(:eventName, :eventBeginDate, :eventEndDate, :eventLocationName, :eventAddress1, :eventAddress2, :eventCity, :eventState, :eventZip, :eventPhoneNumber, :eventLocationNote1, :eventLocationNote2, :eventLocationUrl)";
    
            //prepare statement
                $stmt = $conn->prepare($sql); 

            //bind parameters
                $stmt->bindParam(':eventName', $inEventName);
                $stmt->bindParam(':eventBeginDate', $inEventBeginDate);
                $stmt->bindParam(':eventEndDate', $inEventEndDate);
                $stmt->bindParam(':eventLocationName', $inEventLocationName);
                $stmt->bindParam(':eventAddress1', $inEventAddress1);
                $stmt->bindParam(':eventAddress2', $inEventAddress2);
                $stmt->bindParam(':eventCity', $inEventCity);
                $stmt->bindParam(':eventState', $inEventState);
                $stmt->bindParam(':eventZip', $inEventZip);
                $stmt->bindParam(':eventPhoneNumber', $inEventPhoneNumber);
                $stmt->bindParam(':eventLocationNote1', $inEventLocationNote1);
                $stmt->bindParam(':eventLocationNote2', $inEventLocationNote2);
                $stmt->bindParam(':eventLocationUrl', $inEventLocationUrl);
                
            //execute
                $stmt->execute();

            //provide comformation message, display html
            $confirmMessage = "true";       //this will be set once all data is in database
        }//closes the if statement that shows the form

        else{
            //send the form back to the user
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Great Plains Games Players home page">
    <title>Great Plains Games Players</title>

    <link rel="icon" type="image/x-icon" href="images/GPGP_Logo_Transparent_white.png">
    <link rel="stylesheet" href="./css/createEventStyle.css">
    <link rel="stylesheet" href="./css/home-stylesheet.css">
    <link rel="stylesheet" href="https://use.typekit.net/lqa6jva.css">
    <script src="javascript/functions.js"></script>

    <style>
        .errMsg{
            color:red;
            font-size: 12px;
        }

        .confirmMessage {
            margin-top: 50px;
            width: 70%;
            padding: 15px;
            background-color: #1d213bdf;
            color: white;
            margin-left: auto;
            margin-right:auto;
            }
    </style>
</head>

    <body>
    <nav>
        <a href="index.html" class="GPGP-large">GPGP</a>

        <div class="menu-links">
            <ul>
                <li><a href="index.html">About</a></li>
                <li><a href="event.html">Events</a></li>
                <li><a href="#">Links</a></li>
            </ul>

            <a href="#" class="login-button">Login</a>
        </div>

        <div class="hamburger-menu">
            <span id="ham-bar-1"></span>
            <span id="ham-bar-2"></span>
            <span id="ham-bar-3"></span>
        </div>
    </nav>

    <?php
        /*
            if we have updated the database then we will display confirmMessage
            else display the form
        */
        if ($confirmMessage){
    ?>
            <div class="confirmMessage">
                <h2> Your event has been added!</h2>
                <p><a href="index.html">Return back to GPGP</a></p>
            </div>
    <?php
        }
        else{
    ?>
        <div id="form">
            <h2>Create Event</h2>
            <hr>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <p>
                    <label for="event_name">Event Name: </label>
                    <input type="text" name="event_name" id="event_name" value="<?php echo $inEventName; ?>">
                    <span class="errMsg"><?php echo $eventNameMsg;?></span>
                </p>

                <p>
                    <label for="event_begin_date">Event Begin Date: </label>
                    <input type="date" name="event_begin_date" id="event_begin_date" value="<?php echo $inEventBeginDate; ?>">
                    <span class="errMsg"><?php echo $eventBeginDateMsg;?></span>
                </p>

                <p>
                    <label for="event_end_date">Event End Date: </label>
                    <input type="date" name="event_end_date" id="event_end_date" value="<?php echo $inEventEndDate; ?>">
                    <span class="errMsg"><?php echo $eventEndDateMsg;?></span>
                </p>

                <p>
                    <label for="event_location_name">Event Location Name: </label>
                    <input type="text" name="event_location_name" id="event_location_name" value="<?php echo $inEventLocationName; ?>">
                    <span class="errMsg"><?php echo $eventLocationNameMsg;?></span>
                </p>

                <p>
                    <label for="event_address1">Event Address Line 1: </label>
                    <input type="text" name="event_address1" id="event_address1" value="<?php echo $inEventAddress1; ?>">
                    <span class="errMsg"><?php echo $eventAddress1Msg;?></span>
                </p>

                <p>
                    <label for="event_address2">Event Address Line 2: </label>
                    <input type="text" name="event_address2" id="event_address2" value="<?php echo $inEventAddress2; ?>">
                </p>

                <p>
                    <label for="event_city">Event City: </label>
                    <input type="text" name="event_city" id="event_city" value="<?php echo $inEventCity; ?>">
                    <span class="errMsg"><?php echo $eventCityMsg;?></span>
                </p>

                <p>
                    <p>Select a state</p>
                    <select name="event_state" id="event_state" value="<?php echo $inEventState; ?>">
                        <option value="" selected="selected">Please Select a State</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                    <span class="errMsg"><?php echo $eventStateMsg;?></span>
                </p>

                <p>
                    <label for="event_zip">Event Zip Code: </label>
                    <input type="text" name="event_zip" id="event_zip" value="<?php echo $inEventZip; ?>">
                    <span class="errMsg"><?php echo $eventZipMsg;?></span>
                </p>

                <p>
                    <label for="event_phone_number">Event Phone Number: </label>
                    <input type="tel" name="event_phone_number" id="event_phone_number" value="<?php echo $inEventPhoneNumber; ?>">
                    <span class="errMsg"><?php echo $eventPhoneNumberMsg;?></span>
                </p>

                <p>
                    <label for="event_location_note1">First Event Location Note : </label>
                    <input type="text" name="event_location_note1" id="event_location_note1" value="<?php echo $inEventLocationNote1; ?>">
                    <span class="errMsg"><?php echo $eventLocationNote1Msg;?></span>
                </p>

                <p>
                    <label for="event_location_note2">Second Event Location Note: </label>
                    <input type="text" name="event_location_note2" id="event_location_note2" value="<?php echo $inEventLocationNote2; ?>">
                </p>

                <p>
                    <label for="event_location_url">Event Location URL: </label>
                    <input type="url" name="event_location_url" id="event_location_url" value="<?php echo $inEventLocationUrl; ?>">
                    <span class="errMsg"><?php echo $eventLocationUrlMsg;?></span>
                </p>

                <p>
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="reset" value="Reset">
                </p>
            </form>
        </div>
    <?php
        }
    ?>

    </body>
</html>