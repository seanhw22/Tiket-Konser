@extends('layouts.template') 
@section('title') 
PSUT ConcertTickets
@endsection
@section('content')
<main class="content-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center">
                    <img src="assets/images/psut2-2.jpg" alt="Events Image" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-1">
                    <h2>Our Upcoming Events</h2>
                    <p>Check out our upcoming concerts and events near you! </p>
                    <a href="#event-section" class="btn btn-outline-yellow">View Events</a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>

            <!-- Section-->

            <!--ini place holder image-->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <section id="event-section" class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach ($event as $e)
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="assets/images/pngwing.com (6).png" alt="{{$e->event_name}}">
                                    <!-- <img class="card-img-top" src="$e->event_image" alt="{{$e->event_name}}"> -->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <p class="text-dark">{{$e->event_name}}</p>
                                            <a class="btn btn-outline-dark mt-auto" href="{{route('event.showdeployed', $e->id)}}">Show Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
    </main>
@endsection