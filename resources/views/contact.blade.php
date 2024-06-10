@extends('layouts.template') 
@section('title') 
PSUT ConcertTickets
@endsection
@section('content')
    <section class="dark-bg-section">
        <div class="dark-overlay">
            <h1>Contact Us</h1>
        </div>
    </section>
    
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        
                        <h2>Have any questions or suggestions? Fill out the form below to get in touch with us.</h2>
                        <form id="contact-form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" id="image" name="image" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection