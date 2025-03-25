@extends('adminlte::page')

@section('title', 'Edit Kategori')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Kategori</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Kategori</label>
                <input type="text" name="kategori_kode" class="form-control" value="{{ $kategori->kategori_kode }}" required>
            </div>
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="kategori_nama" class="form-control" value="{{ $kategori->kategori_nama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
