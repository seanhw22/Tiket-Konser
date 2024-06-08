<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Tickets - PSUT ConcertTickets</title>
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

    <main class="content-wrapper">
        <div class="container">
            <h2 class="text-center my-4">Purchase Tickets</h2>
            <form action="confirmation.html" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="numTickets">Number of Tickets</label>
                    <input type="number" class="form-control" id="numTickets" name="numTickets" min="1" required>
                </div>
                <div class="form-group">
                    <label for="seatType">Seat Type</label>
                    <select class="form-control" id="seatType" name="seatType" required>
                        <option value="" disabled selected>Select your seat type</option>
                        <option value="VIP">VIP</option>
                        <option value="Regular">Regular</option>
                        <option value="Student">Student</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Buy Tickets</button>
            </form>
        </div>
    </main>

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
</body>

</html>