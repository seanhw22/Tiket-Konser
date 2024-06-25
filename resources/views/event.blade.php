@extends('layouts.template') 
@section('title') 
PSUT ConcertTickets
@endsection
@section('content')
<main class="content-wrapper">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 text-center">
                    <img src="{{ asset('assets/images/psut2-2.jpg') }}" alt="Events Image" class="img-fluid">
                </div>
                <div class="col-md-6 order-md-1">
                    <h2>Our Upcoming Events</h2>
                    <p>Check out our upcoming concerts and events near you! </p>
                </div>
            </div>

            <!-- Section-->

            <!--ini place holder image-->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex align-items-center">
                <form action="{{ route('event.search') }}" method="GET" class="d-flex flex-grow-1 me-2">
                    <input type="text" class="form-control flex-grow-1 me-2" name="search" placeholder="Search event..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary btn-light" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('event.sortasc') }}" method="GET" class="me-2">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary btn-light" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371zm1.57-.785L11 2.687h-.047l-.652 2.157z"/>
                            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('event.sortdesc') }}" method="GET">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary btn-light" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645z"/>
                            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371zm1.57-.785L11 9.688h-.047l-.652 2.156z"/>
                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <section id="event-section" class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @foreach ($event as $e)
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="{{$e->event_image}}" alt="{{$e->event_name}}">
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