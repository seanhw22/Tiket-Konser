<x-app-layout>
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
                    <textarea class="form-control" id="event_desc" name="event_desc" rows="20"></textarea>
                </div>
                <div class="mb-3">
                    <label for="event_image" class="form-label">Event Image</label>
                    <input type="text" class="form-control" id="event_image" name="event_image">
                </div>
                <div class="mb-3">
                    <label for="event_date" class="form-label">Event Date : </label>
                    <input type="datetime-local" class="form-control" id="event_date" name="event_date">
                </div>
                <div class="mb-3">
                    <label for="total_seat_columns" class="form-label">Total Seat Columns</label>
                    <input type="number" class="form-control" id="total_seat_columns" name="total_seat_columns" oninput="validateInput(this)">
                </div>
                <div>
                    <label for="end_date" class="form-label">End Date : </label>
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                </div>
                <br>
                <div id="seatClasses">
                    <div>
                        <label for="seatclass" class="form-label">Seat Class:</label>
                        <input type="text" class="form-label"name="seatclass[0][seat_class]" placeholder="Seat Class">
                        <input type="number" class="form-label" name="seatclass[0][price]" placeholder="Price">
                        <input type="number" class="form-label form-number" name="seatclass[0][total_seat_rows]" placeholder="Total Seat Rows" oninput="validateInput(this)">
                        <input type="text" class="form-label" name="seatclass[0][color_code]" placeholder="Color Code">
                        <button type="button" class="btn btn-dark" onclick="addSeatClass()">Add Seat Class</button>
                    </div>
                </div>
                <br>
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
                <div>
                <label for="seatclass" class="form-label">Seat Class:</label>
                <input type="text" class="form-label" name="seatclass[${index}][seat_class]" placeholder="Seat Class">
                <input type="number" class="form-label" name="seatclass[${index}][price]" placeholder="Price">
                <input type="number" class="form-label form-number" name="seatclass[${index}][total_seat_rows]" placeholder="Total Seat Rows" oninput="validateInput(this)">
                <input type="text" class="form-label" name="seatclass[${index}][color_code]" placeholder="Color Code">
                <button type="button" class="btn btn-dark" onclick="removeSeatClass(this)">Remove Seat Class</button>
                <div>
            `;
            document.getElementById('seatClasses').appendChild(seatClassDiv);
        }

        function removeSeatClass(button) {
            button.parentElement.remove();
            index--;
        }

        function validateInput(input) {
            if (input.value > 37) {
                input.value = 37;
            }
            if (input.value < 0){
                input.value = 0;
            }
        }
    </script>
</x-app-layout>