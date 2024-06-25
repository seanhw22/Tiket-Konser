@extends('layouts.template') 
@section('title') 
Confirmation - PSUT ConcertTickets
@endsection
@section('content')
<main class="content-wrapper">
        <div class="container">
            <h2 class="text-center my-4">Thank You for Contacting Us!</h2>
            <p class="text-center"><a href="{{ route('index') }}" class="btn btn-primary">Back to Home</a></p>
        </div>
    </main>
@endsection