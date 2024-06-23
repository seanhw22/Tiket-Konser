<x-app-layout>
    <section class="page-section portfolio" id="tambah">
        <div class="container">
            <h1>Edit Data Event</h1>
            <form action="{{ route('buyerlist.update', $buyer->id) }}" method="POST"> 
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $buyer->name }}" required> 
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $buyer->email }}" required> 
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone" min="0" value="{{ $buyer->phone }}" required>
                </div>
                <div class="mb-3">
                    <label for="event_name" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="event_name" name="event_name" value="{{ $event->event_name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="seat_class" class="form-label">Seat Class</label>
                    <input type="text" class="form-control" id="seat_class" name="seat_class" value="{{ $seatClass->seat_class }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="seat_position" class="form-label">Seat Position</label>
                    <input type="text" class="form-control" id="seat_position" name="seat_position" value="{{ $seat['seat_position_row'] }}{{ $seat['seat_position_column'] }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('buyerlist') }}" class="btn btn-primary">Back</a> 
            </form>
        </div>
    </section>
</x-app-layout>