@extends('layouts.template')
@section('content')
    <section class="page-section portfolio" id="portfolio">
        <h2>Event Details</h2>
        <p>Event Name: {{ $event->event_name }}</p>
        <p>Event Description: {{ $event->event_desc}}</p>
        <p>Total Seat Columns: {{ $event->total_seat_columns }}</p>
        <p>Total Seat Rows: {{ $total_seat_rows }}</p>
        <p>End Date: {{ $event->end_date }}</p>
        <p>Deployed: @if($event->deployed) Yes @else No @endif</p>
        <P>--------------------------------------------------------</P>
        <h2>Seat Class Details</h2>
        @foreach ($seatClasses as $seatClass)
            <p>Seat Class Name: {{ $seatClass['seat_class'] }}</p>
            <p>Price: {{ $seatClass['price'] }}</p>
            <p>Total Seat Rows: {{ $seatClass['total_seat_rows'] }}</p>
            <P>--------------------------------------------------------</P>
        @endforeach
        <br>
        <h2>Seats</h2>
        @foreach ($seats as $seat)
            @foreach($seatClasses as $seatClass)
                @if($seat['seat_class_id'] === $seatClass['id'])
                    <div class="seat" style="background-color: {{ $seatClass['color_code'] }}"></div>
                    @if ($seat['seat_position_column'] === $event->total_seat_columns)
                        <br>
                    @endif
                @endif
            @endforeach
        @endforeach
    </section>
@endsection