<x-app-layout>
    <section class="page-section portfolio" id="tambah">
        <div class="container">
            <h1>Edit Data Event</h1>
            <form action="{{ route('eventlist.update', $event->id) }}" method="POST"> 
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="event_name" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="event_name" name="event_name" value="{{ $event->event_name }}"> 
                </div>
                <div class="mb-3">
                    <label for="event_desc" class="form-label">Event Description</label>
                    <textarea class="form-control" id="event_desc" name="event_desc" rows="20">{{ $event->event_desc }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="event_image" class="form-label">Event Image</label>
                    <input type="text" class="form-control" id="event_image" name="event_image" value="{{ $event->event_image }}">
                    <img src="{{ $event->event_image }}" alt="" width="750" height="750">
                </div>
                <div class="mb-3">
                    <label for="event_date" class="form-label">Event Date</label>
                    <input type="datetime-local" class="form-control" id="event_date" name="event_date" value="{{ $event->event_date }}">
                </div>
                <div class="mb-3">
                    <label for="total_seat_columns" class="form-label">Total Seat Columns</label>
                    <input type="text" class="form-control" id="total_seat_columns" name="total_seat_columns" value="{{ $event->total_seat_columns }}">
                </div>
                <div>
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ $event->end_date }}">
                </div>
                <br>
                <div>
                    <div id="seatClasses" value="{{ $seatclassstring }}">
                        <label for="seatclass" class="form-label">Seat Class:</label>
                        <input type="hidden" name="seatclass[0][id]" value="{{ $seatclass[0]['id']}}">
                        <input type="text" class="form-label" name="seatclass[0][seat_class]" placeholder="Seat Class" value="{{ $seatclass[0]['seat_class']}}">
                        <input type="number" class="form-label" name="seatclass[0][price]" placeholder="Price" value="{{ $seatclass[0]['price']}}">
                        <input type="number" class="form-label" name="seatclass[0][total_seat_rows]" placeholder="Total Seat Rows" value="{{ $seatclass[0]['total_seat_rows']}}">
                        <input type="text" class="form-label" name="seatclass[0][color_code]" placeholder="Color Code" value="{{ $seatclass[0]['color_code']}}">
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
        const seatClassContainer = document.getElementById('seatClasses');
        const seatClassString = seatClassContainer.getAttribute('value');
        const seatClass = JSON.parse(seatClassString);
        function addSeatClass() {
            index++;
            const seatClassDiv = document.createElement('div');
            seatClassDiv.innerHTML = `
                <label for="seatclass" class="form-label">Seat Class:</label>
                <input type="hidden" name="seatclass[${index}][id]" value="id">
                <input type="text" class="form-label" name="seatclass[${index}][seat_class]" placeholder="Seat Class">
                <input type="number" class="form-label" name="seatclass[${index}][price]" placeholder="Price">
                <input type="number" class="form-label" name="seatclass[${index}][total_seat_rows]" placeholder="Total Seat Rows">
                <input type="text" class="form-label" name="seatclass[${index}][color_code]" placeholder="Color Code">
                <button type="button" class="btn btn-dark" onclick="removeSeatClass(this)">Remove Seat Class</button>
            `;
            document.getElementById('seatClasses').appendChild(seatClassDiv);
        }

        function autoAddSeatClass() {
            for (let i = 1; i < seatClass.length; i++) {
                index++;
                const seatClassDiv = document.createElement('div');
                seatClassDiv.innerHTML = `
                    <label for="seatclass" class="form-label">Seat Class:</label>
                    <input type="hidden" name="seatclass[${index}][id]" value="${seatClass[index]['id']}">
                    <input type="text" class="form-label" name="seatclass[${index}][seat_class]" placeholder="Seat Class" value="${seatClass[index]['seat_class']}">
                    <input type="number" class="form-label" name="seatclass[${index}][price]" placeholder="Price" value="${seatClass[index]['price']}">
                    <input type="number" class="form-label" name="seatclass[${index}][total_seat_rows]" placeholder="Total Seat Rows" value="${seatClass[index]['total_seat_rows']}">
                    <input type="text" class="form-label" name="seatclass[${index}][color_code]" placeholder="Color Code" value="${seatClass[index]['color_code']}">
                    <button type="button" class="btn btn-dark" onclick="removeSeatClass(this)">Remove Seat Class</button>
                `;
                document.getElementById('seatClasses').appendChild(seatClassDiv);
            }
        }

        function removeSeatClass(button) {
            button.parentElement.remove();
            index--;
        }

        autoAddSeatClass();
    </script>
</x-app-layout>