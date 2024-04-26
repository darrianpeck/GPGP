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
    <meta name="description" content="Great Plains Games Players home page">
    <title>Great Plains Games Players</title>

    <link rel="icon" type="image/x-icon" href="images/GPGP_Logo_Transparent_white.png">
    <link rel="stylesheet" href="stylesheets/home-stylesheet.css">
    <link rel="stylesheet" href="https://use.typekit.net/lqa6jva.css">
    <script src="javascript/functions.js"></script>
</head>
<body onload="pageLoad()">
    <nav>
        <a href="index.php" class="GPGP-large">GPGP</a>

        <div class="menu-links">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="gpgp-event-info.php">Events</a></li>
                <li><a href="#">Links</a></li>
                <li><a href="createEvent.php">Add Event</a></li>
            </ul>

            <a href="login.php" class="login-button">Login</a>
        </div>

        <div class="hamburger-menu">
            <span id="ham-bar-1"></span>
            <span id="ham-bar-2"></span>
            <span id="ham-bar-3"></span>
        </div>
    </nav>

    <header>
        <h1>
            <div>Great Plains</div>
            <img src="images/GPGP_Logo_Transparent_white.png" alt="great plains games players logo">
            <div>Games Players</div>
        </h1>
    </header>

    <section class="display-section">
        <div class="large-event-card">
            <img src="images/minis.jpg" alt="a song of ice and fire miniature model tray from the greyjoy faction">

            <div class="event-information-block">
                <?php
                    while($row = $stmt->fetch() ){      //$row is an associative array
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
                    }
                ?>
                <a href="gpgp-event-info.php" class="button">View Event</a>
            </div>
        </div>
    </section>

    <section class="display-section">
        <div class="news-container">
            <h2>News & Other Events</h2>

            <div class="cards-container">
                <div class="cards-container">
                    <div class="news-card">
                        <h3>GPGP Reunion</h3>
                        <p>Wednesday, July 3 - Sunday July 7, 2024</p>
                        <p>South Sioux City Marriott Riverfront Sioux City, IA</p>
                        <p>For Reservations:</p>
                        <a href="#" class="yellow-link">GPGP Reunion</a>
                    </div>
    
                    <div class="news-card">
                        <h3>Coming Soon!</h3>
                        <a href="#" class="yellow-link">Link</a>
                    </div>
    
                    <div class="news-card">
                        <h3>Coming Soon!</h3>
                        <a href="#" class="yellow-link">Link</a>
                    </div>
                </div>
            </div>

            <a href="#" class="button">View More</a>
        </div>
    </section> 

    <section class="display-section">
        <div class="mission-card">
            <h2>A Social Group With A Gaming Problem!</h2>
            
            <div class="icon-container">
                <div class="separation-bar"></div>
                <img src="images/shieldIcon.png" alt="shield icon yellow">
                <div class="separation-bar"></div>
            </div>

            <p>Going strong for over 45 years, our group of game players have been convening at various locations throughout the Midwest region to challenge each other on the game table. We primarily focus on turn-based strategy games, such as Terror on the Tonkin, Civil War Battle, BattleTech, and GW Middle Earth.</p>
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