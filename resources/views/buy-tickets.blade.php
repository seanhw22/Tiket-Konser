@extends('layouts.template') 
@section('title') 
Buy Tickets - PSUT ConcertTickets
@endsection
@section('content')
<main class="content-wrapper">
        <div class="container pb-4">
            <h2 class="text-center mb-4">Purchase Tickets</h2>
            <form action="confirmation.html" method="POST">
                <h2>Seat Details</h2>
                <p>Event Name: {{ $event->event_name }}</p>
                <p>Seat Class: {{ $seatClass->seat_class}}</p>
                <p>Seat Position: {{ $rowString }}{{ $seat->seat_position_column}}</p>
                <p>Price: {{ $seatClass->price }}</p>
                <h2>Enter your information here.</h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone" min="0" required>
                </div>
                <div class="form-group">
                    <label for="validation" class="form-label">Bukti Pembayaran</label><br>
                    <input type="file" id="validation" name="validation" accept="image/png" required>
                </div>
                <button type="submit" class="btn btn-primary">Buy Tickets</button>
            </form>
        </div>
        <div class="container">
            <a href="{{ route('event.showdeployed', $event->id) }}" class="btn btn-primary">Back</a>
        </div>
    </main>
@endsection