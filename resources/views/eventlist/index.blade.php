<x-app-layout>
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <h1>Event List</h1>
            <a href="{{ route('eventlist.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
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
                <form action="{{ route('eventlist.search') }}" method="GET" class="d-flex flex-grow-1 me-2">
                    <input type="hidden" name="deployed" value="{{ $deployed }}">
                    <input type="text" class="form-control flex-grow-1 me-2" name="search" placeholder="Search event..." value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('eventlist.sortasc') }}" method="GET" class="me-2">
                    <input type="hidden" name="deployed" value="{{ $deployed }}">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371zm1.57-.785L11 2.687h-.047l-.652 2.157z"/>
                            <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('eventlist.sortdesc') }}" method="GET">
                    <input type="hidden" name="deployed" value="{{ $deployed }}">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                            <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645z"/>
                            <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371zm1.57-.785L11 9.688h-.047l-.652 2.156z"/>
                            <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293z"/>
                        </svg>
                    </button>
                </form>
                <form action="{{ route('eventlist.retrievedeployed') }}" method="GET">
                    <input type="hidden" name="search" value="{{ $search }}">
                    <input type="hidden" name="deployed" value="{{ $deployed }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        Deployed
                    </button>
                </form>
                <form action="{{ route('eventlist') }}" method="GET">
                    <button class="btn btn-outline-secondary" type="submit">
                        Reset
                    </button>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($event as $e)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $e ->event_name}}</td>
                            <td>{{ $e ->event_desc }}</td>

                            <td>
                                <a href="{{ route('eventlist.showdetails', $e->id) }}" class="btn btn-primary">Details</a>
                                @if (!$e->deployed)
                                    <a href="{{ route('eventlist.edit', $e->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('eventlist.createseats', $e->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Create Seat</button>
                                    </form>
                                    <form action="{{ route('eventlist.deploy', $e->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you wish to deploy this? You cannot undo this action.');">Deploy</button>
                                    </form>
                                    <form action="{{ route('eventlist.destroy', $e->id) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wish to delete this?');">Delete</button>
                                    </form>
                                @endif
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