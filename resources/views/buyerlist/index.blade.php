<x-app-layout>
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <h1>Event List</h1>
            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('failure'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('failure') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Event</th>
                        <th scope="col">Seat Class</th>
                        <th scope="col">Seat Position</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($buyers as $b)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $b ->name}}</td>
                            <td>{{ $b ->email }}</td>
                            <td>{{ $b -> phone }}</td>
                            @foreach ($events as $e)
                                @if ($b->event_id == $e->id)
                                    <td>{{ $e->event_name }}</td>
                                    @break
                                @endif
                            @endforeach
                            @foreach ($seats as $s)
                                @if ($b->seat_id == $s['id'])
                                    @foreach ($seatClasses as $sc)
                                        @if ($s['seat_class_id'] == $sc->id)
                                            <td>{{ $sc->seat_class }}</td>
                                            <td>{{ $s['seat_position_row'] }}{{ $s['seat_position_column'] }}</td>
                                            @break
                                        @endif
                                    @endforeach
                                    @break
                                @endif
                            @endforeach

                            <td>
                                <a href="{{ route('buyerlist.edit', $b->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('buyerlist.destroy', $b->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wish to delete this?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $index++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>