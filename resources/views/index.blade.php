<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSUT ConcertTickets</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.html">ConcertTickets</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="event.html">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About Us</a>
                        </li>
                    </ul>
                </div>
                <div class="profile-picture">
                    <a href="log.html">
                        <img src="assets/images/pngwing.com (4).png" alt="Profile Picture">
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <section class="video-background">
        <video autoplay muted loop id="background-video">
            <source src="assets/vid/1692701-uhd_3840_2160_30fps.mp4" type="video/mp4">
        </video>
        <div class="video-overlay">
            <h1>Welcome to ConcertTickets</h1>
        </div>
    </section>
    <main class="content-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center">
                    <img src="assets/images/psut2-2.jpg" alt="Events Image" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-1">
                    <h2>Our Upcoming Events</h2>
                    <p>Check out our upcoming concerts and events near you! </p>
                    <a href="event.html" class="btn btn-outline-yellow">View Events</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row align-items-center mt-5" id="about-us-section">
                <div class="col-md-6 order-md-1">
                    <img src="assets/images/psut.jpg" alt="Events Image Reversed" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-2 about-us-content">
                    <h2>About Us</h2>
                    <p>Learn more about Us!</p>
                    <a href="about.html" class="btn btn-outline-yellow">View Events</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center">
                    <img src="assets/images/psut1.jpeg" alt="Events Image" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-1">
                    <h2>Contact Us</h2>
                    <p>Contact Us for more informations! </p>
                    <a href="contact.html" class="btn btn-outline-yellow">View Events</a>
                </div>
            </div>
        </div>
    </main>
    
</body>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>ConcertTickets</h3>
                <p>Your go-to platform for discovering and booking tickets to the hottest concerts and events.</p>
            </div>
            <div class="col-md-6">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="event.html">Events</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>
