@extends('layouts.template')
@section('content')
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <h2>Event Details</h2>
            <p>Event Name: {{ $event->event_name }}</p>
            <p>Event Description: {{ $event->event_desc}}</p>
            <p>Event Image: <br><img src="{{$event->event_image}}"></p>
            <p>Event Date: {{ $event->event_date }}</p>
            <p>Total Seat Columns: {{ $event->total_seat_columns }}</p>
            <p>Total Seat Rows: {{ $total_seat_rows }}</p>
            <p>End Date: {{ $event->end_date }}</p>
            <p>Deployed: @if($event->deployed) Yes @else No @endif</p>
            <p>--------------------------------------------------------</p>
            <h2>Seat Class Details</h2>
            @foreach ($seatClasses as $seatClass)
                <p>Seat Class Name: {{ $seatClass['seat_class'] }}</p>
                <p>Price: {{ $seatClass['price'] }}</p>
                <p>Total Seat Rows: {{ $seatClass['total_seat_rows'] }}</p>
                <p>Color Code: {{ $seatClass['color_code'] }}<div class="seat" style="background-color: {{ $seatClass['color_code'] }}"></div></p>
                <P>--------------------------------------------------------</P>
            @endforeach
            <br>
            <h2>Seats</h2>
                @for ($row = 1; $row <= $total_seat_rows; $row++)
                    @for ($column = 1; $column <= $event->total_seat_columns; $column++)
                        @foreach ($seats as $seat)
                            @if ($seat['seat_position_row'] === $row && $seat['seat_position_column'] === $column)
                                @foreach($seatClasses as $seatClass)
                                    @if($seat['seat_class_id'] === $seatClass['id'])
                                        <a href="{{ route('eventlist.seatdetails', [$event->id, $seat['id']]) }}">
                                            <div class="seat @if(!$seat['available']) dimmed @endif" style="background-color: {{ $seatClass['color_code'] }}"></div>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endfor
                    <br>
                @endfor
            <a href="{{ route('eventlist') }}" class="btn btn-primary">Back</a> 
        </div>
    </section>
@endsection