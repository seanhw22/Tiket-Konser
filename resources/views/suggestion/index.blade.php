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
                        <th scope="col">Pinned</th>
                        <th scope="col">Checked</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($suggestions as $s)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $s ->name}}</td>
                            <td>{{ $s ->email }}</td>
                            <td>{{ $s -> phone }}</td>
                            <td>@if($s ->pinned) Yes @else No @endif</td>
                            <td>@if($s ->checked) Yes @else No @endif</td>

                            <td>
                                <a href="{{ route('suggestionlist.details', $s->id) }}" class="btn btn-primary">Details</a>
                                <form action="@if ($s->pinned) {{ route('suggestionlist.unpin', $s->id) }} @else {{ route('suggestionlist.pin', $s->id) }} @endif" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Pin</button>
                                </form>
                                <form action="@if ($s->checked) {{ route('suggestionlist.uncheck', $s->id) }} @else {{ route('suggestionlist.check', $s->id) }} @endif" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Check</button>
                                </form>
                                <form action="{{ route('suggestionlist.destroy', $s->id) }}" method="POST" class="d-inline">
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