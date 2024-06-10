@extends('layouts.template') 
@section('title') 
PSUT ConcertTickets
@endsection
@section('content')
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
                    <a href="{{route('event')}}" class="btn btn-outline-yellow">View Events</a>
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
                    <a href="{{route('about')}}" class="btn btn-outline-yellow">About Us</a>
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
                    <a href="{{route('contact')}}" class="btn btn-outline-yellow">Contact Us</a>
                </div>
            </div>
        </div>
    </main>
@endsection