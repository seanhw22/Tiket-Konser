<x-app-layout>
    <section class="page-section portfolio" id="portfolio">
        <div class="container-edit">
            <h2>Seat Details</h2>
            <p>Event Name: {{ $event->event_name }}</p>
            <p>Seat Class: {{ $seatClass->seat_class}}</p>
            <p>Seat Position: {{ $rowString }}{{ $seat->seat_position_column}}</p>
            <p>Price: {{ $seatClass->price }}</p>
            <p>Available: @if($seat->available) Yes @else No @endif</p>
            @if (!$seat->available)
                <!-- <p>Validated: @if($seat->validate) Yes @else No @endif</p> -->
                 <p>Buyer : {{ $buyer->name }}</p>
                 <p>Email : {{ $buyer->email }}</p>
                 <p>Phone : {{ $buyer->phone }}</p>
            @endif
            <a href="{{ route('eventlist.showdetails', $event->id) }}" class="btn btn-primary">Back</a> 
        </div>
    </section>
</x-app-layout>