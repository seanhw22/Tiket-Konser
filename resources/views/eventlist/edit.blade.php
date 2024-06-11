@extends('layouts.template')
@section('content')
    <section class="page-section portfolio" id="tambah">
        <div class="container">
            <h1>Edit Data Mahasiswa</h1>
            <form action="{{ route('mahasiswa.update', $mhs->id) }}" method="POST"> 
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" value="{{ $mhs->nim }}" readonly> 
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $mhs->nama }}"> 
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $mhs->email }}">
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ $mhs->jurusan }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</but> 
            </form>
        </div>
    </section>
@endsection