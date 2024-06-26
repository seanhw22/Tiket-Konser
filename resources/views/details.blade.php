@extends('layouts.template')
@section('content')
    <section class="page-section portfolio" id="portfolio">
        <div class="container details py-4 clearfix" style="max-width: 100%">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <img src="{{ $event->event_image }}" class="img-fluid rounded" width="700" height="700" alt="{{ $event->event_name }}">
            <br><br><br><br>
            <h2>{{ $event->event_name }}</h2>
            <br><br>
            <div class="container description">
                <p><?php echo htmlspecialchars_decode($event->event_desc, ENT_QUOTES); ?></p>
            </div>
            <br><br>
            <p>Event Date: {{ $dateTimeString }}</p>
            <br>
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
            <div class="details">
                @php
                    $seatsLookup = [];
                    foreach ($seats as $seat) {
                        $seatsLookup[$seat['seat_position_row']][$seat['seat_position_column']] = $seat;
                    }

                    $seatClassesLookup = [];
                    foreach ($seatClasses as $seatClass) {
                        $seatClassesLookup[$seatClass['id']] = $seatClass;
                    }
                @endphp
                @for ($row = 1; $row <= $total_seat_rows; $row++)
                    <div class="row justify-content-center">
                        @for ($column = 1; $column <= $event->total_seat_columns; $column++)
                            <div class="col-0">
                                @php
                                    $seat = $seatsLookup[$row][$column] ?? null;
                                @endphp
                                @if ($seat)
                                    @php
                                        $seatClass = $seatClassesLookup[$seat['seat_class_id']] ?? null;
                                    @endphp
                                    @if ($seatClass)
                                        <a @if($seat['available']) href="{{ route('event.seatdetails', [$event->id, $seat['id']]) }}" @endif>
                                            <div class="seat @if(!$seat['available']) dimmed @endif" style="background-color: {{ $seatClass['color_code'] }}"></div>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        @endfor
                    </div>
                @endfor
            </div>
            <br><br>
            <a href="{{ route('event') }}" class="btn btn-primary">Back</a> 
        </div>
    </section>
@endsection