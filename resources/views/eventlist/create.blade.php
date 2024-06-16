@extends('layouts.template')
@section('content')
    <section class="page-section portfolio" id="tambah">
        <div class="container">
            <h1>Tambah Data Event</h1>
            <form action="{{ route('eventlist.store') }}" method="POST"> 
                @csrf
                <div class="mb-3">
                    <label for="event_name" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="event_name" name="event_name"> 
                </div>
                <div class="mb-3">
                    <label for="event_desc" class="form-label">Event Description</label>
                    <input type="text" class="form-control" id="event_desc" name="event_desc"> 
                </div>
                <div class="mb-3">
                    <label for="total_seat_columns" class="form-label">Total Seat Columns</label>
                    <input type="text" class="form-control" id="total_seat_columns" name="total_seat_columns">
                </div>
                <div>
                    <label for="end_date">End Date</label>
                    <input type="datetime-local" id="end_date" name="end_date">
                </div>
                <div>
                    <div id="seatClasses">
                        <label for="seatclass">Seat Class:</label>
                        <input type="text" name="seatclass[0][seat_class]" placeholder="Seat Class">
                        <input type="number" name="seatclass[0][price]" placeholder="Price">
                        <input type="number" name="seatclass[0][total_seat_rows]" placeholder="Total Seat Rows">
                        <input type="string" name="seatclass[0][color_code]" placeholder="Color Code">
                        <button type="button" onclick="addSeatClass()">Add Seat Class</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('eventlist') }}" class="btn btn-primary">Back</a> 
            </form>
        </div>
    </section>
    <script>
        let index = 0;
        function addSeatClass() {
            index++;
            const seatClassDiv = document.createElement('div');
            seatClassDiv.innerHTML = `
                <label for="seatclass">Seat Class:</label>
                <input type="text" name="seatclass[${index}][seat_class]" placeholder="Seat Class">
                <input type="number" name="seatclass[${index}][price]" placeholder="Price">
                <input type="number" name="seatclass[${index}][total_seat_rows]" placeholder="Total Seat Rows">
                <input type="string" name="seatclass[${index}][color_code]" placeholder="Color Code">
                <button type="button" onclick="removeSeatClass(this)">Remove Seat Class</button>
            `;
            document.getElementById('seatClasses').appendChild(seatClassDiv);
        }

        function removeSeatClass(button) {
            button.parentElement.remove();
            index--;
        }
    </script>
@endsection