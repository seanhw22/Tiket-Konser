@extends('layouts.template')
@section('content')
    <section class="page-section portfolio" id="portfolio">
        <div class="container py-4 clearfix">
            <img src="{{ $event->event_image }}" class="img-fluid" width="250" height="150" alt="{{ $event->event_name }}">
            <h2>{{ $event->event_name }}</h2>
            <p>{{ $event->event_desc}}</p>
            <p>Event Date: {{ $dateTimeString }}</p>
            <div class="container bg-secondary rounded py-3 px-4">
                <h2>Seat Class Details</h2>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Color</th>
                            <th scope="col">Seat Class</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    @foreach ($seatClasses as $seatClass)
                        <tr>
                            <td><div class="seat" style="background-color: {{ $seatClass['color_code'] }}"></div></td>
                            <td>{{ $seatClass['seat_class'] }}</td>
                            <td>{{ $seatClass['price'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <br>
            <h2>Seatmap</h2>
            <p>Click on the seat to buy tickets.</p>
            <div class="container">
                @for ($row = 1; $row <= $total_seat_rows; $row++)
                    <div class="row justify-content-center">
                    @for ($column = 1; $column <= $event->total_seat_columns; $column++)
                        <div class="col-0">
                        @foreach ($seats as $seat)
                            @if ($seat['seat_position_row'] === $row && $seat['seat_position_column'] === $column)
                                @foreach($seatClasses as $seatClass)
                                    @if($seat['seat_class_id'] === $seatClass['id'])
                                        <a @if($seat['available']) href="{{ route('event.seatdetails', [$event->id, $seat['id']]) }}" @endif>
                                            <div class="seat @if(!$seat['available']) dimmed @endif" style="background-color: {{ $seatClass['color_code'] }}"></div>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        </div>
                    @endfor
                    </div>
                @endfor
            </div>
            <a href="{{ route('event') }}" class="btn btn-primary">Back</a> 
        </div>
    </section>
@endsection