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
            <div class="d-flex align-items-center">
                <form action="{{ route('buyerlist.search') }}" method="GET" class="d-flex flex-grow-1 me-2">
                    <input type="text" class="form-control flex-grow-1 me-2" name="search" placeholder="Search buyer..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('buyerlist.sortasc') }}" method="GET" class="me-2">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371zm1.57-.785L11 2.687h-.047l-.652 2.157z"/>
                            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('buyerlist.sortdesc') }}" method="GET">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645z"/>
                            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371zm1.57-.785L11 9.688h-.047l-.652 2.156z"/>
                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('buyerlist') }}" method="GET">
                    <button class="btn btn-outline-secondary" type="submit">
                        Reset
                    </button>
                </form>
            </div>
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