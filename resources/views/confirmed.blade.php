@extends('layouts.template') 
@section('title') 
Confirmation - PSUT ConcertTickets
@endsection
@section('content')
<main class="content-wrapper">
        <div class="container">
            <h2 class="text-center my-4">Thank You for Your Purchase!</h2>
            <p class="text-center">We have received your ticket purchase request. An email confirmation will be sent to
                you shortly.</p>
            <p class="text-center"><a href="{{ route('event') }}" class="btn btn-primary">Back to Events</a></p>
        </div>
    </main>
@endsection