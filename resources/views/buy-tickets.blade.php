@extends('layouts.template') 
@section('title') 
Buy Tickets - PSUT ConcertTickets
@endsection
@section('content')
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
@endsection