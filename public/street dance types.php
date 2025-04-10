<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazing Dance Academy</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #EDC7B7;
            margin: 0;
        }

        .navbar {
            padding: 20px;
            background-color: #123C69; /* Purple color */
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            margin-left: 15px;
        }
        .container-title {
            text-align: center;
            margin: 50px 0;
        }
        .card-container {
            background-color: #EDC7B7;
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
        }

        .card {
            background-color: #feebeb;
            flex: 0 0 auto;
            margin: 40px;
            width: 18rem;
            height: 100%;
        }

        /* Footer Styles */
        .footer {
            background-color: #123C69; /* Purple background */
            color: white; /* White text color */
            text-align: center;
            padding: 15px 0;
            position: relative;
            width: 100%;
        }

        .footer p {
            margin: 0;
            font-size: 1em;
        }

        .logo{
            height:70px;
        }

        .card-text {
            font-size: 0.9em;
            line-height: 1.2em;
            height: 60px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-body {
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img  class="logo" src="bhuumika/Logo.png" alt="Dance Academy Logo">
                <span> Dance Academy</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="service.html">Our Services</a></li>
                <li class="nav-item"><a class="nav-link" href="instructorsss.html">Our Instructors</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="schedule.html">Schedule </a></li>
                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- Service Title -->
    <div class="container-title">
        <h2>STREET DANCE STYLE</h2>
    </div>

    <!-- Street Dance Types -->
  
    
    <div class="card-container">
        <div class="card">
            <img src="bhuumika/breakdance.jpg" class="card-img-top" alt="Break Dance">
            <div class="card-body">
                <h5 class="card-title">Break Dance</h5>
                <p class="card-text">Dynamic street dance with acrobatic<br> moves and spins.</p>
                <a href="enroll_now.php" class="btn btn-primary mt-auto enroll-btn" data-dance-form="Dance Form Name">Enroll Now</a>
            </div>
        </div>
        <div class="card">
            <img src="bhuumika/popping.jpg" class="card-img-top" alt="Popping">
            <div class="card-body">
                <h5 class="card-title">Popping</h5>
                <p class="card-text"> Rhythmic dance featuring quick<br> muscle contractions.</p>
                <a href="enroll_now.php" class="btn btn-primary mt-auto enroll-btn" data-dance-form="Dance Form Name">Enroll Now</a>
            </div>
        </div>
        <div class="card">
            <img src="bhuumika/locking.jpg" class="card-img-top" alt="Locking">
            <div class="card-body">
                <h5 class="card-title">Locking</h5>
                <p class="card-text">Funk dance known for its<br> distinctive, sharp pauses.</p>
                <a href="enroll_now.php" class="btn btn-primary mt-auto enroll-btn" data-dance-form="Dance Form Name">Enroll Now</a>
            </div>
        </div>
    </div>
        

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Amazing Dance Academy. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
