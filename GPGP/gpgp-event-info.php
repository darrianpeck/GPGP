<?php
    require 'dbConnect.php'; 

    $sql = "SELECT event_name, event_begin_date, event_end_date, event_location_name, event_address1, event_address2, event_city, event_state, event_zip, event_phone_number, event_location_note1, event_location_note2, event_location_url FROM gpgp_event WHERE event_id=:recId";    //all rows in that table

    $stmt = $conn->prepare($sql);    
    
    $recID = 1;
    $stmt->bindParam(':recId', $recID);

    $stmt->execute();        //runs prepared statement and stores results within the statement

    $stmt->setFetchMode(PDO::FETCH_ASSOC);       

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Great Plains Games Players Fall SwampCon 2023 event page">
    <title>Fall SwampCon 2023! - Great Plains Game Players Event</title>

    <link rel="icon" type="image/x-icon" href="images/GPGP_Logo_Transparent_white.png">
    <link rel="stylesheet" href="stylesheets/event-stylesheet.scss">
    <link rel="stylesheet" href="stylesheets/event-stylesheet.css">
    <link rel="stylesheet" href="https://use.typekit.net/lqa6jva.css">
    <script src="js-files/main.js"></script>
    <script src="js-files/eventFunctions.js"></script>
</head>
<body onload="pageLoad()">
    <nav>
        <a href="index.html" class="GPGP-large">GPGP</a>
3
        <div class="menu-links">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Events</a></li>
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

    <header class="centered-content-block">
        <div class="event-title-block">
        <?php
            $row = $stmt->fetch();  //$row is an associative array
                echo "<div>";
                    echo "<h2>" .$row["event_name"] . "</h2>";
                    echo "<p>";
                        $beginDate=date_create($row["event_begin_date"]);
                        echo date_format($beginDate,"l, F d, Y");
                        echo " - ";
                        $endDate=date_create($row["event_end_date"]);
                        echo date_format($endDate,"l, F d, Y");
                    echo "</p>";
                echo "</div>";
            
        ?>
            <a href="#event-details" class="button">Event Details</a>
        </div>
    </header>

    <section class="centered-content-block">
        <div class="image-and-content-block">
            <img src="images/hotel.jpg" alt="zoomed out shot of a hotel on a beach">

            <div class="location-information-block">
                <h2>Event Information</h2>
                <?php
                    echo "<div class='location-address'>";
                        echo "<p>"."<strong>" .$row["event_location_name"] ."</strong>". "</p>";
                        echo "<p>" .$row["event_address1"] . "</p>";
                        echo "<p>" .$row["event_city"]. ", " .$row["event_state"] ." ".$row["event_zip"]."</p>";
                    echo "</div>";

                    echo "<div class='additional-info'>";
                        echo "<p>".$row["event_phone_number"]."</p>";
                        echo "<p>".$row["event_location_note1"]."</p>";
                        echo "<a href='".$row["event_location_url"]."' class='red-link'>HYATT Place Sioux Falls - South</a>";
                    echo "</div>";
                ?>
            </div>
        </div>
    </section>

    <section id="event-details" class="centered-content-block indv-day-schedule-block">
        <div class="button-container">
            <a class="button">Expand All</a>
            <a class="button">Collapse All</a>
        </div>

        <div class="indv-day-container">
            <div class="day-header">
                <h2>Thursday, May 16, 2024</h2>
                <p id="day1-arrow" class="arrow">
                    <span class="arrow-left-side"></span>
                    <span class="arrow-right-side turn-vertical"></span>
                </p>
            </div>

            <div id="day1-table" class="table-container">
                <div class="indv-cell">
                    <h3>9:00 AM - 1:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                        <p>n/a</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Lunch</h3>
                    <div class="game-cell">
                        <p>n/a</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>2:00 PM - 6:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                        <p>n/a</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Dinner</h3>
                    <div class="game-cell">
                        <p>Early Arrivers - Dinner</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>7:00 PM -</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                        <p>Firepit and general shenanigans</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="indv-day-container">
            <div class="day-header">
                <h2>Friday, May 17, 2024</h2>
                <p id="day2-arrow" class="arrow">
                    <span class="arrow-left-side"></span>
                    <span class="arrow-right-side turn-vertical"></span>
                </p>
            </div>

            <div id="day2-table" class="table-container">
                <div class="indv-cell">
                    <h3>9:00 AM - 1:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Lunch</h3>
                    <div class="game-cell">
                        <p>On Your Own</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>2:00 PM - 6:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Dinner</h3>
                    <div class="game-cell">
                        <p>On Your Own</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>7:00 PM -</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                        <p>Firepit and general shenanigans</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="indv-day-container">
            <div class="day-header">
                <h2>Saturday, May 18, 2024</h2>
                <p id="day3-arrow" class="arrow">
                    <span class="arrow-left-side"></span>
                    <span class="arrow-right-side turn-vertical"></span>
                </p>
            </div>

            <div id="day3-table" class="table-container">
                <div class="indv-cell">
                    <h3>9:00 AM - 1:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Lunch</h3>
                    <div class="game-cell">
                        <p>On Your Own</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>2:00 PM - 6:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Dinner</h3>
                    <div class="game-cell">
                        <p>On Your Own</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>7:00 PM -</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                        <p>Firepit and general shenanigans</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="indv-day-container">
            <div class="day-header">
                <h2>Sunday, May 19, 2024</h2>
                <p id="day4-arrow" class="arrow">
                    <span class="arrow-left-side"></span>
                    <span class="arrow-right-side turn-vertical"></span>
                </p>
            </div>

            <div id="day4-table" class="table-container">
                <div class="indv-cell">
                    <h3>9:00 AM - 1:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Lunch</h3>
                    <div class="game-cell">
                        <p>On Your Own</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>2:00 PM - 6:00 PM</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                        <p>Hugs, Cheers, Tears, and Departures</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>Dinner</h3>
                    <div class="game-cell">
                    </div>
                </div>

                <div class="indv-cell">
                    <h3>7:00 PM -</h3>
                    <div class="game-cell">
                        <p>Game 1</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 2</p>
                    </div>
                    <div class="game-cell">
                        <p>Game 3</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="centered-content-block">
        <div class="game-notes">
            <h2>Game Notes</h2>

            <ul>
                <li>TBD</li>
            </ul>
        </div>
    </section>

    <section class="centered-content-block">
        <div class="news-container">
            <h2>Upcoming Events</h2>

            <div class="cards-container">
                <div class="news-card">
                    <h3>GPGP Reunion</h3>
                    <p>Sioux City, IA</p>
                    <p>Wednesday, July 3, 2024 - Sunday, July 7, 2024</p>
                    <a href="#" class="yellow-link">Read More</a>
                </div>
            </div>

            <a href="#" class="button">Event Calendar</a>
        </div>
    </section> 

    <footer>
        <ul>
            <li><a href="#">Code of Conduct</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>

        <p>&copy;2024 All Rights Reserved</p>
    </footer>
</body>
</html>