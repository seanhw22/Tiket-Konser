<x-app-layout>
    <section class="page-section portfolio" id="portfolio">
        <div class="container-edit">
            <h2>Event Details</h2>
            <p>Event Name: {{ $event->event_name }}</p>
            <br>
            <div>
                <p>Event Description: <?php echo htmlspecialchars_decode($event->event_desc, ENT_QUOTES); ?></p>
            </div>
            <br>
            <p>Event Image: <br><img src="{{$event->event_image}}"></p>
            <p>Event Date: {{ $event->event_date }}</p>
            <p>Total Seat Columns: {{ $event->total_seat_columns }}</p>
            <p>Total Seat Rows: {{ $total_seat_rows }}</p>
            <p>End Date: {{ $event->end_date }}</p>
            <p>Deployed: @if($event->deployed) Yes @else No @endif</p>
            <br>
            <h2>Seat Class Details</h2>
            <table class="table">
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
            <br>
        </div>
        @if (!empty($seats))
            <div class="container text-dark">
                <h2 style="font-size: 36px;">Seats</h2>
                @for ($row = 1; $row <= $total_seat_rows; $row++)
                <div class="row justify-content-center">
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
                </div>
                @endfor
            </div>
        @endif
        <div class="container">
            <a href="{{ route('eventlist') }}" class="btn btn-primary">Back</a> 
        </div>
    </section>
</x-app-layout>