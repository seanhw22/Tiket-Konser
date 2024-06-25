<x-app-layout>
    <section class="page-section portfolio" id="tambah">
        <div class="container">
            <h1>Edit Data Event</h1>
            <form action="{{ route('eventlist.updateafterdeployed', $event->id) }}" method="POST"> 
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
                <div>
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ $event->end_date }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('eventlist') }}" class="btn btn-primary">Back</a> 
            </form>
        </div>
    </section>
</x-app-layout>