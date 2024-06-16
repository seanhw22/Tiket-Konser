@extends('layouts.template')
@section('content')
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
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Event Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($event as $e)
                        <tr>
                            <td>{{ $e ->id }}</td>
                            <td>{{ $e ->event_name}}</td>
                            <td>{{ $e ->event_desc }}</td>

                            <td>
                                <a href="{{ route('eventlist.showdetails', $e->id) }}" class="btn btn-primary">Details</a>
                                @if (!$e->deployed)
                                    <a href="{{ route('eventlist.edit', $e->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('eventlist.destroy', $e->id) }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you wish to delete this?');">Delete</button>
                                    </form>
                                    <form action="{{ route('eventlist.deploy', $e->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you wish to deploy this? You cannot undo this action.');">Deploy</button>
                                    </form>
                                    <form action="{{ route('eventlist.createseats', $e->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Create Seat</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection